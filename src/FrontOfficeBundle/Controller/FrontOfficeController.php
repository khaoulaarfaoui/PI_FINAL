<?php

namespace FrontOfficeBundle\Controller;

use FrontOfficeBundle\Entity\Client;
use FrontOfficeBundle\Entity\coupon;
use FrontOfficeBundle\Entity\Detail_Panier;
use StockBundle\Entity\produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FrontOfficeController extends Controller
{
    public function readAction(Request $request)
    {
        $em = $this->getDoctrine();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $client = $em->getRepository(client::class)->findclientbyuser($user->getId());
        if ($client != null) {

            $produit_id = $request->get("produit_id");
            $qte = $request->get("qte");


            if (isset($produit_id)) {
                $detail = new Detail_Panier();
                $detail->setQte($qte);
                $detail->setClient($client);
                $detail->setPanier(null);
                $produit = $em->getRepository(produit::class)->find($produit_id);
                $detail->setProduit($produit);
                $em->getManager()->persist($detail);
                $em->getManager()->flush();
                return $this->redirectToRoute("read");

            }


            $tab = $em->getRepository(produit ::class)->findAll();
            $tab1 = $em->getRepository(Detail_Panier ::class)->findAll();

            return $this->render('@FrontOffice/Default/index1.html.twig', array('produit' => $tab, "panierNb" => count($tab1)));

        }
    }
    public function  coupAction(Request $request)
    {
        $em = $this->getDoctrine();

        $requestString = $request->get('q');

        $coupon = $em->getRepository(coupon::class)->findcouponbynum($requestString);
        if($coupon)
        {
            if($coupon->getIsValid())
            {
                $coupon->setIsValid(0);
                $em->getManager()->flush();
                return new Response(json_encode($coupon->getValue()));
            }
            else
            {
                return new Response(json_encode(-1));
            }
        }
        else
        {
            return new Response(json_encode(-1));
        }
    }

        public function searchAction(Request $request)
    {
        $em = $this->getDoctrine();

        $requestString = $request->get('q');

        $entities = $em->getRepository(produit::class)->findEntitiesByString($requestString);
$encoders = [new XmlEncoder(), new JsonEncoder()];
$normalizers = [new ObjectNormalizer()];

$serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($entities, 'json', [AbstractNormalizer::ATTRIBUTES => ['nomProduit', 'prixVente', 'photoProduit','reference'], ]);
        return new Response(json_encode($jsonContent));
    }








}

<?php

namespace FrontOfficeBundle\Controller;

use FrontOfficeBundle\Entity\Client;
use FrontOfficeBundle\Entity\Detail_Panier;
use StockBundle\Entity\Produit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontOfficeController extends Controller
{
    public function readAction(Request $request)
    {   $em=$this->getDoctrine();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $client =$em->getRepository(client::class)->findclientbyuser($user->getId());
        if ($client!= null){

            $produit_id=$request->get("produit_id");
            $qte=$request->get("qte");


            if(isset($produit_id) )
            {
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


            $tab=$em->getRepository(produit ::class)->findAll();

            return $this->render('@FrontOffice/Default/index1.html.twig',array('produit'=>$tab));

        }


    }





}

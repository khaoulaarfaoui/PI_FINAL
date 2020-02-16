<?php

namespace FrontOfficeBundle\Controller;

use FrontOfficeBundle\Entity\Client;
use FrontOfficeBundle\Entity\Commande;
use FrontOfficeBundle\Entity\detail_commande;
use FrontOfficeBundle\Entity\Detail_Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommandeController extends Controller
{
    public function viderAction(){

        $em=$this->getDoctrine();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $client =$em->getRepository(Client::class)->findclientbyuser( $user->getId());
        if ($client!= null) {
            $tab = $em->getRepository(Detail_Panier::class)->findAll();
            $commande = new Commande();
            $commande->setClient($client);
            $commande->setDate(new \DateTime('now'));
            $em->getManager()->persist($commande);
            foreach ($tab as $detail) {
                $detail_commande = new detail_commande();
                $detail_commande->setQteC($detail->getQte());
                $detail_commande->setProduit($detail->getProduit());
                $detail_commande->setCommande($commande);
                $em->getManager()->persist($detail_commande);
            }

            $em->getManager()->flush();

            foreach ($tab as $detail) {
                $em->getManager()->remove($detail);

            }

            $em->getManager()->flush();
            return $this->redirectToRoute("read");
        }
        {
            $em = $this->getDoctrine();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $client = $em->getRepository(Client::class)->findclientbyuser($user->getId());
            if ($client != null) {
                $detail_id = $request->get("detail_id");


                if (isset($detail_id)) {

                    $detail = $em->getRepository(Detail_Panier::class)->find($detail_id);

                    $em->getManager()->remove($detail);
                    $em->getManager()->flush();
                    return $this->redirectToRoute("readdetail");

                }
            }

            $tab = $em->getRepository(Detail_Panier ::class)->findAll();

            return $this->render('@FrontOffice/detail.html.twig', array('details' => $tab));


        }}
        public function readAction(Request $request)
        {
            $em = $this->getDoctrine();
            $user = $this->container->get('security.token_storage')->getToken()->getUser();
            $client = $em->getRepository(Client::class)->findclientbyuser( $user->getId());
            if ($client != null) {
                $detail_id=$request->get("detail_id");



                if(isset($detail_id) )
                {

                    $commande = $em->getRepository(Detail_Panier::class)->find($commande_id);

                    $em->getManager()->persist($commande);
                    $em->getManager()->flush();
                    return $this->redirectToRoute("readcommande");

                }}

            $tab = $em->getRepository(Commande ::class)->findAll();
            $array = [];
            $array1 = [];
            foreach($tab as $c)
            {
                $subTab = $em->getRepository(detail_commande::class)->findclientbyCommande($c->getId());
                $array[$c->getId()] = $subTab;
                $array1[$c->getId()] = $c->getDate();

            }



            return $this->render('@FrontOffice/Default/commande.html.twig', array('commandes' => $array, "dates" => $array1));


        }





}

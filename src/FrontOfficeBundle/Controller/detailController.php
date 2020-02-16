<?php

namespace FrontOfficeBundle\Controller;

use FrontOfficeBundle\Entity\Client;
use FrontOfficeBundle\Entity\Detail_Panier;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class detailController extends Controller
{
    public function readAction(Request $request)
    {
        $em = $this->getDoctrine();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $client = $em->getRepository(Client::class)->findclientbyuser( $user->getId());
        if ($client != null) {
            $detail_id=$request->get("detail_id");



            if(isset($detail_id) )
            {

                $detail = $em->getRepository(Detail_Panier::class)->find($detail_id);

                $em->getManager()->remove($detail);
                $em->getManager()->flush();
                return $this->redirectToRoute("readdetail");

            }}

            $tab = $em->getRepository(Detail_Panier ::class)->findAll();

            return $this->render('@FrontOffice/panier.html.twig', array('details' => $tab));


        }
        public function viderAction(){


            $em = $this->getDoctrine();
            $tab = $em->getRepository(Detail_Panier ::class)->findAll();
            foreach ($tab as $detail){
                $em->getManager()->remove($detail);

            }

            $em->getManager()->flush();
            return $this->redirectToRoute("read");




    }

    public  function  updateAction(Request $request)
    {
        $em = $this->getDoctrine();
        $tab = $em->getRepository(Detail_Panier ::class)->findAll();
        foreach ($tab as $detail){
            $qte = $request->get('qte_'.$detail->getId());
            $detail->setQte($qte);


        }

        $em->getManager()->flush();
        return $this->redirectToRoute("readdetail");
    }
    public  function  suppAction($id)
    {
        $em = $this->getDoctrine();
        $detail = $em->getRepository(Detail_Panier ::class)->find($id);
        $em->getManager()->remove($detail);

        $em->getManager()->flush();
        return $this->redirectToRoute("readdetail");
    }




}
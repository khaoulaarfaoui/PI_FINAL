<?php

namespace FrontOfficeBundle\Controller;

use FactureBundle\Entity\payment;
use FrontOfficeBundle\Entity\Commande;
use FrontOfficeBundle\Entity\detail_commande;
use FrontOfficeBundle\Entity\Detail_Panier;
use Stripe\Card;
use Stripe\PaymentIntent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class payementController extends Controller
{

    //action jdida t'affichi page jdida mtaa twig fiha el formulaire mtaa el paiement bil template


    public function payAction($commande_id, Request $request)
    {
        $em=$this->getDoctrine();


        //njibou tous les detailsCommandes a partir mil commandeId
        $tab = $em->getRepository(detail_commande::class)->findDetailsByCommande($commande_id);
        $somme = 0;
        foreach ($tab as $detail) {
            $somme += $detail->getQteC() * $detail->getProduit()->getPrixVente();

        }
        $tab1=$em->getRepository(Detail_Panier ::class)->findAll();
        $cn = $request->get("cardNumber");
        $cp = $request->get("cp");
        $nt = $request->get("nt");


        $ex = $request->get("expire");
        $expire = explode("/", $ex);

        $cvc = $request->get("cvc");


    if(isset($cn)) {
        \Stripe\Stripe::setApiKey('sk_test_YEpKt1Nwmb9Zd5kDNSH5vgq2003j1Ya0eZ');

        PaymentIntent::create([
            'amount' => $nt*100,
            'currency' => 'eur',
            'payment_method_types'=> [
            'card',
        ],
        ]);
    }
    else
    {

        return $this->render('@FrontOffice/Default/paiment.html.twig',array( "panierNb"=> count($tab1),"detail_commande"=>$tab, "total"=>$somme));

    }
            return $this->redirectToRoute('read');

    }

}

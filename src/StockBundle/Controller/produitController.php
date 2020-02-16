<?php

namespace StockBundle\Controller;

use StockBundle\Entity\produit;
use StockBundle\Form\produitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class produitController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $produits = $em->getRepository('StockBundle:produit')->findAll();

        return $this->render('produit/index.html.twig', array(
            'produits' => $produits,
        ));
    }


    /**
     * Creates a new produit entity.
     *
     * @Route("/new", name="produit_new" , methods={"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $produit = new Produit();
        $form = $this->createForm('StockBundle\Form\produitType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $file = $produit->getPhotoProduit();
            //genere un nom cripté avec md5
            $filename= md5(uniqid()) . '.' . $file->guessExtension();
            //ajouter l'image dance /web/uploads/post
            $file->move($this->getParameter('photos_directory'), $filename);
            $produit->setPhotoProduit($filename);
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('stock_homepagepro', array('reference' => $produit->getReference()));
        }

        return $this->render('produit/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }


    public function showAction(produit $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);

        return $this->render('produit/show.html.twig', array(
            'produit' => $produit,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function editAction(Request $request, $reference)
    {
        $em=$this->getDoctrine()->getManager();
        $p= $em->getRepository('StockBundle:produit')->find($reference);
        $form=$this->createForm(produitType::class,$p);
        $form->handleRequest($request);
        if($form->isSubmitted()){


            $em= $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
            return $this->redirectToRoute('stock_homepagepro');

        }
        return $this->render('produit/edit.html.twig', array(
            "form"=> $form->createView()
        ));
    }

    /**
     * Deletes a produit entity.
     *
     * @Route("/{reference}", name="produit_delete" , methods={"DELETE"})
     */

    public function deleteAction(Request $request)
    {
        $reference = $request->get('reference');
        $em= $this->getDoctrine()->getManager();
        $produit=$em->getRepository('StockBundle:produit')->find($reference);
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('stock_homepagepro');
    }
    /**
     * Creates a form to delete a produit entity.
     *
     * @param produit $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(produit $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('produit_delete', array('reference' => $produit->getReference())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

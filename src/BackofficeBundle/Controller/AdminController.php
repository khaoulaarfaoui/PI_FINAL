<?php

namespace BackofficeBundle\Controller;

use BackofficeBundle\Entity\Employee;
use BackofficeBundle\Entity\Fournisseur;
use BackofficeBundle\Form\EmployeeType;
use BackofficeBundle\Form\FournisseurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    ###############################AJOUT ####################################################
    #FOURNISSEUR
    public function addFournisseurAction(Request $request)
    {
        $Fournisseur=new Fournisseur();
        //1.b creation du formulaire
        $form=$this->createForm(FournisseurType::class,$Fournisseur);
        //2.a recup donnees
        $form=$form->handleRequest($request);
        //test sur les donnees
        //les donnees sont valides
        if($form->isValid())
        {
            //insertion dans la base
            $em=$this->getDoctrine()->getManager();
            $em->persist($Fournisseur);
            $em->flush();
            return $this->redirectToRoute('readFournisseur');
        }
        //1.c envoyer forme
        return $this->render('@Backoffice\Fournisseur\add.html.twig', array(
            'form'=>$form->createView()));

    }
        public function addEmployeeAction(Request $request)
    {
        $Employee=new \BackofficeBundle\Entity\Employee();
        //1.b creation du formulaire
        $form=$this->createForm(EmployeeType::class,$Employee);
        //2.a recup donnees
        $form=$form->handleRequest($request);
        //test sur les donnees
        //les donnees sont valides
        if($form->isValid())
        {
            //insertion dans la base
            $em=$this->getDoctrine()->getManager();
            $em->persist($Employee);
            $em->flush();
            return $this->redirectToRoute('readEmployee');
        }
        //1.c envoyer forme
        return $this->render('@Backoffice/Employee/add.html.twig', array(
            'form'=>$form->createView()));
    }
##############################################################################################################
##########################READ#################################################################

    public function readFournisseurAction()
    {
        $em=$this->getDoctrine();
        $tab=$em->getRepository(Fournisseur::class);
        $articles = $tab->findAll();
        return $this->render('@Backoffice/Fournisseur/read.html.twig', array(
            'fournisseur'=>$articles
        ));
    }
    public function readEmployeeAction()
    {
        $em=$this->getDoctrine();
        $tab=$em->getRepository(Employee::class);
        $articles = $tab->findAll();
        return $this->render('@Backoffice/Employee/read.html.twig', array(
            'Employee'=>$articles
        ));
    }
    ########################################################################################################

    #########################################UPDATE#####################################################
    public function updateFournisseurAction($id, Request $request){
        //1.recu d l objet
        $em=$this->getDoctrine()->getManager();
        $fournisseur=$em->getRepository(Fournisseur::class)->find($id);
        //var_dump($club);
        //die();
        $form=$this->createForm(FournisseurType::class,$fournisseur);
        //2.recuperation des données
        $form=$form->handleRequest($request);
        //3. tester les données
        if($form->isValid()){
            $em->flush();
            return $this->redirectToRoute('readFournisseur');
        }
        //1.envoi
        return $this->render('@Backoffice/Fournisseur/update.html.twig',array(
            'form'=>$form->createView()
        ));
    }
    public function updateEmployeeAction($id, Request $request){
        //1.recu d l objet
        $em=$this->getDoctrine()->getManager();
        $employee=$em->getRepository(\BackofficeBundle\Entity\Employee::class)->find($id);
        //var_dump($club);
        //die();
        $form=$this->createForm(EmployeeType::class,$employee);
        //2.recuperation des données
        $form=$form->handleRequest($request);
        //3. tester les données
        if($form->isValid()){
            $em->flush();
            return $this->redirectToRoute('readEmployee');
        }
        //1.envoi
        return $this->render('@Backoffice/Employee/update.html.twig',array(
            'form'=>$form->createView()
        ));
    }
    ####################################################################################################################
    ###########################DELETE##############################################################################"

    public function deleteFournisseurAction($id)
    {
        //1.recu d l objet
        $em = $this->getDoctrine()->getManager();
        $club = $em->getRepository(Fournisseur::class)->find($id);
        $em->remove($club);
        $em->flush();
        return $this->redirectToRoute
        ('readFournisseur');
    }

    public function deleteEmployeeAction($id)
    {
        //1.recu d l objet
        $em = $this->getDoctrine()->getManager();
        $EMP = $em->getRepository(Employee::class)->find($id);
        $em->remove($EMP);
        $em->flush();
        return $this->redirectToRoute
        ('readEmployee');
    }
}




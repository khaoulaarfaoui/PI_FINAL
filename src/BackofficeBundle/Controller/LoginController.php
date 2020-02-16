<?php

namespace BackofficeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{
    public function loginAction()
    {
        return $this->render('@Backoffice/login.html.twig');

    }
    public function IndexAction()
    {
        return $this->render('@Backoffice/Employee/first_page.html.twig');

    }
}
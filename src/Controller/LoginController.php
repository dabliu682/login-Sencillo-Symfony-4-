<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    
    public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // obtener el error de login si hay
        $error = $authenticationUtils->getLastAuthenticationError();

        // último nombre de usuario introducido por el usuario
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', array('last_username' => $lastUsername, 'error' => $error,));
    }
     
    public function loginCheckAction()
    {
        // este controller no se ejecutará, ya que la route se maneja por el sistema de seguridad
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PlataformaController extends AbstractController
{
    public function index()
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('plataforma/index.html.twig');
    }     
    
}

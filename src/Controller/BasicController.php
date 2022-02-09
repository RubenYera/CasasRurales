<?php

// src/Controller/BasicController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasicController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function casa_rural(): Response
    {
    
        return $this->render('home.html.twig');
    }
}
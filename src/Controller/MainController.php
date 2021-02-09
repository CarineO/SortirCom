<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/home2", name="home2")
     */
    public function home()
    {
        return $this->render('main/home.html.twig', [
        
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function HomeAction(Request $request) 
    {
        return $this->render('base.html.twig');
    }

    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Maria Laura',
        ]);
    }

    /**
     * @Route("/pagina3a/{titulo}", name="pagina3a")
     */
    public function pagina3a($titulo): Response
    {
        return $this->render('home/pagina3a.html.twig',["param1"=>$titulo,"valor"=>5]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        return $this->render('login.html.twig');
    }
}

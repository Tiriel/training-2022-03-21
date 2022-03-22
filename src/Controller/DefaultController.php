<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="app_default_index")
     */
    public function index(Request $request): Response
    {
        return $this->render('default/index.html.twig', ['controller' => 'DefaultController']);
    }

    /**
     * @Route("/contact", name="app_default_contact", methods={"GET"})
     */
    public function contact(Request $request): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }
}

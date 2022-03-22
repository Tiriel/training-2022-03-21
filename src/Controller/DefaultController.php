<?php

namespace App\Controller;

use App\Form\ContactType;
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
     * @Route("/contact", name="app_default_contact", methods={"GET", "POST"})
     */
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            dd($form->getData());
        }

        return $this->render('default/contact.html.twig', ['form' => $form->createView()]);
    }
}

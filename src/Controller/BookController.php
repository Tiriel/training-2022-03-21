<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book", name="app_book_")
 */
class BookController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->forward('app_book_index');
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(BookType::class, new Book());
        $form->handleRequest($request);

        return $this->render('book/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/{isbn}", name="isbn", requirements={"isbn": "\w+"})
     */
    public function getByIsbn(Request $request, BookRepository $repository)
    {
        $book = $repository->findOneBy(['isbn' => $request->attributes->get('isbn')]);

        return $this->json($book);
    }
}

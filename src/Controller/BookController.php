<?php

namespace App\Controller;

use App\Entity\Book;
use App\Transformer\BookTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @Route("/{id}", name="json")
     */
    public function getJson(Book $book, BookTransformer $transformer)
    {
        return $this->json($transformer->getJson($book));
    }
}

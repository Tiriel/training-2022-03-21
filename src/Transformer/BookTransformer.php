<?php

namespace App\Transformer;

use App\Entity\Book;
use Symfony\Component\Serializer\SerializerInterface;

class BookTransformer
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getJson(Book $book)
    {
        $normalized = $this->serializer->normalize($book);

        return $this->serializer->encode($normalized, 'json');
    }
}
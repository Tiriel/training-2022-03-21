<?php

namespace App\Fetcher;

use App\Consumer\OMDbApiConsumer;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Transformer\MovieTransformer;

class MovieFetcher
{
    private MovieRepository $repository;
    private MovieTransformer $transformer;
    private OMDbApiConsumer $consumer;

    public function __construct(MovieRepository $repository, MovieTransformer $transformer, OMDbApiConsumer $consumer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
        $this->consumer = $consumer;
    }

    public function fetchMovieByTitle(string $title): Movie
    {
        return $this->fetchMovie('title', $title);
    }

    public function fetchMovieById(string $id): Movie
    {
       return $this->fetchMovie('id', $id);
    }

    private function fetchMovie(string $type, string $value): Movie
    {
        $dbType = $type === 'id' ? 'omdbId' : $type;

        if (!$movie = $this->repository->findOneBy([$dbType => $value])) {
            $movie = $this->transformer->dataToMovie(
                $this->consumer->getMovie($type, $value)
            );
            $this->repository->add($movie);
        }

        return $movie;
    }
}
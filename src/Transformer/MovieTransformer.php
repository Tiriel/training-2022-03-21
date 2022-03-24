<?php

namespace App\Transformer;

use App\Consumer\OMDbApiConsumer;
use App\Entity\Genre;
use App\Entity\Movie;

class MovieTransformer
{
    public function dataToMovie(array $data)
    {
        $genres = explode(', ', $data['Genre']);

        $movie = (new Movie())
            ->setTitle($data['Title'])
            ->setReleased(new \DateTime($data['Released']))
            ->setCountry($data['Country'])
            ->setPoster($data['Poster'])
            ->setRated($data['Rated'])
            ->setOmdbId($data['imdbID'])
            ->setPrice(5.0)
            ;

        foreach ($genres as $genre) {
            $movie->addGenre(
                (new Genre())
                    ->setDescription($genre)
                    ->setPoster('img')
            );
        }

        return $movie;
    }
}
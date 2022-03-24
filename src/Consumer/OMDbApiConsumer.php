<?php

namespace App\Consumer;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OMDbApiConsumer
{
    public const OMDB_ATTRIBUTES = [
        'title' => 't',
        'id' => 'i'
    ];

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $omdbClient)
    {
        $this->client = $omdbClient;
    }

    public function getMovie(string $attribute, string $value): array
    {
        return $this->client->request(Request::METHOD_GET, '', [
            'query' => [
                self::OMDB_ATTRIBUTES[$attribute] => $value,
            ],
        ])->toArray();
    }
}
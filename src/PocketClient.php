<?php

declare(strict_types=1);

namespace McMatters\PocketApi;

use McMatters\Ticl\Client;

class PocketClient
{
    protected Client $httpClient;

    public function __construct(string $consumerKey, string $token)
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://getpocket.com/v3',
            'json' => [
                'consumer_key' => $consumerKey,
                'access_token' => $token,
            ],
            'headers' => [
                'X-Accept' => 'application/json',
                'Content-Type' => 'application/json; charset=UTF8',
            ],
        ]);
    }

    public function add(string $url, array $data = []): array
    {
        return $this->httpClient
            ->withJson(['url' => $url] + $data)
            ->post('add')
            ->json();
    }

    public function modify(array $actions): array
    {
        return $this->httpClient
            ->withJson(['actions' => $actions])
            ->post('send')
            ->json();
    }

    public function retrieve(array $data = []): array
    {
        return $this->httpClient
            ->withJson($data)
            ->post('get')
            ->json();
    }
}

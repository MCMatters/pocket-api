<?php

declare(strict_types=1);

namespace McMatters\PocketApi;

use McMatters\Ticl\Client;

/**
 * Class PocketClient
 *
 * @package McMatters\PocketApi
 */
class PocketClient
{
    /**
     * @var \McMatters\Ticl\Client
     */
    protected Client $httpClient;

    /**
     * @return void
     */
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

    /**
     * @param string $url
     * @param array $data
     *
     * @return array
     */
    public function add(string $url, array $data = []): array
    {
        return $this->httpClient
            ->withJson(['url' => $url] + $data)
            ->post('add')
            ->json();
    }

    /**
     * @param array $actions
     *
     * @return array
     */
    public function modify(array $actions): array
    {
        return $this->httpClient
            ->withJson(['actions' => $actions])
            ->post('send')
            ->json();
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function retrieve(array $data = []): array
    {
        return $this->httpClient
            ->withJson($data)
            ->post('get')
            ->json();
    }
}

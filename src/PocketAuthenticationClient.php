<?php

declare(strict_types=1);

namespace McMatters\PocketApi;

use McMatters\Ticl\Client;

use const null;

class PocketAuthenticationClient
{
    protected Client $httpClient;

    public function __construct(string $consumerKey)
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://getpocket.com/v3/oauth',
            'json' => [
                'consumer_key' => $consumerKey,
            ],
            'headers' => [
                'X-Accept' => 'application/json',
                'Content-Type' => 'application/json; charset=UTF8',
            ],
        ]);
    }

    public function request(string $redirectUri, ?string $state = null): array
    {
        return $this->httpClient
            ->withJson(['redirect_uri' => $redirectUri, 'state' => $state])
            ->post('request')
            ->json();
    }

    public function getAuthorizeUrl(string $code, string $redirectUri): string
    {
        return "https://getpocket.com/auth/authorize?request_token={$code}&redirect_uri={$redirectUri}";
    }

    public function authorize(string $code): array
    {
        return $this->httpClient
            ->withJson(['code' => $code])
            ->post('authorize')
            ->json();
    }
}

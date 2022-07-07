## PHP library for Pocket API

### Installation
```shell
composer require mcmatters/pocket-api
```

### Usage

#### Authentication

```php
<?php

declare(strict_types=1);

use McMatters\PocketApi\PocketAuthenticationClient;

require __DIR__.'/vendor/autoload.php';

$consumerKey = 'XXXXXX-XXXXXXXXXXXXXXXXXXXXXXX';
$redirectUri = 'https://your-site.com';

$authClient = new PocketAuthenticationClient($consumerKey);

$token = $authClient->request($redirectUri);

$url = $authClient->getAuthorizeUrl($token['code'], $redirectUri);

// Redirect user to the url

// After that obtain access_token
$response = $authClient->authorize($token['code']);

$accessToken = $response['access_token'];

```

#### API usage

```php
<?php

declare(strict_types=1);

use McMatters\PocketApi\PocketClient;

require __DIR__.'/vendor/autoload.php';

$consumerKey = 'XXXXXX-XXXXXXXXXXXXXXXXXXXXXXX';
$token = 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXX';

$client = new PocketClient($consumerKey, $token);

$client->add('https://example.com');

$articles = $client->retrieve();

```

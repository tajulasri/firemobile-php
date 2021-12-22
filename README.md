## Firemobile PHP 
[![tests](https://github.com/tajulasri/firemobile-php/actions/workflows/tests.yml/badge.svg)](https://github.com/tajulasri/firemobile-php/actions/workflows/tests.yml)

This package is for sending SMS via Firemobile service providers.

## Installation

You can install the package via composer:

```bash
composer require espressobyte/firemobile-php 
```

### Usage without set option for delivery report callback

```php
<?php 

use Firemobile\Client;
use Firemobile\FiremobileAuth;
use Firemobile\Message;
use Firemobile\Requests\Sms;
use GuzzleHttp\Client as HttpClient;

$message = Message::make()
    ->setFrom('+60123456789')
    ->setTo('+60123226789')
    ->setText('Firemobile message.');

$firemobile = Client::make(new HttpClient(),[
    'username' => 'secret',
    'password' => 'secret',
]);

$response = Sms::make($message,FiremobileAuth::make($firemobile))
->send();

echo $response->getStatusCode();
echo $response->getBody();

```

### Usage with option for delivery report received

```php
<?php 

use Firemobile\Client;
use Firemobile\FiremobileAuth;
use Firemobile\Message;
use Firemobile\Requests\Sms;
use GuzzleHttp\Client as HttpClient;

$callbackUrl = 'https://demo.test/callback';

$message = Message::make()
    ->setFrom('+60123456789')
    ->setTo('+60123226789')
    ->setText('Firemobile message.');

$firemobile = Client::make(new HttpClient(),[
    'endpoint' => 'https://firemobile.send.com:8000/cgi-bin',
    'username' => 'c2VjcmV0Cg==',
    'password' => 'c2VjcmV0Cg==',
])
->callback($callbackUrl);

$response = Sms::make($message,FiremobileAuth::make($firemobile))->send();

echo $response->getStatusCode();
echo $response->getBody();

```


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


### Security

If you discover any security related issues, please email mtajulasri@gmail.com instead of using the issue tracker.



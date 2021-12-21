### Usage

Firemobile PHP is under development.

```php
use Firemobile\Client;
use Firemobile\FiremobileAuth;
use Firemobile\Message;
use GuzzleHttp\Client as HttpClient;

$message = Message::make()
    ->setFrom('78123123')
    ->setTo('60123443534534')
    ->setText('This is demo');

$firemobile = Client::make(new HttpClient(),[
    'username' => 'secret',
    'password' => 'secret',
]);

$response = Sms::make($message,FiremobileAuth::make($firemobile))->send();

```


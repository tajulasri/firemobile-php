<?php

namespace Firemobile\Tests\Feature;

use Firemobile\Client;
use Firemobile\FiremobileAuth;
use Firemobile\Message;
use Firemobile\Requests\Sms;
use Firemobile\Tests\TestCase;
use Psr\Http\Client\ClientInterface;

class SmsTest extends TestCase
{
    public function test_send_sms_via_instance()
    {

        $endpoint = 'https://endpoint.test';

        $data = 'secret';

        $config = [
            'endpoint' => $endpoint,
            'username' => $data,
            'password' => $data,
        ];

        $client = new Client($this->httpClientMock(), $config);
        $message = Message::make()
            ->setFrom($data)
            ->setTo($data)
            ->setText($data);

        $sendSms = Sms::make($message, FiremobileAuth::make($client))->send();

        $this->assertInstanceOf('Firemobile\Client', $client);
        $this->assertEquals($config, $client->config());

    }

}

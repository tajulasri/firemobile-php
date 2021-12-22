<?php

namespace Firemobile\Tests\Feature;

use Firemobile\Client;
use Firemobile\FiremobileAuth;
use Firemobile\Message;
use Firemobile\Requests\Sms;
use Firemobile\Tests\TestCase;

class SmsTest extends TestCase
{
    public function testSendSmsViaInstanceResponseSuccess()
    {
        $endpoint = 'https://endpoint.test';

        $data = 'secret';

        $config = [
            'endpoint' => $endpoint,
            'username' => $data,
            'password' => $data,
        ];

        $client = Client::make($this->successSmsSendMock(), $config)
            ->callback($endpoint);

        $message = Message::make()
            ->setFrom($data)
            ->setTo($data)
            ->setText($data);

        $sendSms = Sms::make($message, FiremobileAuth::make($client))->send();
        $response = [];

        parse_str($sendSms->getBody(), $response);

        $this->assertInstanceOf('Firemobile\Client', $client);
        $this->assertEquals(array_merge(['Gw-Dlr-Url' => $endpoint, 'Gw-Dlr-Mask' => 1], $config), $client->config());
        $this->assertEquals(200, $sendSms->getStatusCode());
        $this->assertEquals(0, $response['status']);
        $this->assertEquals($this->getTestMsgId(), $response['msgid']);
    }
}

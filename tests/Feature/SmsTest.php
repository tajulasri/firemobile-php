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
    public function test_send_sms_via_instance_response_success()
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
        $this->assertEquals(array_merge(['gw-dlr-url' => $endpoint, 'gw-dlr-mask' => true], $config), $client->config());
        $this->assertEquals(200, $sendSms->getStatusCode());
        $this->assertEquals(0, $response['status']);
        $this->assertEquals($this->getTestMsgId(), $response['msgid']);

    }

}

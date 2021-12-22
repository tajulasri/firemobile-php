<?php

namespace Firemobile\Tests;

use Firemobile\Client;
use Psr\Http\Client\ClientInterface;

class ClientTest extends TestCase
{
    public function testItInstantiateMessage()
    {
        $endpoint = 'https://endpoint.test';

        $client = new Client($this->httpClientMock(), ['endpoint' => $endpoint]);
        $viaStatic = Client::make($this->httpClientMock(), ['endpoint' => $endpoint]);

        $callback = [
            'Gw-Dlr-Mask' => true,
            'Gw-Dlr-Url'  => $endpoint,
        ];

        $this->assertInstanceOf('Firemobile\Client', $client);
        $this->assertInstanceOf('Firemobile\Client', $viaStatic);
        $this->assertEquals(['endpoint' => $endpoint], $client->config());
        $this->assertInstanceOf(ClientInterface::class, $client->httpClient());
        $this->assertEquals(json_encode(['endpoint' => $endpoint]), $client);
        $this->assertEquals($client->endpoint(), $endpoint);

        $this->assertInstanceOf('Firemobile\Client', $client->callback($endpoint));
        $this->assertEquals($client->callbackurl(), $endpoint);
        $this->assertEquals($client->receivedCallback(), true);
        $this->assertEquals(array_merge(['endpoint' => $endpoint], $callback), $client->config());
    }
}

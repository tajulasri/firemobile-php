<?php

namespace Tests;

use Firemobile\Client;
use Firemobile\FiremobileAuth;
use Firemobile\Tests\TestCase;

class FiremobileAuthTest extends TestCase
{
    public function testItInstantiateClass()
    {
        $instance = new FiremobileAuth(Client::make($this->httpClientMock(), []));
        $viaStatic = FiremobileAuth::make(Client::make($this->httpClientMock(), []));

        $this->assertInstanceOf('Firemobile\FiremobileAuth', $instance);
        $this->assertInstanceOf('Firemobile\FiremobileAuth', $viaStatic);
    }

    public function testItReturnCorrectCredentials()
    {
        $data = 'test';

        $auth = FiremobileAuth::make(new Client($this->httpClientMock(), [
            'username' => $data,
            'password' => $data,
        ]));

        $this->assertEquals(['Gw-Username' => $data, 'Gw-Password' => $data], $auth->credentials());
        $this->assertInstanceOf('Firemobile\Client', $auth->client());
    }
}

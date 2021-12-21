<?php

namespace Tests;

use Firemobile\Client;
use Firemobile\FiremobileAuth;
use Firemobile\Message;
use Firemobile\Tests\TestCase;

class FiremobileAuthTest extends TestCase
{
    public function test_it_instantiate_class()
    {
        $instance = new FiremobileAuth(Client::make($this->httpClientMock(), []));
        $viaStatic = FiremobileAuth::make(Client::make($this->httpClientMock(), []));

        $this->assertInstanceOf('Firemobile\FiremobileAuth', $instance);
        $this->assertInstanceOf('Firemobile\FiremobileAuth', $viaStatic);
    }

    public function test_it_return_correct_credentials()
    {
        $data = 'test';

        $auth = FiremobileAuth::make(new Client($this->httpClientMock(), [
            'username' => $data,
            'password' => $data,
        ]));

        $this->assertEquals(['gw-username' => $data, 'gw-password' => $data], $auth->credentials());
        $this->assertInstanceOf('Firemobile\Client', $auth->client());

    }

}

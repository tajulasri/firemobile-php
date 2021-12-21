<?php

namespace Tests;

use Firemobile\Client;
use Firemobile\FiremobileAuth;
use Firemobile\Message;
use PHPUnit\Framework\TestCase;

class FiremobileAuthTest extends TestCase
{
    public function test_it_instantiate_class()
    {
        $instance = new FiremobileAuth(Client::make(null, []));
        $this->assertInstanceOf('Firemobile\FiremobileAuth', $instance);
    }

}

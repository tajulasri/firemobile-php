<?php

namespace Tests;

use Firemobile\Message;
use Firemobile\Tests\TestCase;

class MessageTest extends TestCase
{
    public function testItInstantiateMessage()
    {
        $message = new Message();
        $viaStatic = Message::make();

        $this->assertInstanceOf('Firemobile\Message', $message);
        $this->assertInstanceOf('Firemobile\Message', $viaStatic);
    }

    public function testReturnCorrectGetter()
    {
        $data = 'test';

        $message = Message::make()->setFrom($data)->setTo($data)->setText($data);

        $this->assertEquals($message->from(), $data);
        $this->assertEquals($message->to(), $data);
        $this->assertEquals($message->text(), $data);
    }

    public function testDataShouldMergeFiremobileParams()
    {
        $data = 'test';

        $message = Message::make()->setFrom($data)->setTo($data)->setText($data);
        $this->assertEquals($message->message(), ['Gw-To' => $data, 'Gw-From' => $data, 'Gw-Text' => $data]);
    }
}

<?php

namespace Tests;

use Firemobile\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function test_it_instantiate_message()
    {
        $message = new Message();
        $this->assertInstanceOf('Firemobile\Message', $message);
    }

    public function test_return_correct_getter()
    {
        $data = 'test';
        $message = Message::make()->setFrom($data)->setTo($data)->setText($data);
        $this->assertEquals($message->from(), $data);
        $this->assertEquals($message->to(), $data);
        $this->assertEquals($message->text(), $data);
    }

    public function test_data_should_merge_firemobile_params()
    {
        $data = 'test';

        $message = Message::make()->setFrom($data)->setTo($data)->setText($data);
        $this->assertEquals($message->message(), ['gw-to' => $data, 'gw-from' => $data, 'gw-text' => $data]);
    }
}
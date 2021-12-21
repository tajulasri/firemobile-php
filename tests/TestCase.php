<?php
namespace Firemobile\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as PHPUnit;
use Psr\Http\Client\ClientInterface;

class TestCase extends PHPUnit
{
    /**
     * @return mixed
     */
    public function httpClientMock()
    {
        return $this->getMockBuilder('GuzzleHttp\Client')->getMock();
    }

    /**
     * @return mixed
     */
    public function successSmsSendMock(): ClientInterface
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'status=0&msgid='.$this->getTestMsgId()),
            new Response(202, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request('POST', 'test')),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        return $client;

    }

    protected function getTestMsgId(): string
    {
        return 'cust20013050311050614001';
    }
}

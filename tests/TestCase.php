<?php
namespace Firemobile\Tests;

use PHPUnit\Framework\TestCase as PHPUnit;

class TestCase extends PHPUnit
{
    /**
     * @return mixed
     */
    public function httpClientMock()
    {
        return $this->getMockBuilder('GuzzleHttp\Client')->getMock();
    }
}

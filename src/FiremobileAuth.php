<?php

namespace Firemobile;

use Firemobile\Contracts\Authenticable;

class FiremobileAuth implements Authenticable
{
    /**
     * @var mixed
     */
    protected $client;

    /**
     * @param $config
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $config
     */
    public static function make(Client $client): self
    {
        return new self($client);
    }

    public function credentials(): array
    {
        return [
            'Gw-Username' => $this->client->config()['username'],
            'Gw-Password' => $this->client->config()['password'],
        ];
    }

    /**
     * @return mixed
     */
    public function client(): Client
    {
        return $this->client;
    }
}

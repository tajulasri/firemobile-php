<?php

namespace Firemobile\Requests;

use Firemobile\Contracts\Authenticable;
use Firemobile\Message;
use Firemobile\Request;

class Sms extends Request
{
    /**
     * @var mixed
     */
    protected $auth;

    /**
     * @var mixed
     */
    protected $message;

    public function __construct(Message $message, Authenticable $auth)
    {
        $this->auth = $auth;
        $this->message = $message;
    }

    public static function make(Message $message, Authenticable $auth)
    {
        return new self($message, $auth);
    }

    /**
     * @return mixed
     */
    public function send()
    {
        $endpoint = $this->auth->client()->endpoint();

        $body = $this->mergeApiBody(
            array_merge(
                $this->auth->credentials(),
                $this->message->message(),
                $this->auth->client()->callbackBody()
            )
        );

        $response = $this->auth->client()->httpClient()
            ->post($endpoint.'/sendsms', [
                'form_params' => $body,
            ]);

        return $this->responseWith($response);
    }
}

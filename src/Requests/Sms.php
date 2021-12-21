<?php
namespace Firemobile\Requests;

use Firemobile\Authenticable;
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

    /**
     * @param Authenticable $auth
     */
    public function __construct(Message $message, Authenticable $auth)
    {
        $this->auth = $auth;
        $this->message = $message;
    }

    /**
     * @param Message $message
     * @param Authenticable $auth
     */
    public static function make(Message $message, Authenticable $auth)
    {
        return new self($message, $auth);
    }

    /**
     * @return mixed
     */
    public function send()
    {
        $response = $this->auth->client->httpClient()
            ->post('/sendsms', [
                'form_params' => $this->mergeApiBody($this->auth->credentials(), $this->message->message()),
            ]);

        return $this->responseWith($response);
    }
}

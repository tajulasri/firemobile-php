<?php
namespace Firemobile;

class Message
{
    /**
     * @var mixed
     */
    protected $from;

    /**
     * @var mixed
     */
    protected $to;

    /**
     * @var mixed
     */
    protected $text;

    public static function make()
    {
        return new self;
    }

    /**
     * @param  $from
     * @return mixed
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param  $from
     * @return mixed
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param  $from
     * @return mixed
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function from()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function to()
    {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function text()
    {
        return $this->text;
    }

    public function message()
    {
        return [
            'gw-from' => $this->from(),
            'gw-to'   => $this->to(),
            'gw-text' => $this->text(),
        ];
    }
}

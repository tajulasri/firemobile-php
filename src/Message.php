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

    public static function make(): self
    {
        return new self();
    }

    /**
     * @param $from
     *
     * @return mixed
     */
    public function setFrom(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @param $from
     *
     * @return mixed
     */
    public function setTo(string $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param $from
     *
     * @return mixed
     */
    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function from(): string
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function to(): string
    {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function text(): string
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function message(): array
    {
        return [
            'Gw-From' => $this->from(),
            'Gw-To'   => $this->to(),
            'Gw-Text' => $this->text(),
        ];
    }
}

<?php

namespace App\Mail\Event;

class Message
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string|array
     */
    private $sendTo;

    /**
     * @param string $sendTo
     * @param string $subject
     * @param string $template
     * @param mixed $data
     */
    public function __construct($sendTo, $subject, $template, $data = null)
    {
        $this->sendTo = $sendTo;
        $this->subject = $subject;
        $this->template = $template;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function template(): string
    {
        return $this->template;
    }

    public function sendTo()
    {
        return $this->sendTo;
    }

    /**
     * @return string
     */
    public function subject(): string
    {
        return $this->subject;
    }

    /**
     * @return mixed|null
     */
    public function data()
    {
        return $this->data;
    }
}
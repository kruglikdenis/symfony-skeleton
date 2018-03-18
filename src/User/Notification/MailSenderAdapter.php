<?php

namespace App\Mail\EventListener;


use App\Mail\Message;
use App\Mail\Sender;

class MailSenderAdapter
{
    /**
     * @var Sender
     */
    private $sender;

    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    public function send(Message $message): void
    {
        $this->sender->send($message);
    }
}
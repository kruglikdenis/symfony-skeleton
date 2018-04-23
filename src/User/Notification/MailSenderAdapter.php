<?php

namespace App\User\Notification\EventListener;


use App\Core\Service\Mail\Message;
use App\Core\Service\Mail\Sender;

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
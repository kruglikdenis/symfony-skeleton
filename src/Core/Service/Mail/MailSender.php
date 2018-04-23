<?php

namespace App\Core\Service\Mail;


class MailSender implements Sender
{
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(Message $notification): void
    {
        $notification->send($this->mailer);
    }
}
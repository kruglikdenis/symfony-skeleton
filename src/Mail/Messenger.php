<?php

namespace App\Mail;

use App\Mail\Event\MailSender;
use App\Mail\Event\Message;
use Symfony\Bundle\TwigBundle\TwigEngine;

class Messenger implements MailSender
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var TwigEngine
     */
    private $renderer;

    /**
     * @var string
     */
    private $from;

    public function __construct(\Swift_Mailer $mailer, TwigEngine $renderer, string $from)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
        $this->from = $from;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Message $email): void
    {
        $message = (new \Swift_Message($email->subject()))
            ->setFrom($this->from)
            ->setTo($email->sendTo())
            ->setBody($this->renderer->render(
                $email->template(),
                $email->data()
            ));

        $this->mailer->send($message);
    }
}
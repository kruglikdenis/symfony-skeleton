<?php

namespace App\Mail;

use App\Mail\Event\MailSender;
use App\Mail\Event\Message;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class Messenger implements MailSender
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var EngineInterface
     */
    private $renderer;

    /**
     * @var string
     */
    private $from;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $renderer, string $from)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
        $this->from = $from;
    }

    public function send(Message $email)
    {
        $message = (new \Swift_Message($email->subject()))
            ->setFrom($this->from)
            ->setTo($email->sendTo())
            ->setBody($this->renderer->render(
                $email->template(),
                $email->data()
            ));
        // TODO: Implement send() method.
    }
}
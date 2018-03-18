<?php

namespace App\Mail;


class Mail implements Message
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

    public function send(Mailer $mailer): void
    {
        $template = (new \Swift_Message($this->subject))
            ->setFrom($mailer->from())
            ->setTo($this->sendTo)
            ->setBody($mailer->render($this->template, $this->data));

        $mailer->send($template);
    }
}
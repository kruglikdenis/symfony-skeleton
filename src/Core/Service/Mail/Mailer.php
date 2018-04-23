<?php

namespace App\Core\Service\Mail;

use Symfony\Bundle\TwigBundle\TwigEngine;

class Mailer
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
     * Get from mail
     *
     * @return string
     */
    public function from(): string
    {
        return $this->from;
    }

    /**
     * Render template
     *
     * @param string $template
     * @param array $data
     *
     * @return string
     */
    public function render(string $template, array $data = null)
    {
        return $this->renderer->render($template, $data);
    }

    /**
     * Send message
     *
     * @param \Swift_Message $message
     */
    public function send(\Swift_Message $message)
    {
        $this->mailer->send($message);
    }
}
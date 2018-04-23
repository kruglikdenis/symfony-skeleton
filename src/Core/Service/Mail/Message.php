<?php

namespace App\Core\Service\Mail;


interface Message
{
    /**
     * Send message
     *
     * @param Mailer $mailer
     */
    public function send(Mailer $mailer): void;
}
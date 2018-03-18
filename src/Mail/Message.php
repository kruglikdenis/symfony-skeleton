<?php

namespace App\Mail;


interface Message
{
    /**
     * Send message
     *
     * @param Mailer $mailer
     */
    public function send(Mailer $mailer): void;
}
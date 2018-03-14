<?php

namespace App\Mail\EventListener;

interface MailSender
{
    /**
     * Send email
     *
     * @param Message $email
     */
    public function send(Message $email): void;
}
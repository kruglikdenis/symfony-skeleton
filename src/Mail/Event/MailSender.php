<?php

namespace App\Mail\Event;

interface MailSender
{
    /**
     * Send email
     *
     * @param Message $email
     */
    public function send(Message $email): void;
}
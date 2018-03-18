<?php

namespace App\Mail;

interface Sender
{
    /**
     * Send message
     *
     * @param Message $notification
     */
    public function send(Message $notification): void;
}
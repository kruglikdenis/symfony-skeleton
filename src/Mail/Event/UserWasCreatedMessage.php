<?php

namespace App\Mail\Event;


use App\User\Event\UserWasCreated;

class UserWasCreatedMessage extends Message
{
    public const SUBJECT = 'Registration';

    public const TEMPLATE = 'registration.html.twig';

    public static function build(UserWasCreated $event)
    {
        $user = $event->user();

        return new self(
           (string) $user->email(),
           static::SUBJECT,
           static::TEMPLATE,
           [
               'user' => $user
           ]
        );
    }
}
<?php

namespace App\User\Notification\EventListener;


use App\Core\Service\Mail\Mail;
use App\User\Entity\UserWasCreated;

class UserWasCreatedMessageBuilder
{
    private const SUBJECT = 'Registration';

    private const TEMPLATE = 'registration.html.twig';

    public static function build(UserWasCreated $event)
    {
        $user = $event->user();

        return new Mail(
           (string) $user->email(),
           static::SUBJECT,
           static::TEMPLATE,
           [
               'user' => $user
           ]
        );
    }
}
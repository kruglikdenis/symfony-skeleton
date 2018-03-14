<?php

namespace App\Mail\EventListener;


use App\User\Entity\UserWasCreated;

class SendEmailAfterUserIsCreatedListener
{
    /**
     * @var MailSender
     */
    private $sender;

    public function __construct(MailSender $sender)
    {
        $this->sender = $sender;
    }

    public function __invoke(UserWasCreated $event)
    {
        $message = UserWasCreatedMessage::build($event);

        $this->sender->send($message);
    }
}
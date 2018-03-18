<?php

namespace App\Mail\EventListener;


use App\Mail\Sender;
use App\User\Entity\UserWasCreated;

class SendEmailAfterUserIsCreatedListener
{
    /**
     * @var Sender
     */
    private $sender;

    public function __construct(MailSenderAdapter $sender)
    {
        $this->sender = $sender;
    }

    public function __invoke(UserWasCreated $event)
    {
        $message = UserWasCreatedMessageBuilder::build($event);

        $this->sender->send($message);
    }
}
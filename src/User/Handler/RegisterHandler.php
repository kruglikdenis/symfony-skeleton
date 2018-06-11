<?php

namespace App\User\Handler;


use App\Security\Entity\Credential;
use App\User\Entity\User;
use App\User\Entity\Users;
use App\User\Http\RegisterCommand;
use Broadway\CommandHandling\SimpleCommandHandler;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class RegisterHandler extends SimpleCommandHandler
{
    /**
     * @var Users
     */
    private $users;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoder;

    public function __construct(Users $users, EncoderFactoryInterface $encoder)
    {
        $this->users = $users;
        $this->encoder = $encoder;
    }

    public function handleRegisterCommand(RegisterCommand $command): void
    {
        $request = $command->request();
        $user = User::builder()
            ->setEmail($request->email)
            ->setPassword($request->password, $this->encoder->getEncoder(Credential::class))
            ->setFullName($request->firstName, $request->lastName, $request->middleName)
            ->build();

        $this->users->add($user);
    }
}
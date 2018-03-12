<?php

namespace App\User\Service;


use App\User\Entity\User;
use App\User\Entity\Users;
use App\User\Http\RegisterRequest;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserRegisterer
{
    /**
     * @var Users
     */
    private $users;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoder;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(Users $users, EncoderFactoryInterface $encoder, ValidatorInterface $validator)
    {
        $this->users = $users;
        $this->encoder = $encoder;
        $this->validator = $validator;
    }

    public function register(RegisterRequest $request): User
    {
        $user = User::builder()
            ->setEmail($request->email)
            ->setPassword($request->password, $this->encoder)
            ->setFullName($request->firstName, $request->lastName, $request->middleName)
            ->build();

        $user->validate($this->validator);
        $this->users->add($user);
        return $user;
    }
}
<?php

namespace App\User\Http;


use App\Core\Doctrine\Flush;
use App\Core\Http\Annotation\ResponseCode;
use App\Core\Http\Annotation\ResponseGroups;
use App\Security\Entity\Credential;
use App\User\Entity\User;
use App\User\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * @Route("/users")
 */
class RegisterAction
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

    /**
     * @Method({"POST"})
     * @Route("/register")
     * @ResponseGroups({"api_user_register"})
     * @ResponseCode(201)
     *
     * @param RegisterRequest $request
     * @param Flush $flush
     * @return User
     */
    public function __invoke(RegisterRequest $request, Flush $flush)
    {
        $user = User::builder()
            ->setEmail($request->email)
            ->setPassword($request->password, $this->encoder->getEncoder(Credential::class))
            ->setFullName($request->firstName, $request->lastName, $request->middleName)
            ->build();

        $this->users->add($user);

        $flush();

        return $user;
    }
}
<?php

namespace App\DataFixture\ORM;


use App\Security\Entity\Credential;
use App\User\Entity\User;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class LoadUsers extends AbstractFixture implements OrderedFixtureInterface
{
    const FIXTURES_COUNT = 10;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoder;

    public function __construct(EncoderFactoryInterface $encoder)
    {
        $this->encoder = $encoder;

        parent::__construct();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);
        $this->loadDefaultUser($manager);

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadUsers(ObjectManager $manager)
    {
        foreach (range(1, self::FIXTURES_COUNT) as $i) {
            $user = User::builder()
                ->setEmail($this->faker->email)
                ->setPassword($this->faker->password, $this->encoder->getEncoder(Credential::class))
                ->setFullName($this->faker->firstName, $this->faker->lastName, $this->faker->firstName)
                ->build();

            $this->setReference("user-{$i}", $user);
            $manager->persist($user);
        }
    }

    /**
     * @param ObjectManager $manager
     */
    private function loadDefaultUser(ObjectManager $manager)
    {
        $user = User::builder()
            ->setEmail('default@mail.com')
            ->setPassword('default', $this->encoder->getEncoder(Credential::class))
            ->setFullName($this->faker->firstName, $this->faker->lastName, $this->faker->name)
            ->build();

        $this->setReference('user-0', $user);
        $manager->persist($user);
    }

    public function getOrder()
    {
        return 2;
    }
}
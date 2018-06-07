<?php
namespace App\Test\User\Entity;

use App\Security\Entity\Credential;
use App\Security\Entity\Email;
use App\User\Entity\FullName;
use App\User\Entity\User;
use Codeception\Test\Unit;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

class UserBuilderTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testBuildWithCorrectData()
    {
        $email = 'test@email.com';

        $user = User::builder()
            ->setEmail($email)
            ->setFullName('test', 'test', 'test')
            ->setPassword('password', new BCryptPasswordEncoder(12))
            ->build();

        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Email::class, $user->email());
        $this->assertEquals($email, $user->email());
        $this->assertAttributeNotEmpty('id', $user);
        $this->assertAttributeInstanceOf(Credential::class, 'credential', $user);
        $this->assertAttributeInstanceOf(FullName::class, 'fullName', $user);
    }
}
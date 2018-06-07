<?php

namespace App\Test\Security\Entity;

use App\Security\Entity\Email;
use App\Core\Exception\InvalidArgumentException;
use Codeception\Test\Unit;

class EmailTest extends Unit
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

    public function testCreateEmailWithCorrectData()
    {
        $email = new Email('  email@Test.com   ');

        $this->assertAttributeNotEmpty('email', $email);
        $this->assertAttributeEquals('email@test.com', 'email', $email);
    }

    public function testCreateEmailWithIncorrectData()
    {
        $this->expectException(InvalidArgumentException::class);

        $email = new Email('incorrect email');
        $this->assertAttributeEmpty('email', $email);
    }
}
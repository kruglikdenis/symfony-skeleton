<?php

namespace App\Test\User;


class RegisterUserCest
{
    private $endpoint = 'users/register';

    public function _before(\ApiTester $I)
    {
    }

    public function _after(\ApiTester $I)
    {
    }

    public function registerUserTest(\ApiTester $I)
    {
        $I->sendPOST($this->endpoint, [
            'email' => 'test@email.com',
            'password' => 'password',
            'first_name' => 'first_name',
            'last_name' => 'first_name',
            'middle_name' => 'first_name'
        ]);

        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
    }

    public function registerUserWithIncorrectDataTest(\ApiTester $I)
    {
        $I->sendPOST($this->endpoint, [
            'email' => 'test@email.com',
        ]);

        $I->seeResponseCodeIs(422);
    }
}

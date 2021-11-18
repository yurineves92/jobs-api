<?php

use App\User;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->seeStatusCode(422)
            ->seeJson([
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]);
    }

    public function testUserLoginSuccessfully()
    {
        /* for create users
        $user = factory(User::class)->create([
            'email' => 'testlogin@user.com',
            'password' => app('hash')->make('123456')
        ]);
        */
        $payload = ['email' => 'admin@test.com', 'password' => '123456'];

        $this->json('POST', 'api/login', $payload)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'token',
                'token_type',
                'expires_in'
            ]);
    }

    public function testUserRegisterSuccessfully()
    {
        $payload = [
            'name' => 'Testing User',
            'email' => 'testinguser@test.com',
            'password' => '123456',
            'password_confirmation' => '123456',
            'type_user' => 1
        ];

        // $this->json('POST', 'api/register', $payload)
        //     ->seeStatusCode(201)
        //     ->seeJsonStructure([
        //         'user' => [
        //             'name',
        //             'email',
        //             'type_user',
        //             'updated_at',
        //             'created_at',
        //             'id'
        //         ],
        //         'message'
        //     ]);
    }
}

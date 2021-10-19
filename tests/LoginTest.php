<?php

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

    public function testUserLoginsSuccessfully()
    {
        // $user = factory(User::class)->create([
        //     'email' => 'testlogin@user.com',
        //     'password' => Hash::make('123456'),
        // ]);

        $payload = ['email' => 'testlogin@user.com', 'password' => '123456'];

        $this->json('POST', 'api/login', $payload)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'token',
                'token_type',
                'expires_in'
            ]);
    }
}
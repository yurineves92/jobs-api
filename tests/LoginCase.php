<?php

use Laravel\Lumen\Testing\TestCase;

class LoginCase extends TestCase 
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
    
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
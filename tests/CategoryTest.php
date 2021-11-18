<?php

use App\User;
use Illuminate\Support\Facades\Auth;

class CategoryTest extends TestCase
{
    private $_token;

    private function getAuthentication()
    {
        $this->_token = Auth::attempt(['email' => 'admin@test.com', 'password' => '123456']);
    }

    public function testShouldReturnAllCategories()
    {
        $this->getAuthentication();
        $headers = ['Authorization' => 'Bearer '.$this->_token];
        $this->json('get', 'api/categories', [], $headers)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                [
                    'id',
                    'name',
                    'created_at'
                ]
            ]);
    }
}
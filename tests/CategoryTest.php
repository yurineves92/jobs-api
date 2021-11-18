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
        $headers = ['Authorization' => 'Bearer ' . $this->_token];
        $this->json('GET', 'api/categories', [], $headers)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                [
                    'id',
                    'name',
                    'created_at'
                ]
            ]);
    }

    public function testShouldReturnCategory()
    {
        $this->getAuthentication();
        $headers = ['Authorization' => 'Bearer ' . $this->_token];
        $this->json('GET', 'api/categories/1', [], $headers)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'id',
                'name',
                'created_at'
            ]);
    }

    public function testShouldCreateCategory()
    {
        $this->getAuthentication();

        $params = ['name' => 'Test Category'];

        $headers = ['Authorization' => 'Bearer ' . $this->_token];
        $this->json('POST', 'api/categories', $params, $headers)
            ->seeStatusCode(201)
            ->seeJsonStructure([
                'id',
                'name',
                'created_at'
            ]);
    }
}

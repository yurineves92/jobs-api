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

    /**
     * /api/categories [GET]
     */
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

    /**
     * /api/categories/1 [GET]
     */
    public function testShouldReturnOneCategory()
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

    /**
     * /api/categories [POST]
     */
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

    /**
     * /api/categories/1 [PUT]
     */
    public function testShouldUpdateCategory()
    {
        $this->getAuthentication();

        $params = ['name' => 'Test Category 1 Updated'];

        $headers = ['Authorization' => 'Bearer ' . $this->_token];
        $this->json('PUT', 'api/categories/1', $params, $headers)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'id',
                'name',
                'created_at'
            ]);
    }

    /**
     * /api/categories/1 [DELETE]
     */
    public function testShouldDeleteCategory()
    {
        $this->getAuthentication();

        $headers = ['Authorization' => 'Bearer ' . $this->_token];
        $this->json('DELETE', 'api/categories/53', [], $headers)
            ->seeStatusCode(200);
    }
}

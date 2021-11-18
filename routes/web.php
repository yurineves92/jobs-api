<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {

    // Authentication
    $router->post('login', ['uses' => 'AuthController@login']);
    $router->post('register', ['uses' => 'AuthController@register']);

    // get profile user
    $router->get('profile', 'UserController@profile');

    // get one user by id
    $router->get('users/{id}', 'UserController@singleUser');

    // get all users
    $router->get('users', 'UserController@allUsers');
    
    $router->group(['middleware' => 'auth'], function () use ($router) {
        // Auth
        $router->post('logout', ['uses' => 'AuthController@logout']);
        
        // Categories
        $router->get('categories', ['uses' => 'CategoryController@showAllCategories']);
        $router->get('categories/{id}', ['uses' => 'CategoryController@showOneCategory']);
        $router->post('categories', ['uses' => 'CategoryController@create']);
        $router->delete('categories/{id}', ['uses' => 'CategoryController@delete']);
        $router->put('categories/{id}', ['uses' => 'CategoryController@update']);

        // Jobs
        $router->get('jobs', ['uses' => 'JobController@showAllJobs']);
        $router->get('jobs/{id}', ['uses' => 'JobController@showOneJobs']);
        $router->post('jobs', ['uses' => 'JobController@create']);
        $router->delete('jobs/{id}', ['uses' => 'JobController@delete']);
        $router->put('jobs/{id}', ['uses' => 'JobController@update']);

        // Users Applied Jobs
        $router->post('userAppliedJob', ['uses' => 'UserController@appliedJob']);
        $router->post('replyingUser', ['uses' => 'UserController@replyingUser']);

        // Companies
        $router->get('listApplied', ['uses' => 'CompanyController@listApplied']);
        $router->post('createJob', ['uses' => 'CompanyController@createJob']);
    });
});

<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use Dingo\Api\Routing\Router;

/* @var Router $api */
$api = app(Router::class);
$api->version(config('api.version'), ['namespace' => 'App\Http\Controllers\Api\v1'], function (Router $api) {

    $api->post('auth/login', 'AuthApiController@login');
    $api->put('auth/refresh', 'AuthApiController@refreshToken');
    $api->delete('auth', 'AuthApiController@logout')->middleware('api.auth');

    $api->post('auth/password/reset', 'ForgotPasswordApiController@sendResetLinkEmail');
    $api->put('auth/password/reset', 'ResetPasswordApiController@reset');

    $api->group(['middleware' => ['jwt.auth', 'bindings']], function (Router $api) {
        $api->get('auth/user', 'AuthApiController@user');

        $api->resource('users', 'UsersController');
    });

});
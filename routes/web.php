<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\Http\Controllers\HomeController;
use Saritasa\Laravel\Controllers\Web\WebResourceRegistrar;

$router = app('router');
$web = new WebResourceRegistrar($router);

$router->any('/{all?}', 'HomeController@index');
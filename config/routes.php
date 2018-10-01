<?php

use App\Models\Users;

$router->add('GET', '/', '\App\Controllers\HomeController::index');

$router->add('GET', '/users', '\App\Controllers\UsersController::index');
$router->add('GET', '/users/(\d+)', '\App\Controllers\UsersController::show');
$router->add('POST', '/users', '\App\Controllers\UsersController::create');
$router->add('PUT', '/users/(\d+)', '\App\Controllers\UsersController::update');
$router->add('DELETE', '/users/(\d+)', '\App\Controllers\UsersController::delete');
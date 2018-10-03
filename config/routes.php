<?php

$router->add('GET', '/login', '\App\Controllers\AuthController::login');
$router->add('POST', '/auth', '\App\Controllers\AuthController::auth');
$router->add('GET', '/logout', '\App\Controllers\AuthController::logout');
$router->add('GET', '/new-register', '\App\Controllers\AuthController::newRegister');
$router->add('POST', '/create', '\App\Controllers\AuthController::create');

$router->add('GET', '/', '\App\Controllers\HomeController::index');

$router->add('GET', '/users', '\App\Controllers\UsersController::index');
$router->add('GET', '/users/(\d+)', '\App\Controllers\UsersController::show');
$router->add('POST', '/users', '\App\Controllers\UsersController::create');
$router->add('PUT', '/users/(\d+)', '\App\Controllers\UsersController::update');
$router->add('DELETE', '/users/(\d+)', '\App\Controllers\UsersController::delete');
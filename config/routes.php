<?php

$router->add('GET', '/auth/login', '\App\Controllers\AuthController::login');
$router->add('POST', '/auth', '\App\Controllers\AuthController::auth');
$router->add('GET', '/auth/logout', '\App\Controllers\AuthController::logout');
$router->add('GET', '/auth/new-register', '\App\Controllers\AuthController::newRegister');
$router->add('POST', '/auth/create', '\App\Controllers\AuthController::create');

$router->add('GET', '/', '\App\Controllers\HomeController::index');

$router->add('GET', '/users', '\App\Controllers\UsersController::index');
$router->add('GET', '/users/(\d+)', '\App\Controllers\UsersController::show');
$router->add('POST', '/users', '\App\Controllers\UsersController::create');
$router->add('PUT', '/users/(\d+)', '\App\Controllers\UsersController::update');
$router->add('DELETE', '/users/(\d+)', '\App\Controllers\UsersController::delete');

$router->add('GET', '/conta', '\App\Controllers\ContaController::index');
$router->add('POST', '/conta/create', '\App\Controllers\ContaController::create');

$router->add('GET', '/banco', '\App\Controllers\BancoController::index');
$router->add('GET', '/bancos', '\App\Controllers\BancoController::all');
$router->add('POST', '/banco/create', '\App\Controllers\BancoController::create');
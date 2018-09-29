<?php

use App\Models\Users;

$router->add('GET', '/', function() use ($container) {
    return "Home Page";
});

$router->add('GET', '/users/(\d+)', '\App\Controllers\UsersController::show');

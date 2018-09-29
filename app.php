<?php

require __DIR__ . '/vendor/autoload.php'; 

$router = new App\Mfw\Router;

require __DIR__ . '/config/containers.php';
require __DIR__ . '/config/routes.php';


try {

    $result = $router->run();

    $response = new \App\Mfw\Response;
    $params = [
        'container' => $container,
        'params' => $result['params']
    ];
    $response($result['action'], $params);

} catch (\App\Mfw\Exceptions\HttpException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}


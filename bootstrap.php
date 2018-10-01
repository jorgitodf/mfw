<?php

require __DIR__ . '/vendor/autoload.php'; 

require __DIR__ . '/config/containers.php';

$app = new App\Mfw\App($container);

$router = $app->getRouter();

require __DIR__ . '/config/middlewares.php';
require __DIR__ . '/config/routes.php';

$app->run();




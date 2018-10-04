<?php

use Pimple\Container;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Extension_Debug;
use App\Helpers\Functions;

$container = new Container();

$container['settings'] = function() {
    return [
            'db' => [
                'dsn' => 'mysql:host=localhost;',
                'database' => 'framework',
                'username' => 'root',
                'password' => 'root',
                'options' => [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                ]
            ],
            'view' => [
                'template_path' => __DIR__ . '/../views',
            ],
        ];
};

$container['db'] = function($c) {
    
    $dsn = $c['settings']['db']['dsn'] . 'dbname=' . $c['settings']['db']['database'];
    $username = $c['settings']['db']['username'];
    $password = $c['settings']['db']['password'];
    $options = $c['settings']['db']['options'];

    try {

        $pdo = new \PDO($dsn, $username, $password, $options);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;

    } catch (\Exception $e) {
        if ($code == 1049) {
            echo "<h2>Database ". $c['settings']['db']['database'] . " não foi criado...</h2>";
        } else if ($code == 1045) {
            echo "<h2>O Username ou a Senha do Database está incorreto...</h2>"; 
        } else {
            echo $code;
        }
        die();
    }
};

$container['view'] = function($c) {
    $loader  = new Twig_Loader_Filesystem($c['settings']['view']['template_path']);
    $twig = new Twig_Environment($loader, array('debug' => true));
    $twig->addExtension(new Twig_Extension_Debug);
    $twig->addFunction(Functions::base_url());
    $twig->addFunction(Functions::isLogged());
    $twig->addFunction(Functions::csrf_token());
    return $twig;
};

$container['users_model'] = function($c) {
    return new \App\Models\Users($c);
};

return $container;
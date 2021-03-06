<?php

use Pimple\Container;
use App\Helpers\Functions;

$container = new Container();

$container['settings'] = function() {
    return [
            'db' => [
                'dsn' => 'mysql:host=localhost;',
                'database' => 'framework',
                'username' => 'admin',
                'password' => '123456',
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
    $twig->addFunction(Functions::hasConta());
    $twig->addFunction(Functions::mes());
    $twig->addFunction(Functions::insert_numbers($value));
    $twig->addFunction(Functions::ano());
    return $twig;
};

$container['users_model'] = function($c) {
    return new \App\Models\Users($c);
};

$container['banks_model'] = function($c) {
    return new \App\Models\Banks($c);
};

$container['accounts_model'] = function($c) {
    return new \App\Models\Accounts($c);
};

$container['account_type_model'] = function($c) {
    return new \App\Models\AccountType($c);
};

$container['scheduled_payments_model'] = function($c) {
    return new \App\Models\ScheduledPayments($c);
};

$container['categories_model'] = function($c) {
    return new \App\Models\Categories($c);
};

$container['extracts_model'] = function($c) {
    return new \App\Models\Extracts($c);
};

$container['flag_cards_model'] = function($c) {
    return new \App\Models\FlagCards($c);
};

$container['credit_cards_model'] = function($c) {
    return new \App\Models\CreditCards($c);
};

$container['expenses_card_model'] = function($c) {
    return new \App\Models\ExpensesCard($c);
};

$container['expenditure_installments_model'] = function($c) {
    return new \App\Models\ExpenditureInstallments($c);
};

$container['invoice_card_model'] = function($c) {
    return new \App\Models\InvoiceCard($c);
};

return $container;
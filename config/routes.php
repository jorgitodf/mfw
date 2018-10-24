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

$router->add('GET', '/conta/new', '\App\Controllers\ContaController::index');
$router->add('POST', '/conta/create', '\App\Controllers\ContaController::create');
$router->add('GET', '/conta/list', '\App\Controllers\ContaController::list');
$router->add('GET', '/conta/clean-session-conta', '\App\Controllers\ContaController::cleanSessionConta');
$router->add('GET', '/conta', '\App\Controllers\ContaController::cleanContaSession');
$router->add('GET', '/conta/debitar', '\App\Controllers\ContaController::debitar');
$router->add('POST', '/conta/debitar', '\App\Controllers\ContaController::debitar');
$router->add('GET', '/conta/creditar', '\App\Controllers\ContaController::creditar');
$router->add('POST', '/conta/creditar', '\App\Controllers\ContaController::creditar');

$router->add('GET', '/banco', '\App\Controllers\BancoController::index');
$router->add('GET', '/bancos', '\App\Controllers\BancoController::all');
$router->add('POST', '/banco/create', '\App\Controllers\BancoController::create');

$router->add('GET', '/extrato', '\App\Controllers\ExtratoController::index');
$router->add('GET', '/extrato/periodo', '\App\Controllers\ExtratoController::generateExtract');
$router->add('POST', '/extrato/periodo', '\App\Controllers\ExtratoController::generateExtract');

$router->add('GET', '/pagamento', '\App\Controllers\ScheduledPaymentController::index');
//$router->add('GET', '/pagamento', '\App\Controllers\ScheduledPaymentController::all');
$router->add('POST', '/pagamento/create', '\App\Controllers\ScheduledPaymentController::create');

$router->add('GET', '/bandeira', '\App\Controllers\BandeiraCartaoController::index');
$router->add('POST', '/bandeira/create', '\App\Controllers\BandeiraCartaoController::create');

$router->add('GET', '/cartao', '\App\Controllers\CartaoController::index');
$router->add('POST', '/cartao/create', '\App\Controllers\CartaoController::create');

$router->add('GET', '/despesa-cartao', '\App\Controllers\DespesaCartaoController::index');
$router->add('POST', '/despesa-cartao/create', '\App\Controllers\DespesaCartaoController::create');

$router->add('GET', '/fatura', '\App\Controllers\FaturaController::index');
$router->add('POST', '/fatura/generate', '\App\Controllers\FaturaController::generateInvoice');
$router->add('GET', '/fatura/pagar', '\App\Controllers\FaturaController::payInvoice');
$router->add('POST', '/fatura/pagar', '\App\Controllers\FaturaController::payInvoice');
$router->add('GET', '/fatura/descricao/(\d+)', '\App\Controllers\FaturaController::descriptionInvoice');
$router->add('POST', '/fatura/get-restante-fatura-anterior', '\App\Controllers\FaturaController::getRestanteFaturaAnterior');
<?php

namespace App\Controllers;

use App\Mfw\Password;

class HomeController
{
    protected function getModel(): string
    {
        return 'accounts_model';
    }

    public function index($c, $request)
    {
        $user = Password::getSessionUser();

        $contas = $c[$this->getModel()]->getAllById(['fk_users' => $user['idLoggedIn']]);
        if (!$contas) {
            $msg = "Prezado(a) {$user['name']}, você não possui nenhuma Conta Ativa ou Cadastrada.";
            $msg .= " Para acesso às funcionalidades do Sistema, favor cadastre uma Conta!";
        }

        return $c['view']->render('home/index.html.twig', ['title' => 'Página Home', 'data' => $msg, 'contas' => $contas]);
    }
}
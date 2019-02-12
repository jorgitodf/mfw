<?php

namespace App\Controllers;

use App\Mfw\Password;

class HomeController
{
    protected function getModel($model): string
    {
        if ($model == 'ac') {
            return 'accounts_model';
        } else if ($model == 'sp') {
            return 'scheduled_payments_model';
        }
    }

    public function index($c, $request)
    {
        $user = Password::getSessionUser();
        $idConta = Password::hasConta();
        
        $contas = $c[$this->getModel('ac')]->getAllById(['fk_users' => $user['idLoggedIn']]);

        if ($idConta) {
            $pgtos = $c[$this->getModel('sp')]->between(['fk_account' => $idConta], 'data_pagamento', ano().'-'.verificaMesNumerico().'-01', ano().'-'.verificaMesNumerico().'-31');
        }
 
        if (!$contas) {
            $msg = "Prezado(a) {$user['name']}, você não possui nenhuma Conta Ativa ou Cadastrada.";
            $msg .= " Para acesso às funcionalidades do Sistema, favor cadastre uma Conta!";
        }
    
        return $c['view']->render('home/index.html.twig', ['title' => 'Página Home', 'data' => $msg, 'contas' => $contas, 'pgtos' => $pgtos]);
    }
}
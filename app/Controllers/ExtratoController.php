<?php

namespace App\Controllers;

use App\Mfw\Password;

class ExtratoController
{
    protected function getModel($model): string
    {
        if ($model == 'ac') {
            return 'accounts_model';
        } else if ($model == 'ex') {
            return 'extracts_model';
        }
    }

    public function index($c, $request)
    {
        $user = Password::getSessionUser();
        $idConta = Password::hasConta();

        $contas = $c[$this->getModel('ac')]->getAllById(['fk_users' => $user['idLoggedIn']]);


        return $c['view']->render('extrato/index.html.twig', ['title' => 'Extrato Mês Atual', 'contas' => $contas]);
    }
}
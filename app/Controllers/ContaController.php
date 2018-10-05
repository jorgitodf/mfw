<?php

namespace App\Controllers;

class ContaController
{
    protected function getModel($model): string
    {
        if ($model == 'a') {
            return 'accounts_model';
        } else if ($model == 'ac') {
            return 'account_type_model';
        }
        
    }
    
    public function index($c, $request)
    {
        $tipo_conta = $c[$this->getModel('ac')]->allOrderBy('tipo_conta');
        return $c['view']->render('conta/index.html.twig', ['title' => 'Conta', 'tipo_conta' => $tipo_conta]);
    }

    public function create($c, $request)
    {
        return "Create";
    }
}
<?php

namespace App\Controllers;

use App\Mfw\Password;
use App\Validations\ValidationExtrato;

class ExtratoController
{
    private $userSession;
    private $contaSession;

    public function __construct()
    {
        $this->userSession = Password::getSessionUser();
        $this->contaSession = Password::hasConta();
        $this->validations = new ValidationExtrato();
    }

    protected function getModel($model): string
    {
        if ($model == 'ac') {
            return 'accounts_model';
        } else if ($model == 'ex') {
            return 'extracts_model';
        } else if ($model == 'cat') {
            return 'categories_model';
        }
    }

    public function index($c, $request)
    {
        $extrato = $c[$this->getModel('ex')]->innerJoin($c[$this->getModel('cat')]->getTable(), 
            'fk_category', $this->contaSession, 't1', 'fk_accounts', 't1.data_movimentacao', 
            data_inicial(), data_final());

        if (!$extrato) {
            $msg = "Não há nenhuma Movimentação em sua Conta neste Mês!!";
        }    

        return $c['view']->render('extrato/index.html.twig', ['title' => 'Extrato Mês Atual', 'extrato' => $extrato, 'msg' => $msg]);
    }

    public function generateExtract($c, $request)
    {
        if ($request->server->get('REQUEST_METHOD') == 'GET') {
            return $c['view']->render('extrato/periodo.html.twig', ['title' => 'Extrato Por Período']);
        }
        
        $data = $request->request->all();
        $error = $this->validations->validateExtrato($data);

        if (!$error) {
            $extrato = $c[$this->getModel('ex')]->innerJoin($c[$this->getModel('cat')]->getTable(), 
            'fk_category', $this->contaSession, 't1', 'fk_accounts', 't1.data_movimentacao', 
            $data['data_inicial'], $data['data_final']);
            status_code(201);
            return json_encode(['extrato' => $extrato, 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);


    }
}
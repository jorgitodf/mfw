<?php

namespace App\Controllers;

use App\Validations\ValidationConta;

class ContaController
{
    private $validations;

    public function __construct()
    {
        $this->validations = new ValidationConta();
    }

    protected function getModel($model): string
    {
        if ($model == 'a') {
            return 'accounts_model';
        } else if ($model == 'ac') {
            return 'account_type_model';
        } else if ($model == 'b') {
            return 'banks_model';
        }
    }
    
    public function index($c, $request)
    {
        $tipo_conta = $c[$this->getModel('ac')]->allOrderBy('tipo_conta');
        $bancos = $c[$this->getModel('b')]->allOrderBy('nome_banco');

        return $c['view']->render('conta/index.html.twig', ['title' => 'Conta', 'tipo_conta' => $tipo_conta, 'bancos' => $bancos]);
    }

    public function create($c, $request)
    {
        $data = $request->request->all();
        $error = $this->validations->validateConta($data, $c,$_SESSION['idLoggedIn']);

        if (!$error) {
            //$datas = $this->validations->formateDataConta($data);
            //$c[$this->getModel()]->create($datas);
            //status_code(201);
            //return json_encode(['success' => 'Conta Cadastrado com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }
}
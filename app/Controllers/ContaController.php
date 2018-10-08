<?php

namespace App\Controllers;

use App\Validations\ValidationConta;
use App\Mfw\Password;

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

    public function list($c, $request)
    {
        $idConta = $request->query->get('id_conta');
        $token = $request->query->get('_csrf_token');

        if ($token !== Password::getTokenUser()) {
            $erro['error-token-conta'] = "Operação não Autorizada!!";
            status_code(500);
            return json_encode(['error' => $error, 'status' => 500]);
        }

        Password::setHasConta($idConta);
        status_code(201);
        return json_encode(['base_url' => base_url(), 'success' => 'ok', 'status' => 201]);
    }

    public function cleanSessionConta($c, $request)
    {
        $token = $request->query->get('_csrf_token');

        if ($token !== Password::getTokenUser()) {
            $erro['error-token-conta'] = "Operação não Autorizada!!";
            status_code(500);
            return json_encode(['error' => $error, 'status' => 500]);
        }

        unset($_SESSION['hasConta']);
        status_code(201);
        return json_encode(['base_url' => base_url(), 'success' => 'ok', 'status' => 201]);
    }

    public function cleanContaSession($c, $request)
    {
        unset($_SESSION['hasConta']);
        $user = Password::getSessionUser();
        $contas = $c[$this->getModel('a')]->getAllById(['fk_users' => $user['idLoggedIn']]);

        if (!$contas) {
            $msg = "Prezado(a) {$user['name']}, você não possui nenhuma Conta Ativa ou Cadastrada.";
            $msg .= " Para acesso às funcionalidades do Sistema, favor cadastre uma Conta!";
        }

        return $c['view']->render('home/index.html.twig', ['title' => 'Página Home', 'data' => $msg, 'contas' => $contas]);
    }

    public function create($c, $request)
    {
        $data = $request->request->all();
        $error = $this->validations->validateConta($data, $c, $_SESSION['idLoggedIn']);

        if (!$error) {
            $datas = $this->validations->formateDataConta($data, $id);
            $c[$this->getModel('a')]->create($datas);
            status_code(201);
            return json_encode(['base_url' => base_url(), 'success' => 'Conta Cadastrada com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }
}
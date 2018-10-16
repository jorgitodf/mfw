<?php

namespace App\Controllers;

use App\Validations\ValidationCartaoCredito;
use App\Mfw\Password;

class CartaoController
{
    private $validations;

    public function __construct()
    {
        $this->validations = new ValidationCartaoCredito();
    }

    protected function getModel($model): string
    {
        if ($model == 'cc') {
            return 'credit_cards_model';
        } else if ($model == 'band') {
            return 'flag_cards_model';
        } else if ($model == 'bank') {
            return 'banks_model';
        }
    }


    public function index($c, $request)
    {
        $bandeiras = $c[$this->getModel('band')]->allOrderBy('bandeira');
        $bancos = $c[$this->getModel('bank')]->allOrderBy('nome_banco');
        return $c['view']->render('cartao/index.html.twig', ['title' => 'Novo Cartão de Crédito', 'bandeiras' => $bandeiras, 'bancos' => $bancos]);
    }

    public function create($c, $request)
    {
        $data = $request->request->all();
        $idUser = (int) Password::getSessionUser()["idLoggedIn"];
        $error = $this->validations->validateCartao($data, $c, $this->getModel('cc'), $idUser);

        if (!$error) {
            $datas = $this->validations->formateDataCartao($data, $idUser);
            $c[$this->getModel('cc')]->create($datas);
            status_code(201);
            return json_encode(['success' => 'Cartão Cadastrado com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }
}
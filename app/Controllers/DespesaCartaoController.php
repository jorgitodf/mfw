<?php

namespace App\Controllers;

use App\Mfw\Password;
use App\Validations\ValidationDespesaCartao;

class DespesaCartaoController
{
    private $validations;
    private $userSession;

    public function __construct()
    {
        $this->validations = new ValidationDespesaCartao();
        $this->userSession = Password::getSessionUser();
    }

    protected function getModel($model): string
    {
        if ($model == 'dp') {
            return 'expenses_card_model';
        } else if ($model == 'cc') {
            return 'credit_cards_model';
        } else if ($model == 'pd') {
            return 'expenditure_installments_model';
        }
    }

    public function index($c, $request)
    {
        $fields = ['t1.id', 'numero_cartao', 'bandeira', 'nome_banco'];
        $cartoes = $c[$this->getModel('cc')]->ThreeJoin($fields, 'banks', 'flag_cards', 'fk_banks', 'fk_flag_cards', 't1', 'fk_users', $this->userSession["idLoggedIn"], 't1', 't1');
        return $c['view']->render('cartao/despesa.html.twig', ['title' => 'Despesa de Cartão', 'cartoes' => $cartoes]);
    }

    public function create($c, $request)
    {
        $data = $request->request->all();
        $error = $this->validations->validateDespesaCartao($data);
        
        if (!$error) {
            $datasDesp = $this->validations->formateDataDespesaCartao($data);
            $res = $c[$this->getModel('dp')]->create($datasDesp);
            $datasParc = $this->validations->formateDataDespesaCartaoParcela($c, $data, $res["id"]);
            $c[$this->getModel('pd')]->create($datasParc);
            
            status_code(201);
            return json_encode(['success' => 'Despesa Cadastrada com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }
}
<?php

namespace App\Controllers;

use App\Mfw\Password;
use App\Validations\ValidationFatura;

class FaturaController
{
    private $validations;
    private $userSession;

    public function __construct()
    {
        $this->validations = new ValidationFatura();
        $this->userSession = Password::getSessionUser();
    }

    protected function getModel($model): string
    {
        if ($model == 'fat') {
            return 'invoice_card_model';
        } else if ($model == 'cc') {
            return 'credit_cards_model';
        } else if ($model == 'pd') {
            return 'expenditure_installments_model';
        }
    }

    public function index($c, $request)
    {
        $fields = ['t1.id', 'numero_cartao', 'bandeira', 'nome_banco'];
        $cartoes = $c[$this->getModel('cc')]->ThreeJoin($fields, 'banks', 'flag_cards', 'fk_banks', 'fk_flag_cards', 't1', 'fk_users', $this->userSession["idLoggedIn"]);
        return $c['view']->render('fatura/index.html.twig', ['title' => 'Fatura do Cartão', 'cartoes' => $cartoes]);
    }

    public function generateInvoice($c, $request)
    {
        $data = $request->request->all();
        $error = $this->validations->validateFatura($c, $data);
        
        if (!$error) {
            $datas = $this->validations->formateDataFatura($data);
            $c[$this->getModel('fat')]->create($datas);
            
            status_code(201);
            return json_encode(['success' => 'Fatura Gerada com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }
}
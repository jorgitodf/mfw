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
        $cartoes = $c[$this->getModel('cc')]->ThreeJoin($fields, 'banks', 'flag_cards', 'fk_banks', 'fk_flag_cards', 't1', 'fk_users', $this->userSession["idLoggedIn"], 't1', 't1');
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

    public function payInvoice($c, $request)
    {
        if ($request->server->get('REQUEST_METHOD') == 'GET') {
            $fields = ['t1.id', 'data_pagamento_fatura', 'numero_cartao', 'bandeira'];
            $faturas = $c[$this->getModel('fat')]->ThreeJoin($fields, 'credit_cards', 'flag_cards', 'fk_credit_cards', 'fk_flag_cards', 't1', 'pago', 'N', 't1', 't2');
            return $c['view']->render('fatura/pagar.html.twig', ['title' => 'Pagar Fatura', 'faturas' => $faturas]);
        }

        $data = $request->request->all();
        $error = $this->validations->validatePagarFatura($c, $data);
        
        if (!$error) {
            $fatura = $c[$this->getModel('fat')]->findBy(['id' => $data['fatura']]);
            status_code(202);
            return json_encode(['base_url' => base_url()."/fatura/descricao/{$fatura['fk_credit_cards']}", 'status' => 202]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }

    public function descriptionInvoice($c, $request)
    {
        if ($request->server->get('REQUEST_METHOD') == 'GET') {
            $idFatura = (int) $request->attributes->get(1);
            $fat = $c[$this->getModel('fat')]->findBy(['id' => $idFatura]);
            
            if ($fat) {
                $aFields = ['numero_cartao, nome_banco, bandeira, data_pagamento_fatura, fk_credit_cards'];
                $fatura = $c[$this->getModel('fat')]->getDataFaturaCreditCard($aFields, $fat["fk_credit_cards"], $idFatura);           
    
                $fields = ['t1.id, t1.valor', 't1.numero_parcela', 't2.descricao', 't2.data_compra', 't3.id AS id_fatura'];
                $itensFaturas = $c[$this->getModel('pd')]->ThreeJoin2Where($fields, 'expenses_card', 'invoice_card', 'id', 'data_pagamento_fatura', 
                'fk_expenses_card', 'data_pagamento', 't2', 'fk_credit_cards', $fatura['fk_credit_cards'],
                't1', 't1', 't3', 'id', $idFatura, 't2', 'data_compra');

                return $c['view']->render('fatura/fechar.html.twig', ['title' => 'Pagamento da Fatura', 'fatura' => $fatura, 'itensFatura' => $itensFaturas]);   
            }

            $erros = ['status' => 404, 'descricao' => 'Ops... Error 404 -> Página não encontrada...'];
            return $c['view']->render('error/404.html.twig', ['title' => "Error {$erros['status']}", 'error' => $erros['descricao']]);   
        }    
    }
}
<?php

namespace App\Validations;

use App\Mfw\Password;
use App\Mfw\Verifications;

class ValidationDespesaCartao
{
    private $erros = [];
    private $d = [];

    public function validateDespesaCartao($data)
    {
        if (empty($data['cartao'])) {
            $this->erros['error_cartao'] = "Informe o Cartão!";
        }

        if (empty($data['descricao'])) {
            $this->erros['error_descricao'] = "Preencha a Descrição!";
        } else if (!empty($data['descricao']) && is_numeric($data['descricao'])) {
            $this->erros['error_descricao'] = "Descrição sem Números!";
        } else if (strlen($data['descricao']) < 4) {
            $this->erros['error_descricao'] = "Descrição acima de 3 caracters!";
        }

        if (empty($data['data_compra'])) {
            $this->erros['error_data_compra'] = "Informe a Data da Compra!";
        } 

        if (empty($data['valor'])) {
            $this->erros['error_valor'] = "Preencha o Valor!";
        } else if (!empty($data['valor']) && !is_numeric(formatarMoeda($data['valor']))) {
            $this->erros['error_valor'] = "Valor somente Números!";
        }

        if (empty($data['numero_parcela'])) {
            $this->erros['error_numero_parcela'] = "Informe o Número de Parcela(s)!";
        } else if (!empty($data['numero_parcela']) && !is_numeric($data['numero_parcela'])) {
            $this->erros['error_numero_parcela'] = "Número de Parcela(s) somente Números";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error_token_conta'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDataDespesaCartao($data)
    {
        $d['descricao'] = trim($data['descricao']);
        $d['data_compra'] = trim($data['data_compra']);
        $d['fk_credit_cards'] = (int) trim($data['cartao']);
        return $d;
    }

    public function formateDataDespesaCartaoParcela($c, $data, $idDespesa)
    {
        $diaPgtoFat = Verifications::checkDiaPagamentoFatura($c, $data['cartao']);

        if ($data['numero_parcela'] == 1) {
            $d['valor'] = trim(formatarMoeda($data['valor']));
            $d['numero_parcela'] = "01/0{$data['numero_parcela']}";
            $d['data_pagamento'] = data_pagamento($diaPgtoFat["dia_pgto_fatura"], $data['data_compra']);
            $d['fk_expenses_card'] = $idDespesa;
        } else {
            $valor = number_format(formatarMoeda($data['valor']) / $data['numero_parcela'], 2, ".", "");
            for ($i=1; $i <= $data['numero_parcela']; $i++) { 
                $d[$i]['valor'] = (float) $valor;

                if ($i < 10 && $data['numero_parcela'] < 10) {
                    $d[$i]['numero_parcela'] = "0{$i}/0{$data['numero_parcela']}";
                } else if ($i < 10 && $data['numero_parcela'] >= 10) {
                    $d[$i]['numero_parcela'] = "0{$i}/{$data['numero_parcela']}";
                } else {
                    $d[$i]['numero_parcela'] = "{$i}/{$data['numero_parcela']}";
                }
                
                $d[$i]['data_pagamento'] = date('Y-m-d', strtotime("+".$i." month", strtotime(data_pagamento($diaPgtoFat["dia_pgto_fatura"], $data['data_compra']))));
                $d[$i]['fk_expenses_card'] = $idDespesa;
            }
        }
        return $d;
    }
}    
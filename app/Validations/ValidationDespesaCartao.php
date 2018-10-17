<?php

namespace App\Validations;

use App\Mfw\Password;

class ValidationDespesaCartao
{
    private $erros = [];
    private $d = [];

    public function validateDespesaCartao($data)
    {
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

    public function formateDataDespesaCartao($data, $idConta, $c)
    {
        $extrato = $c['extracts_model']->saldo($c['accounts_model']->getTable(), 1);
        $d['data_movimentacao'] = trim($data['data_movimentacao_deb']);
        $d['mes'] = verificaMes();
        $d['tipo_operacao'] = 'Débito';
        $d['movimentacao'] = trim($data['movimentacao']);
        $d['quantidade'] = 1;
        $d['valor'] = trim(formatarMoeda($data['valor']));
        $d['saldo'] = ($extrato['saldo'] - formatarMoeda($data['valor']));
        $d['fk_category'] = (int) trim($data['categoria']);
        $d['fk_accounts'] = (int) $idConta;
        $d['despesa_fixa'] = Verifications::checkCategory($c, $data['categoria']);

        return $d;
    }
}    
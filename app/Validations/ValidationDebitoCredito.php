<?php

namespace App\Validations;

use App\Mfw\Password;
use App\Mfw\Verifications;

class ValidationDebitoCredito
{
    private $erros = [];
    private $d = [];

    public function validateDebitoCredito($data, $idUser, $c)
    {
        $extrato = $c['extracts_model']->saldo($c['accounts_model']->getTable(), 1);
        if (formatarMoeda($data['valor']) > $extrato['saldo']) {
            $this->erros['error_saldo'] = "Saldo Insuficente para Debitar!";
        }

        if (empty($data['data_movimentacao_deb'])) {
            $this->erros['error_data_mov'] = "Preencha a Data!";
        }

        if (empty($data['movimentacao'])) {
            $this->erros['error_mov'] = "Preencha a Movimentação!";
        } else if (!empty($data['movimentacao']) && is_numeric($data['movimentacao'])) {
            $this->erros['error_mov'] = "Movimentação sem Números!";
        } else if (strlen($data['movimentacao']) < 4) {
            $this->erros['error_mov'] = "Movimentação acima de 3 caracters!";
        }

        if (empty($data['valor'])) {
            $this->erros['error_valor'] = "Preencha o Valor!";
        } else if (!empty($data['valor']) && !is_numeric(formatarMoeda($data['valor']))) {
            $this->erros['error_valor'] = "Valor somente Números!";
        }

        if (empty($data['categoria'])) {
            $this->erros['error_categoria'] = "Preencha a Categoria!";
        } 

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error_token_conta'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDebito($data, $idConta, $c)
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

    public function formateCredito($data, $idConta, $c)
    {
        $extrato = $c['extracts_model']->saldo($c['accounts_model']->getTable(), 1);
        $d['data_movimentacao'] = trim($data['data_movimentacao_deb']);
        $d['mes'] = verificaMes();
        $d['tipo_operacao'] = 'Crédito';
        $d['movimentacao'] = trim($data['movimentacao']);
        $d['quantidade'] = 1;
        $d['valor'] = trim(formatarMoeda($data['valor']));
        $d['saldo'] = ($extrato['saldo'] + formatarMoeda($data['valor']));
        $d['fk_category'] = (int) trim($data['categoria']);
        $d['fk_accounts'] = (int) $idConta;
        $d['despesa_fixa'] = Verifications::checkCategory($c, $data['categoria']);

        return $d;
    }
}
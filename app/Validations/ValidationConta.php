<?php

namespace App\Validations;

use App\Mfw\Password;

class ValidationConta
{
    private $erros = [];
    private $d = [];

    public function validateConta($data, $c = null, $idUser)
    {
        if (empty($data['codigo_agencia'])) {
            $this->erros['error-cod-agencia'] = "Preencha o Código da Agência!";
        } else if (!empty($data['codigo_agencia']) && !is_numeric($data['codigo_agencia'])) {
            $this->erros['error-cod-agencia'] = "Cód. da Agência somente Números!";
        } else if (strlen($data['codigo_agencia']) < 4 || strlen($data['codigo_agencia']) > 4) {
            $this->erros['error-cod-agencia'] = "Cód. da Agência deve conter até 4 dígitos!";
        }

        if (!empty($data['digito_verificador_agencia']) && !is_numeric($data['digito_verificador_agencia'])) {
            $this->erros['error-dig-ver-agencia'] = "Díg. Verificador da Agência somente Números!";
        } else if (!empty($data['digito_verificador_agencia']) && strlen($data['digito_verificador_agencia']) != 1) {
            $this->erros['error-dig-ver-agencia'] = "Díg. Verificador da Ag. deve conter 1 dígito!";
        }

        if (empty($data['numero_conta'])) {
            $this->erros['error-num-conta'] = "Preencha o Número da Conta!";
        } else if (!empty($data['numero_conta']) && !is_numeric($data['numero_conta'])) {
            $this->erros['error-num-conta'] = "Número da Conta somente Números!";
        } else if (strlen($data['numero_conta']) > 9) {
            $this->erros['error-num-conta'] = "Número da Conta deve conter até 9 dígitos!";
        }

        if (empty($data['digito_verificador_conta'])) {
            $this->erros['error-dig-ver-conta'] = "Preencha o Dígito Verificador da Conta!";
        } else if (!empty($data['digito_verificador_conta']) && !is_numeric($data['digito_verificador_conta'])) {
            $this->erros['error-dig-ver-conta'] = "Díg. Verif. da Conta somente Números!";
        } else  if (strlen($data['digito_verificador_conta']) != 1) {
            $this->erros['error-dig-ver-conta'] = "Díg. Verif. da Conta deve conter 1 dígito!";
        }

        if (!empty($data['codigo_operacao']) && !is_numeric($data['codigo_operacao'])) {
            $this->erros['error-cod-operacao'] = "Cód. da Operação somente Números!";
        } else if (!empty($data['codigo_operacao']) && (strlen($data['codigo_operacao']) > 3 || strlen($data['codigo_operacao']) < 3 )) {
            $this->erros['error-cod-operacao'] = "Cód. da Operação deve conter até 3 dígitos!";
        }

        if (empty($data['tipo_conta'])) {
            $this->erros['error-tp-conta'] = "Preencha o Tipo da Conta!";
        }

        if (empty($data['banco'])) {
            $this->erros['error-tp-banco'] = "Selecione o Banco!";
        }

        $conta = $c['accounts_model']->getById(['fk_banks' => $data['banco'], 'fk_users' => $idUser]);

        if ($conta['codigo_agencia'] == $data['codigo_agencia'] && $conta['numero_conta'] == $data['numero_conta']
            && $conta['digito_verificador_conta'] == $data['digito_verificador_conta'] 
            && $conta['fk_banks'] == $data['banco'] && $conta['fk_users'] == $idUser) {
            $this->erros['error-conta'] = "Esta Conta já está Cadastrada!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error-token-conta'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDataConta($data, $idUser)
    {
        $d['codigo_agencia'] = trim($data['codigo_agencia']);
        $d['digito_verificador_agencia'] = (int) trim($data['digito_verificador_agencia']);
        $d['numero_conta'] = trim($data['numero_conta']);
        $d['digito_verificador_conta'] = (int) trim($data['digito_verificador_conta']);
        $d['codigo_operacao'] = trim($data['codigo_operacao']);
        $d['fk_users'] = $idUser;
        $d['fk_banks'] = (int) trim($data['banco']);
        $d['fk_account_type'] = (int) trim($data['tipo_conta']);

        return $d;
    }
}
<?php

namespace App\Validations;

use App\Mfw\Password;

class ValidationConta
{
    private $erros = [];
    private $d = [];

    public function validateConta($data, $c = null, $idUser = null)
    {
        if (empty($data['codigo_agencia'])) {
            $this->erros['error-cod-agencia'] = "Preencha o Código da Agência!";
        }
        if (!is_numeric($data['codigo_agencia'])) {
            $this->erros['error-cod-agencia'] = "Código da Agência somente Números!";
        }
        if (strlen($data['codigo_agencia']) > 4) {
            $this->erros['error-cod-agencia'] = "Código da Agência deve conter até 4 dígitos!";
        }

        if (!empty($data['digito_verificador_agencia']) && !is_numeric($data['digito_verificador_agencia'])) {
            $this->erros['error-dig-ver-agencia'] = "Dígito Verificador da Agência somente Números!";
        }
        if (!empty($data['digito_verificador_agencia']) && strlen($data['digito_verificador_agencia']) != 1) {
            $this->erros['error-dig-ver-agencia'] = "Dígito Verificador da Agência deve conter 1 dígito!";
        }

        if (empty($data['numero_conta'])) {
            $this->erros['error-num-conta'] = "Preencha o Número da Conta!";
        }
        if (!is_numeric($data['numero_conta'])) {
            $this->erros['error-num-conta'] = "Número da Conta somente Números!";
        }
        if (strlen($data['numero_conta']) > 9) {
            $this->erros['error-num-conta'] = "Número da Conta deve conter até 9 dígitos!";
        }

        if (empty($data['digito_verificador_conta'])) {
            $this->erros['error-dig-ver-conta'] = "Preencha o Dígito Verificador da Conta!";
        }
        if (!is_numeric($data['digito_verificador_conta'])) {
            $this->erros['error-dig-ver-conta'] = "Dígito Verificador da Conta somente Números!";
        }
        if (strlen($data['digito_verificador_conta']) != 1) {
            $this->erros['error-dig-ver-conta'] = "Dígito Verificador da Conta deve conter 1 dígito!";
        }

        if (!empty($data['codigo_operacao']) && !is_numeric($data['codigo_operacao'])) {
            $this->erros['error-cod-operacao'] = "Código da Operação somente Números!";
        }
        if (!empty($data['codigo_operacao']) && strlen($data['codigo_operacao']) > 3) {
            $this->erros['error-cod-operacao'] = "Código da Operação deve conter até 3 dígitos!";
        }

        $conta = $c['accounts_model']->getById(['fk_banks' => $data['banco'], 'fk_users' => $idUser]);

        if ($conta['codigo_agencia'] == $data['codigo_agencia'] && $conta['numero_conta'] == $data['numero_conta']
            && $conta['digito_verificador_conta'] == $data['digito_verificador_conta'] 
            && $conta['fk_banks'] == $data['banco'] && $conta['fk_users'] == $idUser) {
            $this->erros['error-conta'] = "Esta Conta já está Cadastrada!";
        }

        if (empty($data['tipo_conta'])) {
            $this->erros['error-tp-conta'] = "Preencha o Tipo da Conta!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error-token-conta'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDataConta($data)
    {
        $d['cod_conta'] = (int) trim($data['cod_conta']);
        $d['nome_conta'] = trim(ucwords($data['nome_conta']));
        return $d;
    }
}
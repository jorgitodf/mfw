<?php

namespace App\Validations;

use App\Mfw\Password;

class ValidationBanco
{
    private $erros = [];
    private $d = [];

    public function validateBanco($data, $c = null)
    {
        if ($c['banks_model']->getById(['cod_banco' => $data['cod_banco']])) {
            $this->erros['error-cod-banco'] = "Código do Banco já Cadastrado!";
        }

        if (empty($data['cod_banco'])) {
            $this->erros['error-cod-banco'] = "Preencha o Código do Banco!";
        }

        if (!is_numeric($data['cod_banco'])) {
            $this->erros['error-cod-banco'] = "Código do Banco somente Números!";
        }

        if (strlen($data['cod_banco']) != 3) {
            $this->erros['error-cod-banco'] = "Código do Banco deve conter 3 dígitos!";
        }

        if (empty($data['nome_banco'])) {
            $this->erros['error-nome-banco'] = "Preencha o nome do Banco!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error-token-banco'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDataBanco($data)
    {
        $d['cod_banco'] = (int) trim($data['cod_banco']);
        $d['nome_banco'] = trim(ucwords($data['nome_banco']));
        return $d;
    }
}
<?php

namespace App\Validations;

use App\Mfw\Password;

class ValidationBanco
{
    private $erros = [];

    public function validateBanco($data)
    {
        if (empty($data['cod_banco'])) {
            $this->erros['error-cod-banco'] = "Preencha o Código do Banco!";
        }

        if (empty($data['nome_banco'])) {
            $this->erros['error-nome-banco'] = "Preencha o nome do Banco!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error-token-banco'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }
}
<?php

namespace App\Validations;

class ValidationBanco
{
    private $erros = [];

    public function validateBanco($user_data)
    {
        if (empty($user_data['cod_banco'])) {
            $this->erros['error-cod-banco'] = "Preencha o Código do Banco!";
        }

        if (empty($user_data['nome_banco'])) {
            $this->erros['error-nome-banco'] = "Preencha o nome do Banco!";
        }

        return $this->erros;
    }
}
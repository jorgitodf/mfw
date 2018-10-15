<?php

namespace App\Validations;

use App\Mfw\Password;
use App\Mfw\Verifications;

class ValidationExtrato
{
    private $erros = [];

    public function validateExtrato($data)
    {
        if (empty($data['data_inicial'])) {
            $this->erros['error_data_inicial'] = "Preencha a Data Inicial!";
        }

        if (empty($data['data_final'])) {
            $this->erros['error_data_final'] = "Preencha a Data Final!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error_token_conta'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

}
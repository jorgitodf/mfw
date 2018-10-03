<?php

namespace App\Validations;

class ValidationUser
{
    private $erros = [];

    public function validateUser($user_data)
    {
        if (empty($user_data['name'])) {
            $this->erros['error-name'] = "Preencha o seu nome Completo";
        }

        if (empty($user_data['email'])) {
            $this->erros['error-email'] = "Preencha o seu E-mail";
        }

        if (empty($user_data['password'])) {
            $this->erros['error-password'] = "Preencha a sua Senha";
        } else if (strlen($user_data['password']) < 6) {
            $this->erros['error-password'] = "A Senha deve possuir no mínimo 6 Caracteres";
        } else if (!preg_match('/^[^0-9][a-zA-Z0-9]+$/', $user_data['password'])) {
            $this->erros['error-password'] = "A Senha deve conter Números e Letras";
        }

        if (empty($user_data['re_password'])) {
            $this->erros['error-re-password'] = "Digite a sua Senha Novamente";
        } else if ($user_data['password'] != $user_data['re_password']) {
            $this->erros['error-re-password'] = "As Senhas Digitadas não são Iguais";
        }

        return $this->erros;
    }
}
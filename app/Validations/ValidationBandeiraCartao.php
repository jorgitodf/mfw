<?php

namespace App\Validations;

use App\Mfw\Password;

class ValidationBandeiraCartao
{
    private $erros = [];
    private $d = [];

    public function validateBandeira($data, $c = null)
    {
        if ($c['flag_cards_model']->getById(['bandeira' => $data['bandeira']])) {
            $this->erros['error_bandeira'] = "Bandeira já Cadastrada!";
        }

        if (empty($data['bandeira'])) {
            $this->erros['error_nome_bandeira'] = "Preencha o Nome da Bandeira!";
        }

        if (!empty($data['bandeira']) && is_numeric($data['bandeira'])) {
            $this->erros['error_nome_bandeira'] = "Bandeira somente Números!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error-token-banco'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDataBandeira($data)
    {
        $d['bandeira'] = trim(ucwords($data['bandeira']));
        return $d;
    }
}
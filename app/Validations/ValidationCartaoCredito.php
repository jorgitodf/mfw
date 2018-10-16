<?php

namespace App\Validations;

use App\Mfw\Password;

class ValidationCartaoCredito
{
    private $erros = [];
    private $d = [];

    public function validateCartao($data, $c = null, $model = null, $idUser)
    {
        $cartao = $c[$model]->getById(['numero_cartao' => removePontos($data['numero_cartao']), 
                'fk_flag_cards' => $data['bandeira'], 'fk_banks' => $data['banco'], 'fk_users' => $idUser
            ]);
        if ($cartao) {
            $this->erros['error_cartao'] = "Este Cartão já está Cadastrado!";
        }

        if (empty($data['numero_cartao'])) {
            $this->erros['error_numero_cartao'] = "Preencha o Número do Cartão!";
        } 

        if (empty($data['data_validade'])) {
            $this->erros['error_data_validade'] = "Informe a Data de Validade do Cartão";
        }

        if (empty($data['bandeira'])) {
            $this->erros['error_bandeira'] = "Informe a Bandeira do Cartão!";
        }

        if (empty($data['banco'])) {
            $this->erros['error_banco'] = "Informe a Banco do Cartão!";
        } 

        if (empty($data['dia_pgto_fatura'])) {
            $this->erros['error_dia_pgto_fatura'] = "Informe o dia do Pagamento do Cartão!";
        } else if (!empty($data['dia_pgto_fatura']) && !is_numeric($data['dia_pgto_fatura'])) {
            $this->erros['error_dia_pgto_fatura'] = "Dia do Pagamento Somente Números!";
        }



        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error_token_agd_pgto'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDataCartao($data, $idUser)
    {
        $d['numero_cartao'] = trim(removePontos($data['numero_cartao']));
        $d['data_validade'] = trim($data['data_validade']);
        $d['fk_flag_cards'] = (int) trim($data['bandeira']);
        $d['fk_users'] = (int) $idUser;
        $d['fk_banks'] = (int) $data['banco'];
        $d['ativo'] = 'S';
        $d['dia_pgto_fatura'] = (int) $data['dia_pgto_fatura'];
        return $d;
    }
}
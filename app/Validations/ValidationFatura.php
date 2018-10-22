<?php

namespace App\Validations;

use App\Mfw\Password;
use App\Mfw\Verifications;

class ValidationFatura
{
    private $erros = [];
    private $d = [];

    public function validateFatura($c, $data)
    {
        if (empty($data['cartao'])) {
            $this->erros['error_cartao'] = "Selecione o Cartão!";
        }
        
        $dpf = Verifications::checkDiaPagamentoFatura($c, $data['cartao']); 
        $ex = explode("-", $data['data_pagamento']);
        $ano = $ex[0];
        $mes = $ex[1];
        $dia = $ex[2];

        if (empty($data['data_pagamento'])) {
            $this->erros['error_data_pagamento'] = "Informe a Data do Pagamento!";
        } else if (!empty($data['cartao']) && ($dpf['dia_pgto_fatura'] != date("d", mktime(0, 0, 0, $mes, $dia, $ano)))) {
            $this->erros['error_data_pagamento'] = "Data de Vencimento da Fatura diferente do dia: ".$dpf['dia_pgto_fatura']."!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error_token_conta'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function validatePagarFatura($c, $data)
    {
        if (empty($data['fatura'])) {
            $this->erros['error_fatura'] = "Selecione a Fatura a ser Paga!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error_token_conta'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDataFatura($data)
    {
        $ex = explode("-", $data['data_pagamento']);
        $ano = $ex[0];
        $mes = $ex[1];
        $dia = $ex[2];

        $d['data_pagamento_fatura'] = trim($data['data_pagamento']);
        $d['pago'] = "N";
        $d['ano_mes_ref'] = date("Y-m", mktime(0, 0, 0, $mes, $dia, $ano));
        $d['fk_credit_cards'] = (int) $data['cartao'];
        return $d;
    }

}    
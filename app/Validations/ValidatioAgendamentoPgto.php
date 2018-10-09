<?php

namespace App\Validations;

use App\Mfw\Password;

class ValidatioAgendamentoPgto
{
    private $erros = [];
    private $d = [];

    public function validateAgendamentoPgto($data, $c = null, $idConta)
    {
        if (empty($data['data_pagamento'])) {
            $this->erros['error_data_pgto'] = "Preencha a Data de Pagamento!";
        } 

        if (empty($data['movimentacao'])) {
            $this->erros['error_movimentacao'] = "Preencha a Movimentação!";
        } else if (!empty($data['movimentacao']) && strlen($data['movimentacao']) < 4) {
            $this->erros['error_movimentacao'] = "Preencha a Movimentação!";
        }

        if (empty($data['valor'])) {
            $this->erros['error_valor'] = "Preencha o Valor!";
        } else if (!empty($data['valor']) && !is_numeric(formatarMoeda($data['valor']))) {
            $this->erros['error_valor'] = "Valor somente Números!";
        }

        if (empty($data['categoria'])) {
            $this->erros['error_categoria'] = "Preencha a Categoria!";
        } 

        $pgto = $c['scheduled_payments_model']->getById(['data_pagamento' => $data['data_pagamento'], 
                'movimentacao' => $data['movimentacao'], 'fk_category' => $data['categoria']
            ]);

        if ($pgto['data_pagamento'] == $data['data_pagamento'] && $pgto['movimentacao'] == $data['movimentacao'] 
            && $pgto['fk_category'] == $data['categoria']) {
            $this->erros['error_ag_pgto'] = "Este Pagamento já foi Agendado!";
        }

        if ($data['_csrf_token'] !== Password::getTokenUser()) {
            $this->erros['error_token_agd_pgto'] = "Operação não Autorizada!!";
        }

        return $this->erros;
    }

    public function formateDataConta($data, $idUser)
    {
        $d['data_pagamento'] = trim($data['data_pagamento']);
        $d['movimentacao'] = trim($data['movimentacao']);
        $d['valor'] = trim(formatarMoeda($data['valor']));
        $d['pago'] = 'Não';
        $d['fk_category'] = (int) $data['categoria'];
        $d['fk_account'] = $idUser;

        return $d;
    }
}
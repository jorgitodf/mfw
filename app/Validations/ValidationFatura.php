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

    public function validateQuitacaoFatura($data)
    {
        if (empty($data['valor_pagar'])) {
            $this->erros['error_valor_pagar'] = "Preencha o Valor do Pagamento!";
        } else if (!empty($data['valor_pagar']) && (formatarMoeda($data['valor_pagar']) > formatarMoeda($data['valor_total']))) {
            $this->erros['error_valor_pagar'] = "Valor do Pagamento acima do Valor Total!";
        } else if (!empty($data['valor_pagar']) && (formatarMoeda($data['valor_pagar']) < (formatarMoeda($data['valor_total']) * 0.10))) {
            $this->erros['error_valor_pagar'] = "Valor do Pagamento Insufuciente!";
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

    public function formateDataQuitacaoFatura($data)
    {
        $d = [];

        $d["encargos"] = formatarMoeda($data["encargos"]) ?? null;
        $d["protecao_premiada"] = formatarMoeda($data["protecao_prem"]) ?? null;
        $d["iof"] = formatarMoeda($data["iof"]) ?? null;
        $d["pago"] = "S";
        $d["juros"] = formatarMoeda($data["juros_fat"]) ?? null;
        $d["valor_total_fatura"] = formatarMoeda($data["valor_total"]);
        $d["valor_pagamento_fatura"] = formatarMoeda($data["valor_pagar"]);
        $d["restante_fatura_mes_anterior"] = (formatarMoeda($data["valor_total"]) - formatarMoeda($data["valor_pagar"]));
        $d["data_fechamento_fatura"] = date('Y-m-d H:i:s');
        $d["fk_credit_cards"] = $data["id_cartao_cre"];

        return $d;
    }

    public function formateDataQuitacaoFaturaToAgendamento($data, $idConta)
    {
        $d = [];

        if ($data["id_cartao_cre"] == 1) {
            $movimentacao = "Cartão Banco Votorantim";
        } else if ($data["id_cartao_cre"] == 2) {
            $movimentacao = "Cartão Banco CEF";
        } else if ($data["id_cartao_cre"] == 3) {
            $movimentacao = "Cartão Banco NuBank";
        }    

        $d['data_pagamento'] = formataData($data['dt_vencimento']);
        $d['movimentacao'] = $movimentacao;
        $d['valor'] = formatarMoeda($data["valor_pagar"]);
        $d['pago'] = 'Não';
        $d['fk_category'] = 6;
        $d['fk_account'] = $idConta;

        return $d;
    }

}    
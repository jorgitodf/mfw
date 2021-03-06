<?php

namespace App\Mfw;

class Verifications
{

    public static function checkCategory($c, $idCategory)
    {
        $categories = $c['categories_model']->get();
        foreach ($categories as $value) {
            if ($value['id'] == ($idCategory && $value['despesa_fixa'] == 'S')) {
                $despesa = 'S';
                
            } else if ($value['id'] == ($idCategory && $value['despesa_fixa'] == 'N')) {
                $despesa = 'N';
            }
        }
        return $despesa;
    }

    public static function checkDiaPagamentoFatura($c, $idCard)
    {
        $diaPagamentoFatura = $c['credit_cards_model']->getById(['id' => $idCard]);
        return $diaPagamentoFatura;
    }

}
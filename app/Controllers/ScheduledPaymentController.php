<?php

namespace App\Controllers;

use App\Validations\ValidationBanco;

class ScheduledPaymentController
{
    private $validations;

    public function __construct()
    {
        $this->validations = new ValidationBanco();
    }

    protected function getModel($model): string
    {
        if ($model == 'cat') {
            return 'categories_model';
        } else if ($model == 'sp') {
            return 'scheduled_payments_model';
        }
    }

    public function index($c, $request)
    {
        $categorias = $c[$this->getModel('cat')]->allOrderBy('nome_categoria');

        return $c['view']->render('pagamento-agendado/index.html.twig', ['title' => 'Agendamento de Pagamento', 'categorias' => $categorias]);
    }

}
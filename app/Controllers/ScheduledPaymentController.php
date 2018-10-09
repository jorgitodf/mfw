<?php

namespace App\Controllers;

use App\Validations\ValidatioAgendamentoPgto;
use App\Mfw\Password;

class ScheduledPaymentController
{
    private $validations;

    public function __construct()
    {
        $this->validations = new ValidatioAgendamentoPgto();
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

    public function create($c, $request)
    {
        $data = $request->request->all();
        $idConta = Password::hasConta();
        $error = $this->validations->validateAgendamentoPgto($data, $c, $idConta);

        if (!$error) {
            $datas = $this->validations->formateDataConta($data, $idConta);
            $c[$this->getModel('sp')]->create($datas);
            status_code(201);
            return json_encode(['base_url' => base_url(), 'success' => 'Pagamento Agendado com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }

}
<?php

namespace App\Controllers;

use App\Mfw\Password;
use App\Validations\ValidationDespesaCartao;

class DespesaCartaoController
{
    private $validations;

    public function __construct()
    {
        $this->validations = new ValidationDespesaCartao();
    }

    protected function getModel($model): string
    {
        if ($model == 'dp') {
            return 'expenses_card';
        }
    }

    public function index($c, $request)
    {
        return $c['view']->render('cartao/despesa.html.twig', ['title' => 'Despesa de Cartão']);
    }

    public function create($c, $request)
    {
        $data = $request->request->all();
        $error = $this->validations->validateDespesaCartao($data);
        
        if (!$error) {
            $datas = $this->validations->formateDataDespesaCartao($data);
            $c[$this->getModel()]->create($datas);
            status_code(201);
            return json_encode(['success' => 'Despesa Cadastrada com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }
}
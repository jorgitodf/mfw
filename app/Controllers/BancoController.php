<?php

namespace App\Controllers;

use App\Validations\ValidationBanco;

class BancoController
{
    private $validations;

    public function __construct()
    {
        $this->validations = new ValidationBanco();
    }

    protected function getModel(): string
    {
        return 'banks_model';
    }

    public function index($c, $request)
    {
        return $c['view']->render('banco/index.html.twig', ['title' => 'Novo Banco']);
    }

    public function create($c, $request)
    {
        $data = $request->request->all();
        $error = $this->validations->validateBanco($data);

        if (!$error) {
            status_code(201);
            return json_encode(['base_url' => base_url(), 'success' => 'Banco Cadastrado com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }
}
<?php

namespace App\Controllers;

use App\Validations\ValidationBandeiraCartao;

class BandeiraCartaoController
{
    private $validations;

    public function __construct()
    {
        $this->validations = new ValidationBandeiraCartao();
    }

    protected function getModel(): string
    {
        return 'flag_cards_model';
    }


    public function index($c, $request)
    {
        return $c['view']->render('bandeira/index.html.twig', ['title' => 'Nova Bandeira']);
    }

    public function create($c, $request)
    {
        $data = $request->request->all();
        $error = $this->validations->validateBandeira($data, $c);
        
        if (!$error) {
            $datas = $this->validations->formateDataBandeira($data);
            $c[$this->getModel()]->create($datas);
            status_code(201);
            return json_encode(['success' => 'Bandeira Cadastrada com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }
}
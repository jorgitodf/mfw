<?php

namespace App\Controllers;

class ContaController
{
    public function index($c, $request)
    {
        return $c['view']->render('conta/index.html.twig', ['title' => 'Conta']);
    }

    public function create($c, $request)
    {
        return "Create";
    }
}
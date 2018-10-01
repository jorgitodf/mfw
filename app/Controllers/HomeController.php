<?php

namespace App\Controllers;

use App\Models\Users;

class HomeController
{
    public function index($c, $request)
    {
        return $c['view']->render('home/index.html.twig', ['title' => 'Página Home']);
    }
}
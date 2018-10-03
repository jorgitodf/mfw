<?php

namespace App\Controllers;

use App\Models\Users;
use App\Mfw\Password;

class HomeController
{
    public function index($c, $request)
    {
        return $c['view']->render('home/index.html.twig', ['title' => 'Página Home']);
    }
}
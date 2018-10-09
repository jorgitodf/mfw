<?php

function dd($value)
{
    $dd = var_dump($value);exit;
    return $dd; 
}

function pr($value)
{
    $dd = print_r($value);exit;
    return $dd; 
}

function redirect($target)
{
    return header("Location: {$target}");
}

function back()
{
    $previous = "javascript:history.go(-1)";

    if (isset($_SERVER["HTTP_REFERER"])) {
        $previous = $_SERVER["HTTP_REFERER"];
    }

    return header("Location: {$previous}");
}

function status_code($code)
{
    return http_response_code($code);
}

function base_url()
{
    $base_url = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $base_url .= "s";
    $base_url .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") $base_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
    else $base_url .= $_SERVER["SERVER_NAME"];
    $base_url."/";
    return $base_url;

    return $base_url;
}

function login()
{
    $login = [
        'admin' => [
            'loggedIn' => '',
            'redirect' => '/admin',
            'idLoggedIn' => ''
        ],
        'user' => [
            'loggedIn' => '',
            'redirect' => '/home',
            'idLoggedIn' => ''
        ]
    ];

    return $login;
}

function formatarMoeda($valor) 
{
    $valor1 = trim(str_replace('R$ ', '', $valor));
    $number = str_replace(',','.',preg_replace('#[^\d\,]#is','',$valor1)); 
    return number_format((float) $number, 2, "." ,"");
}

function ano()
{
    return date("Y");
}

function verificaMesNumerico() {
    $mesAtual = date("m");
    switch ($mesAtual) {
        case '01':
            $mesAtual = '01';
            break;
        case '02':
            $mesAtual = '02';
            break;
        case '03':
            $mesAtual = '03';
            break;
        case '04':
            $mesAtual = '04';
            break;
        case '05':
            $mesAtual = '05';
            break;
        case '06':
            $mesAtual = '06';
            break;
        case '07':
            $mesAtual = '07';
            break;
        case '08':
            $mesAtual = '08';
            break;
        case '09':
            $mesAtual = '09';
            break;
        case '10':
            $mesAtual = '10';
            break;
        case '11':
            $mesAtual = '11';
            break;
        case '12':
            $mesAtual = '12';
            break;
    }
    return $mesAtual;
}


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


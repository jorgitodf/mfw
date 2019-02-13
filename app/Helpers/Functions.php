<?php

namespace App\Helpers;

class Functions
{
    public static function base_url()
    {
        $base_url = new \Twig_SimpleFunction('base_url', function() {
            $base_url = 'http';
            if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $base_url .= "s";
                $base_url .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") $base_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
            else $base_url .= $_SERVER["SERVER_NAME"];
                $base_url."/";
            return $base_url;
        });

        return $base_url;
    }

    public static function isLogged()
    {
        $isLogged = new \Twig_SimpleFunction('isLogged', function() {
            return $_SESSION['loggedIn'];
        });

        return $isLogged;
    }

    public static function csrf_token()
    {
        $csrf_token = new \Twig_SimpleFunction('csrf_token', function() {
            return $_SESSION['csrf_token'];
        });

        return $csrf_token;
    }

    public static function hasConta()
    {
        $hasConta = new \Twig_SimpleFunction('hasConta', function() {
            return $_SESSION['hasConta'];
        });

        return $hasConta;
    }

    public static function mes()
    {
        $mes = new \Twig_SimpleFunction('mes', function() {
            
            $mesAtual = date("m");
            switch ($mesAtual) {
                case '01':
                    $mesAtual = 'Janeiro';
                    break;
                case '02':
                    $mesAtual = 'Fevereiro';
                    break;
                case '03':
                    $mesAtual = 'Março';
                    break;
                case '04':
                    $mesAtual = 'Abril';
                    break;
                case '05':
                    $mesAtual = 'Maio';
                    break;
                case '06':
                    $mesAtual = 'Junho';
                    break;
                case '07':
                    $mesAtual = 'Julho';
                    break;
                case '08':
                    $mesAtual = 'Agosto';
                    break;
                case '09':
                    $mesAtual = 'Setembro';
                    break;
                case '10':
                    $mesAtual = 'Outubro';
                    break;
                case '11':
                    $mesAtual = 'Novembro';
                    break;
                case '12':
                    $mesAtual = 'Dezembro';
                    break;
            }
            return $mesAtual;
        });

        return $mes;
    }

    public static function insert_numbers($value)
    {
        $insert_numbers = new \Twig_SimpleFunction('insert_numbers', function($value) {
            return wordwrap($value, 4, '.', true);
        });

        return $insert_numbers;
    }

    public static function ano()
    {
        $ano = new \Twig_SimpleFunction('ano', function() {
            return date("Y");
        });

        return $ano;
    }

    
}

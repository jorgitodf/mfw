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
    
}

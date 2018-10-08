<?php

namespace App\Mfw;

class Password
{
    public static function make($password)
    {
        $options = [
            'cost' => 12
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public static function token($email)
    {
        $options = [
            'cost' => 12
        ];
        return password_hash($email, PASSWORD_BCRYPT, $options);
    }

    public static function setSession($idUser, $loggedIn, $typeUser, $emailByToken, $name)
    {
        $_SESSION['idLoggedIn'] = $idUser;
        $_SESSION['loggedIn'] = $loggedIn;
        $_SESSION['typeUserLogged'] = $typeUser;
        $_SESSION['csrf_token'] = $emailByToken;
        $_SESSION['name'] = $name;
        $_SESSION['hasConta'] = "";

        return $_SESSION;
    }

    public static function setHasConta($idConta)
    {
        $_SESSION['hasConta'] = $idConta;

        return $_SESSION;
    }

    public static function getTokenUser()
    {
        if ($_SESSION['csrf_token']) {
            return $_SESSION['csrf_token'];
        }
        return false;
    } 

    public static function hasConta()
    {
        if ($_SESSION['hasConta']) {
            return $_SESSION['hasConta'];
        }
        return false;
    } 

    public static function getSessionUser()
    {
        if ($_SESSION) {
            return $_SESSION;
        }
        return false;
    } 
}
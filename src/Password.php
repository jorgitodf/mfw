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

    public static function setSession($idUser, $loggedIn, $typeUser, $emailByToken)
    {
        $_SESSION['idLoggedIn'] = $idUser;
        $_SESSION['loggedIn'] = $loggedIn;
        $_SESSION['typeUserLogged'] = $typeUser;
        $_SESSION['csrf_token'] = $emailByToken;

        return $_SESSION;
    }
}
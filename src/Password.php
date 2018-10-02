<?php

namespace App\Mfw;

class Password
{
    public static function make()
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
}
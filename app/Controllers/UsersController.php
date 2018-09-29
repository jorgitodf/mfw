<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController
{
    public function show($container, $request)
    {
        $user = new Users($container);
        $data = $user->where($request->attributes->get(1));

        return "Meu nome é " . $data['name'];
    }
}

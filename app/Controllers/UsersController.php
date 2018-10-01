<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController
{
    public function index($c, $request)
    {
        $user = new Users($c);
        return json_encode($user->all());
    }

    public function create($c, $request)
    {
        $user = new Users($c);
        return $user->create($request->request->all());    
    }

    public function show($c, $request)
    {
        $user = new Users($c);
    }

    public function update($c, $request)
    {
        $user = new Users($c);
        return json_encode($user->update($request->attributes->get(1), $request->request->all()));    
    }

    public function delete($c, $request)
    {
        $user = new Users($c);
        return json_encode($user->delete($request->attributes->get(1)));    
    }
}

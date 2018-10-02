<?php

namespace App\Controllers;

use App\Models\Users;

class UsersController
{
    protected function getModel(): string
    {
        return 'users_model';
    }

    public function index($c, $request)
    {
        return json_encode($c[$this->getModel()]->get());
    }

    public function create($c, $request)
    {
        return json_encode($c[$this->getModel()]->create($request->request->all()));    
    }

    public function show($c, $request)
    {
        $id = $request->attributes->get(1);
        return json_encode($c[$this->getModel()]->getById(['id' => $id]));    
    }

    public function update($c, $request)
    {
        $id = $request->attributes->get(1);
        return json_encode($c[$this->getModel()]->update(['id' => $id], $request->request->all()));    
    }

    public function delete($c, $request)
    {
        $id = $request->attributes->get(1);
        return json_encode($c[$this->getModel()]->delete(['id' => $id]));    
    }
}

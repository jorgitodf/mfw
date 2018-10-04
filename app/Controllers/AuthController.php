<?php

namespace App\Controllers;

use App\Mfw\Password;
use App\Validations\ValidationUser;

class AuthController
{
    private $validations;

    public function __construct()
    {
        $this->validations = new ValidationUser();
    }

    protected function getModel(): string
    {
        return 'users_model';
    }

    public function login($c, $request)
    {
        return $c['view']->render('auth/login.html.twig', ['title' => 'Login']);
    }

    public function auth($c, $request)
    {
        $data = $request->request->all();
        
        $user = $c[$this->getModel()]->findBy(['email' => $data['email']]);

        if (!$user) {
            status_code(401);
            return json_encode(['error' => 'E-mail não cadastrado!', 'status' => 401]);
        }

        if (Password::verify($data['password'], $user['password'])) {
            Password::setSession($user['id'], true, 'admin', Password::token($user['email']));
            $c[$this->getModel()]->update(['id' => $user['id']], ['remember_token' => $_SESSION['csrf_token']]);
            status_code(202);
            unset($user['password']);
            return json_encode(['base_url' => base_url(), 'status' => 202]);
        }

        status_code(401);
        return json_encode(['error' => 'A Senha está Inválida!', 'status' => 401]);
    }

    public function newRegister($c, $request)
    {
        return $c['view']->render('auth/register.html.twig', ['title' => 'Novo Usuário']);
    }

    public function create($c, $request)
    {
        $data = $request->request->all();
        $error = $this->validations->validateUser($data);

        if (!$error) {
            $data['password'] = Password::make($data['password']);
            unset($data['re_password']);
            $c[$this->getModel()]->create($data);
            status_code(201);
            return json_encode(['base_url' => base_url(), 'success' => 'Usuário Cadastrado com Sucesso!', 'status' => 201]);
        }

        status_code(500);
        return json_encode(['error' => $error, 'status' => 500]);
    }

    public function logout($c, $request)
    {
        session_destroy();
        redirect("/");
    }
}
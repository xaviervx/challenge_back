<?php

namespace FireDevChalange\Controle;

use FireDevChalange\Modelo\Auth;

class AuthControle
{
    public function post(){

        $data = json_decode(file_get_contents("php://input"), true);

        return Auth::login($data);
    }
}
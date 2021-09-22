<?php
namespace FireDevChalange\Controle;

use Exception;
use FireDevChalange\Modelo\Auth;
use FireDevChalange\Modelo\Users;

class UsersControle
{
    public function get($id = null)
    {
        if (Auth::checkAuth())
        {
            if ($id)
            {
                return Users::get($id);
            } else
            {
                return Users::getPaged();
            }
        }

        throw new Exception("Usuário não autenticado");
    }

    public function post()
    {
        if (Auth::checkAuth())
        {
            $data = json_decode(file_get_contents("php://input"), true);

            return Users::create($data);
        }

        throw new Exception("Usuário não autenticado");
    }

    public function put($id)
    {
        if (Auth::checkAuth())
        {
            $data = json_decode(file_get_contents("php://input"), true);

            return Users::update($id, $data);
        }

        throw new Exception("Usuário não autenticado");
    }

    public function delete($id)
    {
        if (Auth::checkAuth()) {
            return Users::delete($id);
        }

        throw new Exception("Usuário não autenticado");
    }
}
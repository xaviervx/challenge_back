<?php

namespace FireDevChalange\Modelo;

use Exception;

class Auth
{
    private static $key = '1234';

    public static function login($data)
    {
        $con = conexao::getConexao();

        $user = new UserModel($data);

        $sql = 'SELECT * FROM users WHERE email = :email AND senha = :senha';
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':senha', $user->getSenha());
        $stmt->execute();

        if ($stmt->rowCount() == 0)
            throw new Exception('Email ou senha inválidos');

        // Header
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        $payload = [
            'email' => $user->getEmail(),
        ];

        $header = json_encode($header);
        $payload = json_encode($payload);

        //Base 64
        $header = self::base64UrlEncode($header);
        $payload = self::base64UrlEncode($payload);

        //Sign
        $sign = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
        $sign = self::base64UrlEncode($sign);

        //Token
        $token = $header . '.' . $payload . '.' . $sign;

        return $token;
    }

    public static function checkAuth()
    {
        $http_header = apache_request_headers();

        if (isset($http_header['Authorization']) && $http_header['Authorization'] != null) {
            $bearer = explode (' ', $http_header['Authorization']);

            if (count($bearer) < 2)
                throw new Exception('Erro ao ler o token.');

            $token = explode('.', $bearer[1]);

            if (count($token) < 3)
                throw new Exception('Erro ao ler o token.');

            $header = $token[0];
            $payload = $token[1];
            $sign = $token[2];

            // Conferindo a assinatura
            $valid = hash_hmac('sha256', $header . "." . $payload, self::$key, true);
            $valid = self::base64UrlEncode($valid);

            if ($sign === $valid) {
                return true;
            }
        }

        return false;
    }

    private static function base64UrlEncode($data)
    {
        $b64 = base64_encode($data);

        if ($b64 === false) {
            return false;
        }

        $url = strtr($b64, '+/', '-_');

        return rtrim($url, '=');
    }
}
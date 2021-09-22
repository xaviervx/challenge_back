<?php
namespace FireDevChalange\Modelo;

use Exception;
use PDO;

class Users
{
    public static function get($id)
    {
        try
        {
            $con = conexao::getConexao();

            $sql = 'SELECT * FROM users WHERE id = :id';
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            else
            {
                return 'Nenhum usuário encontrado';
            }
        }
        catch (Exception $ex)
        {
            throw new Exception("Ocorreu um erro ao realizar a requisição.");
        }
    }

    public static function getPaged()
    {
        try
        {
            $con = conexao::getConexao();

            $sql = 'SELECT * FROM users';
            $stmt = $con->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                return 'Nenhum usuário encontrado.';
            }
        }
        catch (Exception $ex)
        {
            throw new Exception("Ocorreu um erro ao realizar a requisição.");
        }
    }

    public static function create($data)
    {
        try
        {
            $con = conexao::getConexao();

            $user = new UserModel($data);

            if (self::hasEmail($user->getEmail()))
                return 'Este email já existe no sistema.';

            $sql = 'INSERT INTO users (name, email, senha) VALUES (:name, :email, :senha)';
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':senha', $user->getSenha());

            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                return 'Usuário inserido com sucesso!';
            }
            else
            {
                return 'Falha ao inserir usuário!';
            }
        }
        catch (Exception $ex)
        {
            throw new Exception("Ocorreu um erro ao realizar a requisição.");
        }
    }

    public static function update($id, $data)
    {
        try
        {
            $con = conexao::getConexao();

            $sql = 'SELECT * FROM users WHERE id = :id';
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() == 0)
                return 'Usuário não encontrado.';

            $userModel = new UserModel($data);

            if (self::hasEmail($userModel->getEmail()))
                return 'Este email já existe no sistema.';

            $sql = 'UPDATE users SET name = :name, email = :email WHERE id = :id';
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':name', $userModel->getName());
            $stmt->bindValue(':email', $userModel->getEmail());
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                return 'Usuário editado com sucesso!';
            }
            else
            {
                return 'Falha ao editar usuário!';
            }
        }
        catch (Exception $ex)
        {
            throw new Exception("Ocorreu um erro ao realizar a requisição.");
        }
    }

    public static function delete($id)
    {
        try
        {
            $con = conexao::getConexao();

            $sql = 'DELETE FROM users WHERE id = :id;)';
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                return 'Usuário deletado com sucesso!';
            }
            else
            {
                return 'Falha ao deletar usuário!';
            }
        }
        catch (Exception $ex) {
            throw new Exception("Ocorreu um erro ao realizar a requisição.");
        }
    }

    private function hasEmail($email)
    {
        try
        {
            $con = conexao::getConexao();

            $sql = 'SELECT * FROM users WHERE email = :email';
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        catch (Exception $ex)
        {
            throw new Exception("Ocorreu um erro ao realizar a requisição.");
        }
    }

}
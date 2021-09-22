<?php
namespace FireDevChalange\Modelo;

use Exception;
use PDO;

class Conexao {

    private static $con;

    public static function getConexao(): PDO {
        try {
            if (is_null(self::$con)) {
                self::$con = new PDO(DBDRIVE.': host='.DBHOST.'; dbname='.DBNAME, DBUSER, DBPASS);
            }
            return self::$con;
        } catch (Exception $ex) {
            echo "<h1>FALHA</h1>";
            exit(0);
        }
    }
}

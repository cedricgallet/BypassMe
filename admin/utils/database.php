<?php

require_once dirname(__FILE__).'/../../admin/config/config.php';

class Database{

    private static $_pdo;

    public static function db_connect()
    {   
        try {
            if(is_null(self::$_pdo)){
                self::$_pdo = new PDO(DSN, LOGIN, PASSWORD);
                self::$_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }
            return self::$_pdo;
        } catch (PDOException $e) {
            echo sprintf('Problème de connexion à la base de donnée', $e->getMessage());
            die();
        }
    }

}
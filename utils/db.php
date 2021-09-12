<?php
include(dirname(__FILE__).'/../utils/dbConfig.php');

class Database
{

    private static $_pdo;

    public static function db_connect()
    {
        try {
            if(is_null(self::$_pdo)){
                self::$_pdo = new PDO(DSN, ROOT, PASSWORD);
                self::$_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$_pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }
            return self::$_pdo;
        } catch (PDOException $e) {
            echo sprintf('Probleme de connexion avec l\'erreur %s', $e->getMessage());
            die();
        }
    }

}

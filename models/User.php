<?php
require_once dirname(__FILE__).'/../utils/db.php';
require_once dirname(__FILE__).'/../utils/sendMail.php';


class User{

    use sendMail;

    private $_pseudo;
    private $_email;
    private $_password;
    private $_ip;
    private $_avatar;
    private $_state;
    private $_confirmed_at;
    private $_created_at;
    private $_deleted_at;


    public function __construct($pseudo, $email, $password, 
    $ip=NULL, $avatar=NULL, $state=1, $confirmed_at = NULL, $created_at = NULL, $deleted_at =NULL)
    {

        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pseudo = $pseudo;
        $this->_email = $email;
        $this->_password = $password;
        $this->_ip = $ip;
        $this->_avatar = $avatar;
        $this->_state = $state;
        $this->_confirmed_at = $confirmed_at;
        $this->_created_at = $created_at;
        $this->_deleted_at = $deleted_at;

        $this->_pdo = Database::db_connect();


    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function createUser(){
        try{
            $sql = 'INSERT INTO `user` (`pseudo`, `email`, `password`, `ip`, `confirmation_token`) 
                    VALUES (:pseudo, :email, :password, :ip, :confirmation_token);';
            
            $sth = $this->_pdo->prepare($sql);

            $token = $this->setToken();

            $sth->bindValue(':pseudo',$this->_pseudo,PDO::PARAM_STR);
            $sth->bindValue(':email',$this->_email,PDO::PARAM_STR);
            $sth->bindValue(':password',$this->_password,PDO::PARAM_STR);
            $sth->bindValue(':ip',$this->_ip,PDO::PARAM_STR);
            $sth->bindValue(':confirmation_token',$token,PDO::PARAM_STR);

            
            if($sth->execute()){
                //envoi d'un mail
                $id = $this->_pdo->lastInsertId();
                $this->sendMailConfirm($id, $this->_email, $token);
                return true;
            } else {
                return false;
            }
            

        }
        catch(PDOException $e){
            return false;
        }
    }



    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de récupérer le profil d'un Utilisateur
     * 
     * @return object
     */
    public static function getUser($id)
    {
        
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `user` 
                    WHERE `id` = :id;';

            $sth = $pdo->prepare($sql);

            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            if($sth->execute()){
                return($sth->fetch());
            }
            
        }
        catch(PDOException $e){
            return $e;
        }
    }


    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function getUserByEmail($email)
    {

        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `user` 
                    WHERE `email` = :email AND confirmed_at IS NOT NULL';

            $sth = $pdo->prepare($sql);

            $sth->bindValue(':email',$email);

            if($sth->execute()){
                return($sth->fetch());
            }
            
        }
        catch(PDOException $e){
            return $e;
        }

    }


    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    private function setToken()
    {
        $length = 60;
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }


    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function validateSignUp($id)
    {

        try{

            $pdo = Database::db_connect();
            $sql = 'UPDATE `user` 
                    SET `confirmed_at` = NOW()
                    WHERE `id` = :id;';
            $sth = $pdo->prepare($sql);

            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            
            if($sth->execute()){
                return $sth->rowCount(); 
            }
            
        }
        catch(PDOException $e){
            return false;
        }

    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function getAllUser()
    {
        $sql = "SELECT * FROM `user`;";

        $pdo = Database::db_connect();

        $req = $pdo->prepare($sql);

        try {
            if($req->execute()) 
            {
                // on return les données récupérées
                return $req->fetchAll(PDO::FETCH_OBJ);
            }
        } catch (PDOException $ex) {
            return $ex;
        }
        
    }

}
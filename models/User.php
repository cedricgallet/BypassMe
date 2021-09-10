<?php
require_once dirname(__FILE__).'/../utils/database.php';
require_once dirname(__FILE__).'/../utils/sendMail.php';


class User{

    use sendMail;

    private $_pseudo;
    private $_email;
    private $_password;
    private $_ip;
    private $_avatar;
    private $_type;
    private $_created_at;
    private $_updated_at;
    private $_deleted_at;


    public function __construct($pseudo, $email, $password, $ip, 
    $avatar =NULL, $type, $created_at =NULL,
    $updated_at =NULL, $deleted_at =NULL)
    {

        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pseudo = $pseudo;
        $this->_email = $email;
        $this->_password = $password;
        $this->_ip = $ip;
        $this->_avatar = $avatar;
        $this->_type = $type;
        $this->_created_at = $created_at;
        $this->_updated_at = $updated_at;
        $this->_deleted_at = $deleted_at;

        $this->_pdo = Database::getInstance();


    }


    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de récupérer le profil d'un Utilisateur
     * 
     * @return object
     */
    public static function get($id)
    {
        
        $pdo = Database::getInstance();

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
    public static function getByEmail($email)
    {

        $pdo = Database::getInstance();

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
    public function create()
    {
        try{
            $sql = 'INSERT INTO `user` (`lastname`, `email`, `password`, `pseudo`, `confirmation_token`) 
                    VALUES (:lastname, :email, :password, :pseudo, :confirmation_token);';
            
            $sth = $this->_pdo->prepare($sql);

            $token = $this->setToken();

            $sth->bindValue(':lastname',$this->_lastname,PDO::PARAM_STR);
            $sth->bindValue(':email',$this->_email,PDO::PARAM_STR);
            $sth->bindValue(':password',$this->_password,PDO::PARAM_STR);
            $sth->bindValue(':pseudo',$this->_pseudo,PDO::PARAM_STR);
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

            $pdo = Database::getInstance();
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

}
<?php
require_once __DIR__.'/../utils/db.php';
require_once __DIR__.'/../utils/config.php';
require_once __DIR__.'/../utils/sendMail.php';

class User
{
    private $_id=0;
    private $_pseudo;
    private $_email;
    private $_password;
    private $_ip;
    private $_token;
    private $_avatar;
    private $_active;
    private $_created_at;
    private $_updated_at;
    private $_deleted_at;

    private $_pdo;

    public function __construct($pseudo, $email, $password, $ip =NULL, 
                                $token =NULL, $avatar =NULL, $active =NULL, $created_at =NULL,
                                $updated_at =NULL, $deleted_at =NULL)
    {
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pseudo = $pseudo;
        $this->_email = $email;
        $this->_password = $password;
        $this->_ip = $ip;
        $this->_token = $token;
        $this->_avatar = $avatar;
        $this->_active = $active;
        $this->_created_at = $created_at;
        $this->_updated_at = $updated_at;
        $this->_deleted_at = $deleted_at;

        $this->pdo = Database::db_connect();
    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // VERIFIFIER MAIL EXISTE ok
    
    public static function getByEmail($email){

        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `users` 
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

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // READ ONE LIGNE ok
    public static function get($id){
        
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `users` 
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

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //CREATE ok
    public function create()
    {
        try{
            $sql = 'INSERT INTO `users`(`pseudo`, `email`, `password`, `ip`, `confirmation_token`) 
            VALUES (:pseudo, :email, :password, :ip, :confirmation_token);';
            
            $sth = $this->_pdo->prepare($sql);

            $token = $this->setToken();

            $sth->bindValue(':pseudo',$this->_pseudo,PDO::PARAM_STR);
            $sth->bindValue(':email',$this->_email,PDO::PARAM_STR);
            $sth->bindValue(':password',$this->_password,PDO::PARAM_STR);
            $sth->bindValue(':ip',$this->_ip,PDO::PARAM_STR);
            $sth->bindValue(':confirmation_token',$this->$token,PDO::PARAM_STR);
            
            if($sth->execute())
            {
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
    
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //READ ALL ok  @return array
    public static function getAll()
    {
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `users`;';
            $sth = $pdo->query($sql);
            return($sth->fetchAll());
        }
        catch(PDOException $e){
            return false;
        }

    }
    
    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //UPDATE ok
    public function updateUser($id){

        try{
            $sql = 'UPDATE `users` SET `pseudo` = :pseudo, `email` = :email, `ip` = :ip
                    WHERE `id` = :id;';

            $sth = $this->_pdo->prepare($sql);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->bindValue(':pseudo',$this->_pseudo,PDO::PARAM_STR);
            $sth->bindValue(':email',$this->_email,PDO::PARAM_STR);
            $sth->bindValue(':password',$this->_password,PDO::PARAM_STR);
            $sth->bindValue(':ip',$this->_ip,PDO::PARAM_STR);
            $sth->bindValue(':token',$this->_token,PDO::PARAM_STR);

            return($sth->execute()); 
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // DELETE RDV
    public function DeleteUser($id)
    {
        $sql = "DELETE FROM `users` WHERE `user`.`id` = :id;"; // A TESTER

        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id',$id,PDO::PARAM_INT);

        try {
            $sth->execute();
            return 10;

        } catch (PDOException $ex) {
            return false;
        }
    }

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // TOKEN
    private function setToken()
    {
        $length = 60;
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // VALIDATION REGISTER

    public static function validateSignUp($id)
    {
        try{

            $pdo = Database::db_connect();
            $sql = 'UPDATE `users` 
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



<?php
require_once(dirname(__FILE__).'/../utils/db.php');

class User
{
    private $_id=0;
    private $_pseudo;
    private $_email;
    private $_password;
    private $_ip;
    private $_token;

    private $_pdo;

    public function __construct($id =NULL,$pseudo =NULL,$email =NULL, $password =NULL, $ip =NULL, $token =NULL)
    {
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_id = $id;
        $this->_pseudo = $pseudo;
        $this->_email = $email;
        $this->_password = $password;
        $this->_ip = $ip;
        $this->_token = $token;

        $this->pdo = Database::db_connect();
    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // VERIFIFIER SI MAIL EXISTE ok
    public static function checkDuplicate($email)
    {
        $checkMailSql ="SELECT `email`
                        FROM `users` 
                        WHERE `email`= :email;";

        $pdo = Database::db_connect();

        $stmtCheckMailReq = $pdo->prepare($checkMailSql);
        
        $stmtCheckMailReq->bindValue(':email',$email,PDO::PARAM_STR);
        
        try 
        {
            $stmtCheckMailReq->execute();
            $data = $stmtCheckMailReq->fetch();
            return $data;
        } catch (PDOException $ex) {
            return false;
        }
    }     

    
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //CREATE ok
        public function create(){

        try{
            $sql = 'INSERT INTO `users` (`pseudo`, `email`, `password`, `ip`, `token`) 
                    VALUES (:pseudo, :email, :password, :ip, :token)';
                    
            $sth = $this->pdo->prepare($sql);

            $sth->bindValue(':lastname',$this->_lastname,PDO::PARAM_STR);
            $sth->bindValue(':firstname',$this->_firstname,PDO::PARAM_STR);
            $sth->bindValue(':birthdate',$this->_birthdate,PDO::PARAM_STR);
            $sth->bindValue(':phone',$this->_phone,PDO::PARAM_STR);
            $sth->bindValue(':mail',$this->_mail,PDO::PARAM_STR);
            return $sth->execute();
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }
    
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //READ ALL ok  @return array
    public static function readAllUsers()
    {
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `users`';
            $sth = $pdo->query($sql);
            return($sth->fetchAll());
        }
        catch(PDOException $e){
            return false;
        }

    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // READ ONE LIGNE ok
    public static function readOneUser($id,$email){
    
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT `id`, `pseudo`, `email`, `password`, `ip`, `token` FROM `users` WHERE `id` = :id OR `email` = :email;';
            $sth = $pdo->prepare($sql);

            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->bindValue(':email',$email,PDO::PARAM_STR);
            $sth->execute();
            return($sth->fetch());
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
                    WHERE `id` = :id';
            $sth = $this->_pdo->prepare($sql);
            $sth->bindValue(':pseudo',$this->_pseudo,PDO::PARAM_STR);
            $sth->bindValue(':email',$this->_email,PDO::PARAM_STR);
            $sth->bindValue(':password',$this->_password,PDO::PARAM_STR);
            $sth->bindValue(':ip',$this->_ip,PDO::PARAM_STR);
            $sth->bindValue(':token',$this->_token,PDO::PARAM_STR);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            return($sth->execute()); 
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

}



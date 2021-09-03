<?php
require_once(dirname(__FILE__).'/../utils/db.php');

class User
{
    private $_id=0;
    private $_pseudo;
    private $_email;
    private $_password;
    private $_avatar;
    private $_ip;
    private $_token;
    private $_active;
    private $_created_at;
    private $_updated_at;
    private $_deleted_at;

    private $_pdo;

    public function __construct($id =NULL,$pseudo =NULL,$email =NULL, $password =NULL, $avatar =NULL, $ip =NULL, $token =NULL, $active =NULL, $created_at =NULL, $updated_at =NULL, $deleted_at =NULL)
    {
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_id = $id;
        $this->_pseudo = $pseudo;
        $this->_email = $email;
        $this->_password = $password;
        $this->_avatar = $avatar;
        $this->_ip = $ip;
        $this->_token = $token;
        $this->_active = $active;
        $this->_created_at = $created_at;
        $this->_updated_at = $updated_at;
        $this->_deleted_at = $deleted_at;

        $this->pdo = Database::db_connect();
    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // VERIFIFIER SI MAIL EXISTE ok
    public static function checkDuplicate($email)
    {
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT `id`, `pseudo`, `email`, `password`,`avatar`, `ip`, `token` FROM `users` WHERE `email` = :email;';
            $sth = $pdo->prepare($sql);

            $sth->bindValue(':email',$email,PDO::PARAM_STR);
            $sth->execute();
            return($sth->fetch());
        }
        catch(PDOException $e){
            return false;
        }
    }     

    
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //CREATE ok
        public function create(){
        try{
            $sql = 'INSERT INTO `users`(`pseudo`, `email`, `password`, `ip`, `token`) VALUES (:pseudo, :email, :password, :ip, :token)';
                    
            $sth = $this->pdo->prepare($sql);

            //echo "Pseudo :" . $this -> _pseudo . "<br/>";
            //echo "Email :" .$this -> _email . "<br/>";
            //echo "Password :" .$this -> _password . "<br/>";
            //echo "Ip :" .$this -> _ip . "<br/>";
            //echo "Token :" .$this -> _token . "<br/>";

            $sth->bindValue(':pseudo',$this->_pseudo,PDO::PARAM_STR);
            $sth->bindValue(':email',$this->_email,PDO::PARAM_STR);
            $sth->bindValue(':password',$this->_password,PDO::PARAM_STR);
            $sth->bindValue(':ip',$this->_ip,PDO::PARAM_STR);
            $sth->bindValue(':token',$this->_token,PDO::PARAM_STR);
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
            $sql = 'SELECT * FROM `users`;';
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
            $sql = 'SELECT * 
            FROM `users` WHERE `id` = :id OR `email` = :email;';
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

}



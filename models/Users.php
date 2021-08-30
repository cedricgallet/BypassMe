<?php
require_once(dirname(__FILE__).'/../utils/db.php');
require_once(dirname(__FILE__).'/../utils/config.php');

class Users
{
    private $id = 0;
    private $pseudo;
    private $email;
    private $password;
    private $ip;
    private $token;

    private $pdo;

    public function __construct($id = "",$pseudo = "",$email = "", $password = "", $ip = "", $token = "")
    {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->ip = $ip;
        $this->token = $token;
        $this->id = $id;

        $this->pdo = Database::db_connect();
    }

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // CHECK SI MAIL EXISTE ok
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
            return $stmtCheckMailReq->fetchColumn();
        } catch (PDOException $ex) {
            return false;
        }
    } 
    
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        //CREATE ok
    public function Create()
    {
        if($this->checkDuplicate($this->email) == false)
        {
            $sql = "INSERT INTO `users` (`pseudo`, `email`, `password`, `ip`, `token`) 
                    VALUES (:pseudo, :email, :password, :ip, :token);";
            
            $sth = $this->pdo->prepare($sql);

            $sth->bindValue(':pseudo', $this->pseudo,PDO::PARAM_STR);
            $sth->bindValue(':email', $this->email,PDO::PARAM_STR);
            $sth->bindValue(':password', $this->password,PDO::PARAM_STR);
            $sth->bindValue(':ip', $this->ip,PDO::PARAM_STR);
            $sth->bindValue(':token', $this->token,PDO::PARAM_INT);

            try 
            {
                return $sth->execute();
            } catch (PDOException $ex) {
                return 4;
            }
        } else {
            return 2;
        }
    }
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //READ ALL ok
    public static function ReadAllPatient()
    {
        $sql = "SELECT * FROM `users`;";

        $pdo = Database::db_connect();

        $sth = $pdo->prepare($sql);

        try {
            if($sth->execute()) 
            {
                // on return les données récupérées sous un tableau
                return $sth->fetchAll();
            }
        } catch (PDOException $ex) {
            return 4;
        }
        
    }

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // READ ONE LIGNE ok
    public static function ReadOnepatient($id)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = $id;";

        $pdo = Database::db_connect();
        
        $sth = $pdo->prepare($sql);
        //$req->bindValue(':pseudo', $this->pseudo);
        // $req->bindValue(':firstname', $this->firstname);
        // $req->bindValue(':birthdate', $this->birthdate);

        try {
            if($sth->execute()) {
                // on return les données récupérées
                return $sth->fetch();
            }
        } catch (PDOException $ex) {
            return false;
        }
    }

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //UPDATE ok
    public function Update()
    {
        $oldEmail = $this->checkDuplicate($this->email);

        if(!($this->checkDuplicate($this->email)) || $oldEmail == $this->email)
        {

            $sql = "UPDATE  `users` 
                    SET `pseudo`=:pseudo, `email`=:email, `password`=:password, `ip`=:ip, `token`=:token
                    WHERE `id` = :id;";

            $sth = $this->pdo->prepare($sql);

            $sth->bindValue(':pseudo', $this->pseudo,PDO::PARAM_STR);
            $sth->bindValue(':email', $this->email,PDO::PARAM_STR);
            $sth->bindValue(':password', $this->password,PDO::PARAM_STR);
            $sth->bindValue(':ip', $this->ip,PDO::PARAM_STR);
            $sth->bindValue(':token', $this->token,PDO::PARAM_STR);
            $sth->bindValue(':id', $this->id,PDO::PARAM_INT);
            
            try {
                
                    // on return les données récupérées
                    $test = $sth->execute();
                    return $test;
                
            } catch (PDOException $ex) {
                return false;
            }
        } else {
            return 3;

        }
    }

}

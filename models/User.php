<?php

require_once dirname(__FILE__).'/../utils/database.php';
require_once dirname(__FILE__).'/../utils/sendMail.php';

class User
{

    use sendMail;

    private $_pseudo;
    private $_email;
    private $_password;
    private $_ip;
    private $_created_at;
    private $_deleted_at;

    private $_pdo;


    public function __construct($pseudo, $email, $password, $ip = NULL, $created_at = NULL, $deleted_at = NULL)
    {
        
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pseudo = $pseudo;
        $this->_email = $email;
        $this->_password = $password;
        $this->_ip = $ip;                           
        $this->_created_at = $created_at;
        $this->_deleted_at = $deleted_at;

        $this->_pdo = Database::db_connect();


    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de récupérer le rendez-vous d'un patient
     * 
     * @return object
     */
    public static function get($id)
    {
        
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `user` 
                    WHERE `id` = :id;';
            $sth = $pdo->prepare($sql);

            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->execute();
            $user = $sth->fetch();
            if(!$user){
                return '3';
            }
            
            return $user;
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }
    
    
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function getByEmail($email)
    {

        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `user` 
                    WHERE `email` = :email;';

            $sth = $pdo->prepare($sql);

            $sth->bindValue(':email',$email,PDO::PARAM_STR);

            if($sth->execute()){
                return($sth->fetch());
            }
            
        }
        catch(PDOException $e){
            return $e;
        }

    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function createUser()
    {
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

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    private function setToken()
    {
        $length = 60;
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function validateSignUp($id)
    {
        
        try{

            $pdo = Database::db_connect();
            $sql = 'UPDATE `user` 
                    SET `created_at` = NOW()
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
    
    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de mettre à jour un patient
     * 
     * @return boolean
     */
    public function update($id)
    {

        try{

            $sql = "UPDATE `user` SET `pseudo`=:pseudo,`email`=:email WHERE id = :id";

            $sth = $this->_pdo->prepare($sql);
            
            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->bindValue(':pseudo',$this->_pseudo,PDO::PARAM_STR);
            $sth->bindValue(':email',$this->_email,PDO::PARAM_STR);

            return($sth->execute()); 
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de supprimer un utilisateur
     * 
     * @return boolean
     */
    public static function delete($id)
    {

        $pdo = Database::db_connect();

        try{
            $sql = 'DELETE FROM `user`
                    WHERE `id` = :id;';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->execute();
            if($sth->rowCount()==0)
                return 3;
            else
                return 10;
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de compter les user
     * 
     * @return int
     */
    public static function count($s)
    {
        $pdo = Database::db_connect();
        try{
            $sql = 'SELECT * FROM `user`
                WHERE `pseudo` LIKE :search 
                OR `email` LIKE :search;';

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':search','%'.$s.'%',PDO::PARAM_STR);
            $stmt->execute();
            return($stmt->rowCount());
        }
        catch(PDOException $e){
            return 0;
        }
        
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de lister tous les utilisateurs existants en fonction d'un mot clé et selon pagination
     * 
     * @return array
     */
    public static function getAll($search='', $limit=null, $offset=0)
    {
        
        try{
            if(!is_null($limit)){ // Si une limite est fixée, il faut tout lister
                $sql = 'SELECT * FROM `user` 
                WHERE `pseudo` LIKE :search 
                OR `email` LIKE :search 
                LIMIT :limit OFFSET :offset;';
            } else {
                $sql = 'SELECT * FROM `user` 
                WHERE `pseudo` LIKE :search 
                OR `email` LIKE :search;';
            }

            $pdo = Database::db_connect();

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':search','%'.$search.'%',PDO::PARAM_STR);
            
            if(!is_null($limit)){
                $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            return($stmt->fetchAll());
        }
        catch(PDOException $e){
            return false;
        }

    }
    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        /**
     * Méthode qui permet de lister tous les commentaires d'un utilisateur
     * 
     * @return array
     */
    public static function getAllByIdUser($id)
    {

        $pdo = Database::db_connect();

        try{
            $sql = '    SELECT `comment`.`id` as `commentId`, `patients`.`id` as `user_id`, `user`.*, `comment`.* 
                        FROM `comment` 
                        INNER JOIN `user`
                        ON `comment`.`iduser` = `user`.`id`
                        WHERE `comment`.`iduser` = :id
                        ORDER BY `comment` DESC;';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute(); 
            return $stmt->fetchAll();
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

}
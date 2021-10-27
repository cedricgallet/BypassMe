<?php
include(dirname(__FILE__).'/../utils/database.php');


class Contact{

    private $_email;
    private $_subject;
    private $_message;
    private $_state;
    private $_created_at;
    private $_deleted_at;

    private $_pdo;

    /**
     * Méthode magique appellée lors de l'instanciation de l'objet dans le controlleur. Elle permet d'hydrater notre objet 'Contact'
     * 
     * @return boolean
     */
    public function __construct($email, $subject, $message, $state = 1, $created_at = NULL, $deleted_at =NULL)
    {
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pdo = Database::db_connect();

        $this->_email = $email;
        $this->_subject = $subject;
        $this->_message = $message;
        $this->_state = $state;                           
        $this->_created_at = $created_at;
        $this->_deleted_at = $deleted_at;

    }

    /**
     * Méthode qui permet de créer un commentaire
     * 
     * @return boolean
     */
    public function createMessage()
    {
        try{
            $sql = 'INSERT INTO `message` ( `email`, `subject`, `message`, `state`) 
                    VALUES ( :email,  :subject, :message, :state);';
            
            $sth = $this->_pdo->prepare($sql);


            $sth->bindValue(':email',$this->_email,PDO::PARAM_STR);
            $sth->bindValue(':subject',$this->_subject,PDO::PARAM_STR);
            $sth->bindValue(':message',$this->_message,PDO::PARAM_STR);
            $sth->bindValue(':state',$this->_state,PDO::PARAM_INT);

            
            if($sth->execute()){
                return true;
            } else {
                return false;
            }
            

        }
        catch(PDOException $e){
            return $e->getCode();        
        }
    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function getMessageByEmail($email)
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

    // ***********************************************************

     /**
     * Méthode qui permet de lister tous les rdv
     * 
     * @return array
     */
    public static function getAll()
    {

        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT `message`.`id` as `messageId`, `user`.`id` as `userId`, `user`.*, `message`.* 

                    FROM `message` 
                    INNER JOIN `user`
                    ON `message`.`messageId` = `user`.`id`

                    ORDER BY `message` DESC;';

            $stmt = $pdo->query($sql);
            return $stmt->fetchAll();
        }
        catch(PDOException $e){
            return false;
        }

    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de récupérer un commentaire
     * 
     * @return object
     */
    
    public static function getMessage($id)
    {
        
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `message` 
                    WHERE `id` = :id;';
            $sth = $pdo->prepare($sql);

            $sth->bindValue(':id',$id,PDO::PARAM_INT);

            $sth->execute();

            $messageInfo = $sth->fetch();
            
            if(!$messageInfo){
                return '39';
            }
            
            return $messageInfo;
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

    // +++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de modifier un article
     * 
     * @return boolean
     */
    public function updateMessage($id)
    {

        try{
            $sql = 'UPDATE `message` 
                    SET `subject` = :subject,`message` = :message, `state`=:state
                    WHERE `id` = :id;';

            $sth = $this->_pdo->prepare($sql);

            $sth->bindValue(':subject',$this->_subject,PDO::PARAM_STR);
            $sth->bindValue(':message',$this->_message,PDO::PARAM_STR);
            $sth->bindValue(':state',$this->_state,PDO::PARAM_INT);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);

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
    public static function deleteMessage($id)
    {

        $pdo = Database::db_connect();

        try{
            $sql = 'DELETE FROM `message`
                    WHERE `id` = :id;';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->execute();
            
            if($sth->rowCount()==0){
                return 39;

            }else{
                return 45;
            }
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de lister tous les messages existants en fonction d'un mot clé et selon pagination
     * 
     * @return array
     */   
    
    public static function searchAllMessage($search='', $limit=null, $offset=0)
    {
        
        try{
            if(!is_null($limit)){ // Si une limite est fixée, il faut tout lister
                $sql = 'SELECT * FROM `message` 
                WHERE `subject` LIKE :search 
                OR `message` LIKE :search 
                LIMIT :limit OFFSET :offset;';
            } else {
                $sql = 'SELECT * FROM `message` 
                WHERE `subject` LIKE :search 
                OR `message` LIKE :search;';
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
    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de compter les messages
     * 
     * @return int
     */
    public static function countMessage($s)
    {
        $pdo = Database::db_connect();
        try{
            $sql = 'SELECT * FROM `message`
                WHERE `subject` LIKE :search 
                OR `message` LIKE :search;';

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':search','%'.$s.'%',PDO::PARAM_STR);
            $stmt->execute();
            return($stmt->rowCount());
        }
        catch(PDOException $e){
            return 0;
        }
        
    }

}

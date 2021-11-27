<?php
include(dirname(__FILE__).'/../../admin/utils/database.php');


class Message{

    private $_subject;
    private $_message;
    private $_state;
    private $_created_at;
    private $_disabled_at;
    private $_id_user;

    private $_pdo;

    /**
     * Méthode magique appellée lors de l'instanciation de l'objet dans le controlleur. Elle permet d'hydrater notre objet 'Message'
     * 
     * @return boolean
     */
    public function __construct($subject, $message, $state = 1, $created_at = NULL, $disabled_at = NULL, $id_user)
    {
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pdo = Database::db_connect();

        $this->_subject = $subject;
        $this->_message = $message;
        $this->_state = $state;                           
        $this->_created_at = $created_at;
        $this->_disabled_at = $disabled_at;
        $this->_id_user = $id_user;

    }

    // ************************************************************************
    /**
     * Méthode qui permet de créer un commentaire
     * 
     * @return boolean
     */
    public function createMessage()
    {
        try{
            $sql = 'INSERT INTO `message` (`subject`, `message`, `state`, `id_user`) 
                    VALUES (:subject, :message, :state, :id_user);';
            
            $sth = $this->_pdo->prepare($sql);


            $sth->bindValue(':subject',$this->_subject,PDO::PARAM_STR);
            $sth->bindValue(':message',$this->_message,PDO::PARAM_STR);
            $sth->bindValue(':state',$this->_state,PDO::PARAM_INT);
            $sth->bindValue(':id_user',$this->_id_user,PDO::PARAM_INT);

            
            if($sth->execute()){
                return 40;
            } else {
                return 42;
            }
            

        }
        catch(PDOException $e){
            return $e->getCode();        
        }
    }

    // ***********************************************************
    // Méthode qui permet de récupérer tous les messages 

    public static function getAllMessage()
    {

        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT `user`.`id` as `id_user`, `user`.*, `message`.* 
                        FROM `message` 
                        INNER JOIN `user`
                        ON `message`.`id_user` = `user`.`id`
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
     * Méthode qui permet de récupérer un seul message grace a l'id
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
            $getMessageUser = $sth->fetch();
            
            if(!$getMessageUser){
                return '39';
            }
            
            return $getMessageUser;
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
                    SET `subject` = :subject, `message` = :message, `state`= :state, `id_user`= :id_user
                    WHERE `id` = :id;';

            $sth = $this->_pdo->prepare($sql);

            $sth->bindValue(':subject',$this->_subject,PDO::PARAM_STR);
            $sth->bindValue(':message',$this->_message,PDO::PARAM_STR);
            $sth->bindValue(':state',$this->_state,PDO::PARAM_INT);
            $sth->bindValue(':id_user',$this->_id_user,PDO::PARAM_INT);

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

    // *************************************************************
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

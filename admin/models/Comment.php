<?php
require_once dirname(__FILE__).'/../../admin/utils/database.php';


class Comment{

    private $_comment; 
    private $_state;
    private $_created_at;
    private $_disabled_at;
    private $_id_user;
    private $_id_article;

    private $_pdo;

    /**
     * Méthode magique appellée lors de l'instanciation de l'objet dans le controlleur. Elle permet d'hydrater notre objet 'comment'
     * 
     * @return boolean
     */
    public function __construct($comment, $state = 1, $created_at = NULL, $disabled_at =NULL, $id_user, $id_article)
    {
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pdo = Database::db_connect();

        $this->_comment = $comment;
        $this->_state = $state;                           
        $this->_created_at = $created_at;
        $this->_disabled_at = $disabled_at;
        $this->_id_user = $id_user;
        $this->_id_article = $id_article;

    }
    // ****************************************************************
    /**
     * Méthode qui permet de créer un commentaire
     * 
     * @return boolean
     */
    public function createComment()
    {
        try{
            $sql = 'INSERT INTO `comment` (`comment`, `state`, id_user, id_article) 
                    VALUES (:comment, :state , :id_user , :id_article);';
            
            $sth = $this->_pdo->prepare($sql);


            $sth->bindValue(':comment',$this->_comment,PDO::PARAM_STR);
            $sth->bindValue(':state',$this->_state,PDO::PARAM_INT);
            $sth->bindValue(':id_user',$this->_id_user,PDO::PARAM_INT);
            $sth->bindValue(':id_article',$this->_id_article,PDO::PARAM_INT);

            
            if($sth->execute()){
                var_dump($sth->execute());die;//AAAAAAAAAAAA
                return true;
            } else {
                return false;
            }
            

        }
        catch(PDOException $e){
            return $e->getCode();        
        }
    }

    // ****************************************************************
    /**
     * Méthode qui permet de récupérer un commentaire
     * 
     * @return object
     */
    
    public static function getComment($id)
    {
        
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `comment` 
                    WHERE `id` = :id;';
            $sth = $pdo->prepare($sql);

            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->execute();

            $commentInfo = $sth->fetch();
            if(!$commentInfo){
                return '8';
            }
            
            return $commentInfo;
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }
    


     // ****************************************************************
    
    //  Méthode qui permet de lister tous les commentaires  
    public static function getAllComment()
    {
        $sql = "SELECT * FROM `comment`;";

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


    // ****************************************************************
    /**
     * Méthode qui permet de modifier un commentaires
     * 
     * @return boolean
     */
    public function updateComment($id)
    {

        try{
            $sql = 'UPDATE `comment` 
                    SET `comment` = :comment, `state`=:state
                    WHERE `id` = :id;';

            $sth = $this->_pdo->prepare($sql);

            $sth->bindValue(':comment',$this->_comment,PDO::PARAM_STR);
            $sth->bindValue(':state',$this->_state,PDO::PARAM_INT);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);

            return($sth->execute()); 
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

      // ****************************************************************
    /**
     * Méthode qui permet de supprimer un commentaire
     * 
     * @return boolean
     */
    public static function deleteComment($id)
    {

        $pdo = Database::db_connect();

        try{
            $sql = 'DELETE FROM `comment`
                    WHERE `id` = :id;';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->execute();
            
            if($sth->rowCount()==0){
                return 8;

            }else{
                return 9;
            }
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }



    // ****************************************************************
    /**
     * Méthode qui permet de lister tous les commentaires existants en fonction d'un mot clé et selon pagination
     * 
     * @return array
     */   
    
    public static function searchAllComment($search='', $limit=null, $offset=0)
    {
        
        try{
            if(!is_null($limit)){ // Si une limite est fixée, il faut tout lister
                $sql = 'SELECT * FROM `comment` 
                WHERE `comment` LIKE :search 
                LIMIT :limit OFFSET :offset;';
            } else {
                $sql = 'SELECT * FROM `comment` 
                WHERE `comment` LIKE :search;';
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
    // ****************************************************************
    /**
     * Méthode qui permet de compter les commentaires
     * 
     * @return int
     */
    public static function countComment($s)
    {
        $pdo = Database::db_connect();
        try{
            $sql = 'SELECT * FROM `comment`
                WHERE `comment` LIKE :search;';

            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':search','%'.$s.'%',PDO::PARAM_STR);
            $stmt->execute();
            return($stmt->rowCount());
        }
        catch(PDOException $e){
            return 0;
        }
        
    }

    // ***************************************************************************************
    /**
     * Méthode qui permet d'afficher l'utilisateur, l'article et son commentaire 
     * 
     * @return array
     */
    public static function getAllCommentByIdUser($id)
    {

        $pdo = Database::db_connect();

        try{
            $sql = '    SELECT `comment`.`id` as `id`, `user`.`id` as `user_id`, `user`.*, `comment`.* 
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

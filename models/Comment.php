<?php
require_once(dirname(__FILE__).'/../utils/db.php');
require_once(dirname(__FILE__).'/../utils/config.php');

class Comment{

    private $_categories;
    private $_title;
    private $_article;
    private $_confirmed_at;
    private $_created_at;
    private $_deleted_at;

    
    private $_pdo;

    /**
     * Méthode magique appellée lors de l'instanciation de l'objet dans le controlleur. Elle permet d'hydrater notre objet 'Appointment'
     * 
     * @return boolean
     */
    public function __construct($categories=NULL, $title=NULL, $article=NULL,$confirmed_at=NULL, $created_at = NULL, $deleted_at =NULL)
    {
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pdo = Database::db_connect();
        $this->_categories = $categories;
        $this->_title = $title;
        $this->_article = $article;
        $this->_confirmed_at = $confirmed_at;
        $this->_created_at = $created_at;
        $this->_deleted_at = $deleted_at;

    }

    /**
     * Méthode qui permet de créer un article
     * 
     * @return boolean
     */
    public function createComment()
    {

        try{
            $sql = 'INSERT INTO `comment` (`categories`, `title`, `article`) 
                    VALUES (:categories, :title, :article);';
            $stmt = $this->_pdo->prepare($sql);

            $stmt->bindValue(':categories',$this->_categories,PDO::PARAM_STR);
            $stmt->bindValue(':title',$this->_title,PDO::PARAM_INT);
            $stmt->bindValue(':article',$this->_article,PDO::PARAM_STR);
            return $stmt->execute();
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }


    // +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    /**
     * Méthode qui permet de récupérer un article
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
            $article = $sth->fetch();
            if(!$article){
                return '23';
            }
            
            return $article;
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
    public function updateComment($id)
    {

        try{
            $sql = 'UPDATE `comment` SET `categories` = :categories, `title` = :title, `article` = :article,
                    WHERE `id` = :id;';
            $sth = $this->_pdo->prepare($sql);
            $sth->bindValue(':categories',$this->_categories,PDO::PARAM_STR);
            $sth->bindValue(':title',$this->_title,PDO::PARAM_STR);
            $sth->bindValue(':article',$this->_article,PDO::PARAM_STR);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            return($sth->execute()); 
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    // Méthode qui permet de supprimer un article
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
                return 23;

            }else {
                return 31;
            }
            
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //  Méthode qui permet de lister tous les article  
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

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public static function searchAllComment($search='', $limit=null, $offset=0)
    {
        
        try{
            if(!is_null($limit)){ // Si une limite est fixée, il faut tout lister
                $sql = 'SELECT * FROM `comment` 
                WHERE `categories` LIKE :search 
                OR `title` LIKE :search 
                LIMIT :limit OFFSET :offset;';
            } else {
                $sql = 'SELECT * FROM `comment` 
                WHERE `categories` LIKE :search 
                OR `title` LIKE :search;';
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

}
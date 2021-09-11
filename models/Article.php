<?php
require_once(dirname(__FILE__).'/../utils/db.php');
require_once(dirname(__FILE__).'/../utils/config.php');

class Article{

    private $_categories;
    private $_title;
    private $_article;    
    private $_pdo;

    /**
     * Méthode magique appellée lors de l'instanciation de l'objet dans le controlleur. Elle permet d'hydrater notre objet 'Appointment'
     * 
     * @return boolean
     */
    public function __construct($categories=NULL, $title=NULL, $article=NULL)
    {
        // Hydratation de l'objet contenant la connexion à la BDD
        $this->_pdo = Database::db_connect();
        $this->_categories = $categories;
        $this->_title = $title;
        $this->_article = $article;
    }

    /**
     * Méthode qui permet de créer un article
     * 
     * @return boolean
     */
    public function createArticle()
    {

        try{
            $sql = 'INSERT INTO `article` (`categories`, `title`, `article`) 
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
    public static function getArticle($id)
    {
        
        $pdo = Database::db_connect();

        try{
            $sql = 'SELECT * FROM `article` 
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
    public function updateArticle($id)
    {

        try{
            $sql = 'UPDATE `article` SET `categories` = :categories, `title` = :title, `article` = :article
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
    public static function deleteArticle($id)
    {

        $pdo = Database::db_connect();

        try{
            $sql = 'DELETE FROM `article`
                    WHERE `id` = :id;';
            $sth = $pdo->prepare($sql);
            $sth->bindValue(':id',$id,PDO::PARAM_INT);
            $sth->execute();
            if($sth->rowCount()==0)
                return 23;
            else
                return 31;
        }
        catch(PDOException $e){
            return $e->getCode();
        }

    }

    // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //  Méthode qui permet de lister tous les article  
    public static function getAllArticle()
    {
        $sql = "SELECT * FROM `article`;";

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
    public static function searchAllArticle($search='', $limit=null, $offset=0)
    {
        
        try{
            if(!is_null($limit)){ // Si une limite est fixée, il faut tout lister
                $sql = 'SELECT * FROM `article` 
                WHERE `categories` LIKE :search 
                OR `title` LIKE :search 
                LIMIT :limit OFFSET :offset;';
            } else {
                $sql = 'SELECT * FROM `article` 
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
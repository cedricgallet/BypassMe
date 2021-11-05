<?php
session_start();
require_once(dirname(__FILE__).'/../../admin/models/Article.php');//Models
require_once(dirname(__FILE__).'/../../admin/config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

//On check si le mdp par défault(constante) est le meme que le mdp en cours
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// ********************************************************************************************************

// Initialisation du tableau d'erreurs
$errorsArray = array();

$arrayCategories = ['Faille web','Faille réseau','Faille humaine','Faille applicative'];//tabeau boucle front


$title1 = 'Modification d\'un article en cours ...';

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));



//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 
    
     //**************************categories******************************
    // On verifie l'existance et on nettoie
    $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //**************************Titre******************************
    // On verifie l'existance et on nettoie
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //**************************article******************************
    // On verifie l'existance et on nettoie
    $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    // Si il n'y a pas d'erreurs, on met à jour le commentaire.
    if(empty($errorsArray))
    {

        $articleInfo = new Article($categories, $title, $article);//On instancie/On récupére les infos 

        $result = $articleInfo->updateArticle($id);//On met a jour et on ajoute en bdd        

        if($result===true){//Si l ajout s'est bien passé = 1
            
            header('location: /../../admin/controllers/list-article-ctrl.php?msgCode=22');//On redirige av mess succés
            die;

        } else {
            // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
            $msgCode = $result;
        } 
    
    }

}else{
    $articleInfo = Article::getArticle($id);

    // Si l'article existe 
    if($articleInfo)
    {
        $id = $articleInfo->id;
        $categories = $articleInfo->categories;
        $title = $articleInfo->title;
        $article = $articleInfo->article;

    } else {//si n'existe pas, on redirige vers la liste complète avec un code erreur
        header('location: /../../admin/controllers/list-article-ctrl.php?msgCode=23');
        die;
    }
}


/* *************************** VUES **************************/
require_once dirname(__FILE__) . '/../../templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/edit-article.php';


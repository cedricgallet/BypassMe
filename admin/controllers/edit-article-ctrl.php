<?php
session_start();
require_once(dirname(__FILE__).'/../../config/regex.php');
require_once(dirname(__FILE__).'/../../models/Article.php');//Models

if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

// Initialisation du tableau d'erreurs
$errorsArray = array();
$title1 = 'Modification d\'un article en cours ...';
$show_modal = false;

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Nettoyage du status 
$state = intval(trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT)));

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 
    
     // ===========================categories=================
    if(!empty($categories)){
        // On verifie l'existance et on nettoie
        $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    }else {
        $errorsArray['categories'] = 'Le champ est obligatoire';
    }

    // ===========================Titre===========================

    if(!empty($title)){
        // On verifie l'existance et on nettoie
        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    }else {
        $errorsArray['title'] = 'Le champ est obligatoire';
    }

    // ===========================article=================
    if(!empty($article)){
        // On verifie l'existance et on nettoie
        $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    }else {
        $errorsArray['article'] = 'Le champ est obligatoire';
    }


    // Si il n'y a pas d'erreurs, on met à jour l'article.
    if(empty($errorsArray))
    {

        $updateArticle = new Article($categories, $title, $article, $state);//On instancie/On récupére les infos 

        $result = $updateArticle->updateArticle($id);//On met a jour et on ajoute en bdd        

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
    // Si l'utilisateur n'existe pas, on redirige vers la liste complète avec un code erreur
    if($articleInfo)
    {
        $id = $articleInfo->id;
        $categories = $articleInfo->categories;
        $title = $articleInfo->title;
        $article = $articleInfo->article;
        $state = $articleInfo->state;

    } else {
        header('location: /../../admin/controllers/list-article-ctrl.php?msgCode=3');
        die;
    }
}


/* ************* VUES **************************/
require_once dirname(__FILE__) . '/../../views/templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/edit-article.php';


<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../../models/Article.php');//models

if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

$title1 = 'Ajouter un article';
$arrayCategories = ['applicative','web','reseau','humaine'];//tabeau pour la boucle dans front


// ================================================================================
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 

    // On verifie l'existance et on nettoie
    $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING));
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
    $cleanArticle = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING));
    $article = nl2br($cleanArticle);

    //On test si le champ n'est pas vide
    if(!empty($_POST['categories']) && !empty($_POST['title']) && !empty($_POST['article']))
    {

        // var_dump($categories);
        // var_dump($title);
        // var_dump($article);die;

        $newArticle = new Article($categories, $title, $article);//On instancie/On récupére les infos  


            $result = $newArticle->create();//On ajoute en bdd
            var_dump( $result);die;

            if($result===true){//Si l ajout s'est bien passé = 1


                header('location: /../../admin/controllers/list-user-ctrl.php?msgCode=21');//On redirige av mess succés
                die;


            } else {
                // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
                $msgCode = $result;
            }

    }else {
        header('Location: /../../admin/controllers/add-article-ctrl.php?msgCode=18'); 
        die;
    }

}


// ++++++++++++++++Templates et vues+++++++++++++++++++++++++
require_once dirname(__FILE__).'/../../views/templates/header.php';
require_once dirname(__FILE__).'/../../admin/views/add-article.php';



<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../models/Article.php');//models

if (!isset($_SESSION['admin'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

$title = 'Ajouter un article';
$categories ='';$title = '';$article = ''; $arrayCategories = ['applicative','web','reseau','humaine'];//tabeau pour la boucle front


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!empty($title) && !empty($article) && !empty($article)) 
    {
        //  On vérifie si c'est le format attendu 
        $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING));
        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
        $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING));


        // On vérifie si l'article existe
        // ON invoque la méthode statique permettant de vérifier si l'article existe  si non ok (grâce a son id)
        $checkArticle = Article::getArticle($id);
    
    // var_dump($checkArticle);
    // die;


        if($checkArticle == 0) //Si l'article n'existe pas = false 0
        {
            if($categories) //Si le format est correct(= vrai)
            {
                if($title) //Si le format est correct(= vrai)
                {
                    if($article) //Si le format est correct(= vrai)
                    {


                        $article = new Article($categories, $title, $article);// On récupère les infos/On instancie
                        $article->createArticle();

                    // var_dump($article);
                    // die;
        


                    } else {
                        header('Location: /../views/form/addArticle?msgCode=29'); 
                        die;
                    }   
            
                } else {
                    header('Location: /../views/form/addArticle?msgCode=28'); 
                    die;
                }        
            
            } else {
                header('Location: /../views/form/addArticle?msgCode=27'); 
                die;
            } 

        } else {
            header('Location: /../views/form/addArticle?msgCode=23'); 
            die;
        } 

    } else {
        header('Location: /../views/form/addArticle?msgCode=18'); 
        die;
    } 

} 

// ++++++++++++++++Templates et vues+++++++++++++++++++++++++
require_once dirname(__FILE__).'/../views/templates/header.php';
require_once dirname(__FILE__).'/../admin/views/add-article.php';
require_once dirname(__FILE__).'/../views/templates/footer.php';


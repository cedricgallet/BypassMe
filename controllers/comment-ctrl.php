<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../models/Comment.php');//Models

// si la session n'existe pas ou si l'utilisateur n'est pas connecté on redirige
if(!isset($_SESSION['user'])){
    header('Location:/../views/user/sigIn.php?msgCode=30');
    die();
}

// Tableau des catégories disponibles //
$arrayCategories = ['autre','applicative','web','réseau','humaine',];
// Tableau des sujets disponible //
$arraySubject = ['avis sur un article','soummettre une idée','signaler un bug sur le site','signaler un lien mort'];


if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(!empty($categories) && !empty($subject) && !empty($comment))
    {
        //  On vérifie si c'est le format attendu 
        $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING));
        $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING));
        $comment = trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING));


        // On vérifie si l'utilisateur existe
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe  si non ok (grâce a son email)
        $checkcomment = Comment::getComment($id);

    // var_dump($checkcomment);
    // die;


        if ($checkComment == 0) // Si l'article n'existe pas
        {
            if($subject) // Si le format est correct(=vrai) 
            {
                if($categories)  // Si le format est correct(=vrai) 
                {
                    if($comment)  // Si le format est correct(=vrai)  
                    {
                
        
                        $user = new Comment($subject, $categories, $title);// On récupère les infos/On instancie
                        $user->createComment();

                        
                    // var_dump($user);
                    // die;
        
                    
                    }else {
                        header('Location: /../views/form/addArticle?msgCode=34'); 
                        die;
                    } 

                }else {
                    header('Location: /../views/form/addArticle?msgCode=33'); 
                    die;
                } 

            }else {
                header('Location: /../views/form/addArticle?msgCode=32'); 
                die;
            } 

        }else {
            header('Location: /../views/form/addArticle?msgCode=31'); 
            die;
        }

    }else {
        header('Location: /../views/form/addArticle?msgCode=18'); 
        die;
    } 

}  

// ++++++++++++++++++++Templates et vues++++++++++++++++++++++++++++
require_once(dirname(__FILE__).'/../views/templates/header.php');
require_once(dirname(__FILE__).'/../views/form/comment.php');
require_once(dirname(__FILE__).'/../views/templates/footer.php');


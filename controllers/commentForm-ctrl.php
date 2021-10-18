<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../models/Comment.php');//Models

// si la session n'existe pas ou si l'utilisateur n'est pas connecté on redirige
if(!isset($_SESSION['user'])){
    header('Location:/../views/user/sigIn.php?msgCode=30');
    die();
}

// Tableau des catégories disponibles //
$arrayCategories = ['autre','web','réseau','humaine','applicative'];

// Tableau des sujets disponible //
$arraySubject = ['commenter un article','soummettre une idée','signaler un bug sur le site','signaler un lien mort','supprimer mon compte'];

$title = 'Déposer un commentaire ?';

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 
    
     // ===========================Sujet=================
    // On verifie l'existance et on nettoie
    $subject = trim(filter_input(INPUT_POST, 'subject'));

    //On test si le champ n'est pas vide
    if(empty($subject)){
        $errorsArray['subject'] = 'Le champ est obligatoire';

    }
    // ===========================Categories===========================

    // On verifie l'existance et on nettoie
    $categories = trim(filter_input(INPUT_POST, 'categories'));

    //On test si le champ n'est pas vide
    if(empty($categories)){
        $errorsArray['categories'] = 'Le champ est obligatoire';

    }

    // ===========================Commentaire=================
    // On verifie l'existance et on nettoie
    $comment = trim(filter_input(INPUT_POST, 'comment'));

    //On test si le champ n'est pas vide
    if(empty($comment)){
        $errorsArray['comment'] = 'Le champ est obligatoire';

    }

    // Si aucune erreur, on enregistre en BDD
    if(empty($errorsArray))
    {
        $user = new Comment($subject, $categories, $comment, "");//On instancie/On récupére les infos  
        //var_dump($user);die;
        $result = $user->createComment();//On ajoute en bdd

        if($result===true){//Si l ajout s'est bien passé = 1

            if($_SESSION['user']->email == DEFAULT_EMAIL && $_SESSION['user']->password == DEFAULT_PASS) 
            {
                header('location: /../../admin/controllers/list-comment-ctrl.php?msgCode=11');//On redirige av mess succés
                die;
    
            }else {
                header('location: /../../controllers/commentForm-ctrl.php?msgCode=11');//On redirige av mess succés
                die;
            }
            
        } else {
            // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
            $msgCode = $result;
        } 
    }
    
}
                
// ++++++++++++++++++++Templates et vues++++++++++++++++++++++++
require_once(dirname(__FILE__).'/../views/templates/header.php');
require_once(dirname(__FILE__).'/../views/user/commentForm.php');
require_once(dirname(__FILE__).'/../views/templates/footer.php');


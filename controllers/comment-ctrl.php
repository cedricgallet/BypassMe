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


if($_SERVER["REQUEST_METHOD"] == "POST")// On controle le type(post) que si il y a des données d'envoyées  
{
    if(!empty($categories) && !empty($subject) && !empty($comment))
    {

        
    
            // pseudo
        // On verifie l'existance et on nettoie
        $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    
        //On test si le champ n'est pas vide
        if(!empty($pseudo)){
            // On test la valeur
            $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);
    
            if(!$testRegex){
                $errorsArray['pseudo'] = 'Merci de choisir un pseudo valide';
            }
        }else{
            $errorsArray['pseudo'] = 'Le champ est obligatoire';
        }
    
        // **********************Email******************************
        
        // On verifie l'existance et on nettoie
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $email2 = trim(filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL));
    
        //On test si le champ n'est pas vide
        if(!empty($email) && !empty($email2)){
            // On test la valeur
            $testMail = filter_var($email, FILTER_VALIDATE_EMAIL);
            $testMail2 = filter_var($email2, FILTER_VALIDATE_EMAIL);
    
            if(!$testMail){
                $errorsArray['email'] = 'Le mail n\'est pas valide';
            }
    
            if(!$testMail2){
                $errorsArray['email2'] = 'Le mail n\'est pas valide';
            }
    
        }else{
            $errorsArray['email'] = 'Le champ est obligatoire';
            $errorsArray['email2'] = 'Le champ est obligatoire';
        }
        // ***********************Password***************************
    
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
    
        //On test si le champ n'est pas vide
        if(!empty($password) && !empty($password2))
        {
    
            if($password!=$password2){
                $errorsArray['password'] = 'Les mots de passe sont différents';
                $errorsArray['password2'] = 'Les mots de passe sont différents';
            } else {
                $cost =['cost' => 12]; // On hash le mot de passe avec Bcrypt, via un coût de 12
                $password = password_hash($password, PASSWORD_DEFAULT,$cost);
            }
    
        }else{
            $errorsArray['password'] = 'Le champ est obligatoire';
            $errorsArray['password2'] = 'Le champ est obligatoire';
        }
    
        // Si aucune erreur, on enregistre en BDD
        if(empty($errorsArray))
        {
    
            $newComment = new Comment($subject, $categories, $comment, $state);//On instancie/On récupére les infos  
            $result = $newComment->createComment();//On ajoute en bdd

            if($result===true){//Si l ajout s'est bien passé = 1
                header('location: /../controllers/signIn-ctrl.php?msgCode=11');//On redirige av mess succés
                die;

            } else {
                // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
                $msgCode = $result;
            }

        
        }
        
    }
}
                
// ++++++++++++++++++++Templates et vues++++++++++++++++++++++++
require_once(dirname(__FILE__).'/../views/templates/header.php');
require_once(dirname(__FILE__).'/../views/form/comment.php');


<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../models/Contact.php');//Models

// ****************************SECURITE ACCES PAGE*************************** 
if(!isset($_SESSION['user']))
{
    header('Location:/../controllers/signUp-ctrl.php?msgCode=38');
    die();
}
// ***********************************************************************************

// Tableau des sujets disponible //
$arraySubject = ['soummettre une idée','signaler un bug sur le site','signaler un lien mort'];

$title = 'Déposer un message ?';

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 
    
    // ===========================Sujet du message=================

    // On verifie l'existance et on nettoie
    $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); // On nettoie

    //On test si le champ n'est pas vide
    if(empty($subject)){
        $errorsArray['subject'] = 'Le champ est obligatoire';

    }

    // ===========================Message=================
    // On verifie l'existance et on nettoie
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); // On nettoie

    //On test si le champ n'est pas vide
    if(empty($message)){
        $errorsArray['message'] = 'Le champ est obligatoire';

    }

    //++++++++++++++++Email+++++++++++++++++++++++
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)); // On nettoie

    if(!empty($email)) // On test si le champ n'est pas vide
    {
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL); // On test la valeur

        if(!$testEmail){    
            $errorsArray['email'] = 'L\'email n\'est pas valide';
        
        }

    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
    }

    // +++++++++++++++++++++Password++++++++++++++++++++++++++
    $password = trim(filter_input(INPUT_POST, 'password')); // On nettoie

    if(!empty($password)) // On test si le champ n'est pas vide
    {
        // Si aucune erreur, on enregistre en BDD
        if(empty($errorsArray))
        {
            $messageInfo = new Contact($email, $subject, $message);//On instancie/On récupére les infos  

            $result = $messageInfo->createMessage();//On ajoute en bdd

            if($result===true)
            {//Si l ajout s'est bien passé = 1

                //On check si l'email et le mdp par défault est le meme que le mdp en cours de session

                if($_SESSION['user']->email == DEFAULT_EMAIL && $_SESSION['user']->password == DEFAULT_PASS) {

                    header('location: /../../admin/controllers/list-message-ctrl.php?msgCode=40');//On redirige l'admin av mess succés
                    die;
        
                }else {
                    header('location: /../../controllers/landing-ctrl.php?msgCode=40');//On redirige l'utilisateur av mess succés
                    die;
                }
                
            } else {
                // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
                $msgCode = $result;
            } 
        }
    }
    
}
                
// ++++++++++++++++++++Templates et vues++++++++++++++++++++++++
require_once(dirname(__FILE__).'/../views/templates/header.php');
require_once(dirname(__FILE__).'/../views/user/message.php');
require_once(dirname(__FILE__).'/../views/templates/footer.php');


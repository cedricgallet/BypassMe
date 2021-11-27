<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../../admin/models/Message.php');//Models
require_once(dirname(__FILE__).'/../../admin/models/User.php');//Models

// *****************************************SECURITE ACCES PAGE******************************************
if(!isset($_SESSION['user'])){
    header('Location:/../views/user/sigIn.php?msgCode=38');
    die();
}

// ********************************************************************************************************

// Tableau des sujets des messages //
$arraySubject = ['soummettre une idée','signaler un bug sur le site','signaler un lien mort', 'supprimer mon compte'];

$title = 'Déposer un message ?';

$id = $_SESSION['user']->id;
$user = User :: getUser($id);
$id_user = $user->id;

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) 
{   

    // *********************Sujet du message**********************

    // On verifie l'existance et on nettoie
    $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //On test si le champ n'est pas vide
    if(empty($subject)){
        $errorsArray['subject'] = 'Le champ est obligatoire';
    }

    // ********************Message**********************

    // On verifie l'existance et on nettoie
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //On test si le champ n'est pas vide
    if(empty($message)){
        $errorsArray['message'] = 'Le champ est obligatoire';
    }

    // Si il n'y a pas d'erreurs, on enregistre tout en une fois grâce aux transactions
    if(empty($errorsArray))
    {
        //On instancie/On récupére les infos 
        $getNewMessage = new Message($subject, $message, '', '', '', $id_user);

        $createMessage = $getNewMessage->createMessage();

        if($createMessage)
        {
            header('location: /../../user/controllers/add-message-ctrl.php?msgCode=40');
            die;
        
        } else {

            // Si l'enregistrement s'est mal passé, on redirige av un mess d'erreur.
            header('location: /../../user/controllers/add-message-ctrl.php?msgCode=42');
            die;
        }  

    }
    
}
                   
// ++++++++++++++++++++Templates et vues++++++++++++++++++++++++
require_once(dirname(__FILE__).'/..//../templates/header.php');
require_once(dirname(__FILE__).'/../../user/views/add-message.php');
require_once(dirname(__FILE__).'/../../templates/footer.php');


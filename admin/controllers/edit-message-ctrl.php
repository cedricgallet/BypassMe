<?php
session_start();
require_once(dirname(__FILE__).'/../../admin/models/Message.php');//Models
require_once(dirname(__FILE__).'/../../admin/models/User.php');//Models
require_once(dirname(__FILE__).'/../../admin/config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);//On check si le mdp par défault est le meme que le mdp en cours

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// ********************************************************************************************************


// Initialisation du tableau d'erreurs
$errorsArray = array(); //ou $errorsArray = []; //déclaration d'un tableau vide

// Tableau des sujets disponible //
$arraySubject = ['Soummettre une idée','Signaler un bug sur le site','Signaler un lien mort','Supprimer mon compte'];

// Nettoyage de l'id du rdv passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Nettoyage de l'id_user(foreign key) passé en GET dans l'url
$id_user = intval(trim(filter_input(INPUT_GET, 'id_user', FILTER_SANITIZE_NUMBER_INT)));

// Appel à la méthode statique permettant de récupérer un message
$getMessageUser = Message::getMessage($id);


//**************************id-user(Foreign Key)******************************
// On verifie l'existance et on nettoie
// $id_user = intval(trim(filter_input(INPUT_GET, '$id_user', FILTER_SANITIZE_NUMBER_INT)));

// Récupération d'id_user
// $id_user = $getMessage->id_user;


//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{ 
    
    // ****************************Sujet du message***********************
    // On verifie l'existance et on nettoie
    $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

     //On test si le champ n'est pas vide
     if(empty($subject)){

        $errorsArray['subject'] = 'Le champ est obligatoire';
        
    }

    // ******************************Categories***************************
    // On verifie l'existance et on nettoie
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //On test si le champ n'est pas vide
    if(empty($message)){
        
        $errorsArray['message'] = 'Le champ est obligatoire';
        
    } 

    //**************************Status******************************
    // On verifie l'existance et on nettoie
    $state = intval(trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT)));

    $id_user = trim(filter_input(INPUT_POST, 'idPatients', FILTER_SANITIZE_NUMBER_INT));

    // Si il n'y a pas d'erreurs, on met à jour le message.
    if(empty($errorsArray))
    {
        $getNewMessage = new Message($subject, $message, $state,'','',$id_user);

        $result = $getNewMessage->updateMessage($id);
        if(!$result){
            header('location: /../../admin/controllers/display-message-ctrl.php?id='.$id.'&msgCode=39');
        } 
    }

}else {
    // Appel à la méthode statique permettant de récupérer les utilisateurs 
    $user = User::getUser($id_user);
    if ($user) {
        $pseudo = $user->pseudo;
        
    }
}

// +++++++++++++++++++++++++++++++++++VUES+++++++++++++++++++++++++++++++
require_once dirname(__FILE__) . '/../../templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/edit-message.php';


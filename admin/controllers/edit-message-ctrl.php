<?php
session_start();
require_once(dirname(__FILE__).'/../../models/Message.php');//Models
require_once(dirname(__FILE__).'/../../models/User.php');//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);//On check si le mdp par défault est le meme que le mdp en cours

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// ********************************************************************************************************


// Initialisation du tableau d'erreurs
$errorsArray = array(); //ou $errorsArray = []; //déclaration d'un tableau vide

// Tableau des sujets disponible //
$arraySubject = ['Soummettre une idée','Signaler un bug sur le site','Signaler un lien mort','Supprimer mon compte'];

// Nettoyage de l'id du rdv passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Appel à la méthode statique permettant de récupérer tous les utilisateurs
$getUser = User::get($id);

// Appel à la méthode statique permettant de récupérer un message
$getMessage = Message::getMessage($id);

//**************************id-user(Foreign Key)******************************
// On verifie l'existance et on nettoie
$id_user = intval(trim(filter_input(INPUT_GET, '$id_user', FILTER_SANITIZE_NUMBER_INT)));

// Récupération d'id_user
// $id_user = $getMessage->id_user;

//**************************Status******************************
// On verifie l'existance et on nettoie
$state = intval(trim(filter_input(INPUT_GET, 'state', FILTER_SANITIZE_NUMBER_INT)));

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 
    
    // ****************************Sujet du message***********************
    // On verifie l'existance et on nettoie
    $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    // ******************************Categories***************************
    // On verifie l'existance et on nettoie
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //**************************Status******************************
    // On verifie l'existance et on nettoie
    $state = intval(trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT)));

    
    //On test si le champ n'est pas vide
    if(empty($subject)){

        $errorsArray['subject'] = 'Le champ est obligatoire';
        
    }

    //On test si le champ n'est pas vide
    if(empty($message)){
        
        $errorsArray['message'] = 'Le champ est obligatoire';
        
    } 

    // Si il n'y a pas d'erreurs, on met à jour le message.
    if(empty($errorsArray))
    {
        $getNewMessage = new Message($subject, $message, $state,'','',$id_user);

        if($getNewMessage->updateMessage($id)===true){//Si la MAJ s'est bien passé ( = vrai)
            header('location: /../../admin/controllers/list-message-ctrl.php?id='.$id.'&msgCode=41');
        } else {
            $msgCode=43;
        }    
    
    }

}

// +++++++++++++++++++++++++++++++++++VUES+++++++++++++++++++++++++++++++
require_once dirname(__FILE__) . '/../../views/templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/edit-message.php';


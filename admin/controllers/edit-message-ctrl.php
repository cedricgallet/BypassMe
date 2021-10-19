<?php
session_start();
require_once(dirname(__FILE__).'/../../models/Contact.php');//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

// *****************************************SECURISER ACCES PAGE******************************************
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

$title = 'Modification d\'un message en cours ...';

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// status 
$state = $_SESSION['user']->state;

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 
    
    // ****************************Sujet du message***********************

    // On verifie l'existance et on nettoie
    $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    // ******************************Categories***************************

    // On verifie l'existance et on nettoie
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    // ******************************article***************************

    // On verifie l'existance et on nettoie
    $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 


    // Si il n'y a pas d'erreurs, on met à jour le message.
    if(empty($errorsArray))
    {

        $messageInfo = new Contact($subject, $categories, $message, $state);//On instancie/On récupére les infos 

        $result = $messageInfo->updateMessage($id);//On met a jour et on ajoute en bdd        

        if($result===true){//Si l ajout s'est bien passé = 1
            
            header('location: /../../admin/controllers/list-message-ctrl.php?msgCode=41');//On redirige av mess succés
            die;

        } else {
            // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
            $msgCode = $result;
        } 
    
    }

}else{
    $messageInfo = Contact::getMessage($id);
    var_dump($messageInfo);die;
    if($messageInfo)
    {
        $id = $messageInfo->id;
        $subject = $messageInfo->subject;
        $message = $messageInfo->message;
        $state = $messageInfo->state;

    } else {
        // Si le message n'existe pas, on redirige vers la liste complète avec un code erreur
        header('location: /../../admin/controllers/list-message-ctrl.php?msgCode=39');
        die;
    }
}

// +++++++++++++++++++++++++++++++++++VUES+++++++++++++++++++++++++++++++
require_once dirname(__FILE__) . '/../../views/templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/edit-message.php';


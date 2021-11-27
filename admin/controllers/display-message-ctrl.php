<?php
session_start();
require_once dirname(__FILE__) . '/../../admin/models/Message.php';//Models
require_once dirname(__FILE__) . '/../../admin/models/User.php';//Models
require_once(dirname(__FILE__).'/../../admin/config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

//On check si le mdp par défault est le meme que le mdp en cours
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;       
}
// ********************************************************************************************************

$title = 'Consultation d\'un message en cours ...';

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Appel à la méthode statique permettant de récupérer toutes les message d'un utilisateur
$getMessageUser = Message::getMessage($id);

// Si le message n'existe pas, on redirige vers la liste complète avec un code erreur
// Si le rdv n'est pas un objet, on redirige vers la liste complète avec le code erreur retourné par la méthode Appointment::get($id)
if(!is_object($getMessageUser)){
    header('location: /../../controllers/list-message-ctrl.php?msgCode='.$getMessageUser);
} else {
    $user = User::getUser($getMessageUser->id_user);
}
/*************************************************************/

/* ************* AFFICHAGE DES VUES **************************/
require_once dirname(__FILE__) . '/../../templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/display-message.php';


<?php
session_start();
require_once dirname(__FILE__) . '/../../models/Message.php';//Models
require_once dirname(__FILE__) . '/../../models/User.php';//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

//On check si le mdp par défault est le meme que le mdp en cours
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;       
}
// ********************************************************************************************************

$title = 'Consultation d\'un message en cours ...';

// On verifie l'existance et on nettoie
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Appel à la méthode statique permettant de récupérer tous les infos d'un seul message
$messageInfo = Message::getMessage($id);

// Appel à la méthode statique permettant de récupérer tous les infos d'un seul utilisateur par l'id récuperer dans $message
$user = User::get($messageInfo->id);

/* ************* AFFICHAGE DES VUES **************************/
require_once dirname(__FILE__) . '/../../views/templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/display-message.php';


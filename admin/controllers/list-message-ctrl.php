<?php
session_start();
require_once dirname(__FILE__) . '/../../admin/models/Message.php';//Models
require_once dirname(__FILE__) . '/../../admin/models/User.php';//Models
require_once(dirname(__FILE__).'/../../admin/config/config.php');//Constante + gestion erreur

$title1 = 'Gestion Messages';
$title5 = 'Commentaires';
$title2 = 'Articles';
$title3 = 'Membres';
$title4 = 'Messages';


// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

//On check si le mdp par défault est le meme que le mdp en bdd
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;        
}
// ******************************************************************************************************

// On récupère tous les messages
$getAllMessage = Message::getAllMess();

//* **************************VUES ********************************/
require_once dirname(__FILE__) .'/../../templates/header.php';
require_once dirname(__FILE__) .'/../../admin/views/list-message.php';


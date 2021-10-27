<?php
session_start();
require_once dirname(__FILE__) . '/../../models/Contact.php';//Models
require_once dirname(__FILE__) . '/../../models/User.php';//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

$title1 = 'Gestion Messages';
$title5 = 'Commentaires';
$title2 = 'Articles';
$title3 = 'Membres';
$title4 = 'Messages';


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

// On récupère tous les messages
$getAllMessage = Contact::getAll();
var_dump($getAllMessage);die;
//* **************************VUES ********************************/
require_once dirname(__FILE__) .'/../../views/templates/header.php';
require_once dirname(__FILE__) .'/../../admin/views/list-message.php';


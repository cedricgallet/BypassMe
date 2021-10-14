<?php
session_start();// Démarrage de la session
require_once(dirname(__FILE__) . '/../../models/User.php');//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

if (!isset($_SESSION['user'])) 
{
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

if($_SESSION['user']->email == DEFAULT_EMAIL && $_SESSION['user']->password == DEFAULT_PASSWORD) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

// Nettoyage de l'id de l'utilisateur passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Suppression de l'utilisateur. 
$code = intval(User::delete($id));

// On redirige vers la page du profil de l'utilisateur avec un code pour le message
header('location: /../../admin/controllers/list-user-ctrl.php?msgCode='.$code);
die;


<?php
session_start(); // Démarrage de la session
require_once dirname(__FILE__) .'/../models/User.php';//Models
require_once dirname(__FILE__) .'/../config/config.php';//Constante + Gestion erreur

// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../controllers/sigIn.php?msgCode=38');
    die();
}

$title = 'Bienvenue sur ton espace personnel';

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//On récupère les infos
$user = User::get($id);

// +++++++++++++++++++++++VUES+++++++++++++++++++++++++++++++++
require_once dirname(__FILE__) .'/../views/templates/header.php';
require_once dirname(__FILE__) .'/../views/user/landing.php';

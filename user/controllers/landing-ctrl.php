<?php
session_start(); // Démarrage de la session
require_once dirname(__FILE__) .'/../../admin/models/User.php';//Models
require_once dirname(__FILE__) .'/../../admin/config/config.php';//Constante + Gestion erreur

// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../../controllers/sigIn.php?msgCode=38');
    die();
}

$title = 'Bienvenue sur ton espace personnel';

// On récupere et on stock l'id pour utiliser dans la fonction
$id = $_SESSION['user']->id;

//On récupère les infos
$user = User::getUser($id);

// +++++++++++++++++++++++VUES+++++++++++++++++++++++++++++++++
require_once dirname(__FILE__) .'/../../templates/header.php';
require_once dirname(__FILE__) .'/../../user/views/landing.php';

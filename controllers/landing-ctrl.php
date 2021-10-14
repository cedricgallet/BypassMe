<?php
session_start(); // Démarrage de la session
require_once dirname(__FILE__) .'/../config/config.php';//Constante + Gestion erreur

// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../controllers/sigIn.php?msgCode=30');
    die();
}

$title = 'Bienvenue sur ton espace personnel';

require_once dirname(__FILE__) .'/../views/templates/header.php';
require_once dirname(__FILE__) .'/../views/user/landing.php';

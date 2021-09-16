<?php
session_start(); // Démarrage de la session

// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../views/form/login.php');
    die();
}

$title = 'Bienvenue sur ton espace personnel';

// Si la session n'existe pas 

require_once(dirname(__FILE__) .'/../views/templates/header.php');
require_once(dirname(__FILE__) .'/../views/templates/navbar.php');
require_once(dirname(__FILE__) .'/../views/landing.php');
require_once(dirname(__FILE__) .'/../views/templates/footer.php');

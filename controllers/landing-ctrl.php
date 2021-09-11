<?php
session_start(); // Démarrage de la session  
include(dirname(__FILE__) .'/../utils/db.php'); // Connexion bdd

$title = 'Bienvenue sur ton espace personnel';

// Si la session n'existe pas 
if(!isset($_SESSION['user']['id']))
{
    header('Location:/../views/form/login.php');
    die();
}

include(dirname(__FILE__) .'/../views/templates/navbar.php');
include(dirname(__FILE__) .'/../views/landing.php');
include(dirname(__FILE__) .'/../views/templates/footer.php');

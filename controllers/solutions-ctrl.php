<?php
session_start(); // Démarrage de la session  
include(dirname(__FILE__).'/../utils/db.php'); // Connexion bdd

// si la session n'existe pas ou si l'utilisateur n'est pas connecté on redirige
// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../views/form/login.php');
    die();
}

include(dirname(__FILE__).'/../views/templates/navbar.php');
include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/solutions.php');
include(dirname(__FILE__).'/../views/templates/footer.php');

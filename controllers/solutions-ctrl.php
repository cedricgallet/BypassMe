<?php
session_start(); // Démarrage de la session  

if(!isset($_SESSION['user']))// si la session n'existe pas ou si l'utilisateur n'est pas connecté on redirige
{
    header('Location:/../views/form/login.php');
    die();
}

// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/templates/navbar.php');
include(dirname(__FILE__).'/../views/form/solutions.php');
include(dirname(__FILE__).'/../views/templates/footer.php');

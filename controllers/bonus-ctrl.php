<?php
session_start(); // Démarrage de la session  

// si la session n'existe pas ou si l'utilisateur n'est pas connecté on redirige
if(!isset($_SESSION['user'])){
    header('Location:/../index.php');
    die();
}

// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
include(dirname(__FILE__).'/../views/templates/header.php');
include(dirname(__FILE__).'/../views/templates/navbar.php');
include(dirname(__FILE__).'/../views/form/bonus.php');
include(dirname(__FILE__).'/../views/templates/footer.php');



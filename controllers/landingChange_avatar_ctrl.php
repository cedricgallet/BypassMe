<?php   
    // Démarrage de la session 
    session_start();

    // Include de la base de données
    include(dirname(__FILE__). '/../utils/config.php');

    // Si la session n'existe pas 
    if(!isset($_SESSION['user']))
    {
        header('Location:/../index.php');
        die();
    }

    $error = [];






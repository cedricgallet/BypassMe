<?php
session_start(); // Démarrage de la session        
require_once __DIR__ .'/../utils/db.php'; // On inclut la connexion à la base de données
require_once __DIR__.'/../utils/regex.php';
require_once __DIR__.'/../models/User.php';//models
require_once __DIR__.'/../views/templates/navbar.php';


// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../views/form/login.php');
    die();
}


require_once __DIR__ .'/../views/templates/navbar.php';
require_once __DIR__ .'/../views/form/landingAddAvatar.php';
require_once __DIR__ .'/../views/templates/footer.php';

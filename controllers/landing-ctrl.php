<?php
if (empty(session_id())) 
{
    session_start(); // Démarrage de la session 
}        

$title = 'Tableau de bord';

// Si la session n'existe pas 
if(!isset($_SESSION['user']['id']))
{
    header('Location:/../views/form/login.php');
    die();
}

require_once __DIR__ .'/../views/templates/navbar.php';
require_once __DIR__ .'/../views/landing.php';
require_once __DIR__ .'/../views/templates/footer.php';

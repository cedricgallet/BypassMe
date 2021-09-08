<?php
if (empty(session_id())) session_start(); // Démarrage de la session 
require_once __DIR__.'/../utils/db.php'; // Connexion bdd

// si la session n'existe pas ou si l'utilisateur n'est pas connecté on redirige
if(!isset($_SESSION['user'])){
    header('Location:/index.php');
    die();
}

require_once __DIR__.'/../views/templates/navbar.php';
require_once __DIR__.'/../views/templates/header.php';
require_once __DIR__.'/../views/solutions.php';
require_once __DIR__.'/../views/templates/footer.php';

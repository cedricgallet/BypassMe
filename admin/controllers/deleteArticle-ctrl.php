<?php
session_start(); // Démarrage de la session  
require_once dirname(__FILE__).'/../models/Article.php';

if (!isset($_SESSION['admin'])) 
{
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}


// Nettoyage de l'id de l'utilisateur passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
/*********************************************************/

// Suppression de l'utilisateur, et de tous ses rendez-vous. Une contrainte ON DELETE CASCADE, permet de supprimer tous les
// enregistrements d'appointment également.  
$code = intval(Comment::delete($id));

// On redirige vers la page du profil de l'utilisateur avec un code pour le message
header('location: /controllers/list-comment-ctrl.php?msgCode='.$code);
die;
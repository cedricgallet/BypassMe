<?php
session_start();
require_once dirname(__FILE__) . '/../../models/Comment.php';//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

// *****************************************SECURISER ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);//On check si le mdp par défault est le meme que le mdp en cours

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// ********************************************************************************************************


$title = 'Consultation d\'un commentaire en cours ...';


// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Appel à la méthode statique permettant de récupérer tous les infos d'un seul commentaire
$commentInfo = Comment::getComment($id);

// Si le commentaire n'existe pas, on redirige vers la liste complète avec un code erreur
if(!$commentInfo){
    header('location: /../admin/controllers/list-comment-ctrl.php?msgCode=8');
}

/* ************* AFFICHAGE DES VUES **************************/

require_once dirname(__FILE__) . '/../../views/templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/display-comment.php';


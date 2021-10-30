<?php
session_start();
require_once dirname(__FILE__) . '/../../models/User.php';//Models
// require_once dirname(__FILE__) . '/../../models/Comment.php';//Models
// require_once dirname(__FILE__) . '/../../models/Article.php';//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

//On check si le mdp par défault est le meme que le mdp en cours
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// ********************************************************************************************************

$title = 'Consultation d\'un profil utilisateur en cours ...';


// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Appel à la méthode statique permettant de récupérer tous les infos d'un seul utilisateur
$user = User::get($id);


// Si l'utilisateur n'existe pas, on redirige vers la liste complète avec un code erreur
if(!$user){
    header('location: /../admin/controllers/list-user-ctrl.php?msgCode=3');
}

/* ********************* AFFICHAGE DES VUES *********************/

require dirname(__FILE__) . '/../../views/templates/header.php';
require dirname(__FILE__) . '/../../admin/views/display-user.php';
// require dirname(__FILE__) . '/../../admin/views/display-comment.php';
// require dirname(__FILE__) . '/../../admin/views/display-article.php';


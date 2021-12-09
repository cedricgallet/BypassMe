<?php
session_start();
require_once(dirname(__FILE__).'/../../admin/models/Comment.php');//Models
require_once(dirname(__FILE__).'/../../admin/config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}
//On check si le mdp par défault est le meme que le mdp en cours
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// ********************************************************************************************************

// Initialisation du tableau d'erreurs
$errorsArray = array();

$arrayCategories = ['Faille web','Faille réseau','Faille humaine','Faille applicative'];//tabeau pour la boucle dans front


$title1 = 'Modification d\'un commentaire en cours ...';

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));



//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 
    
     //**************************categories******************************
    // On verifie l'existance et on nettoie
    $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //**************************article******************************
    // On verifie l'existance et on nettoie
    $comment = trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //**************************Status******************************
    // On verifie l'existance et on nettoie
    $state = intval(trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT)));


    // Si il n'y a pas d'erreurs, on met à jour le commentaire.
    if(empty($errorsArray))
    {

        $commentInfo = new Comment($categories, $comment, $state, "","","");//On instancie/On récupére les infos 

        $result = $commentInfo->updateComment($id);//On met a jour et on ajoute en bdd        

        if($result===true){//Si l ajout s'est bien passé = 1
            
            header('location: /../../admin/controllers/list-comment-ctrl.php?msgCode=6');//On redirige av mess succés
            die;

        } else {
            // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
            $msgCode = $result;
        } 
    
    }

}else{
    $commentInfo = Comment::getComment($id);

    // Si l'comment n'existe pas, on redirige vers la liste complète avec un code erreur
    if($commentInfo)
    {
        $id = $commentInfo->id;
        $categories = $commentInfo->categories;
        $comment = $commentInfo->comment;
        $state = $commentInfo->state;

    } else {
        header('location: /../../admin/controllers/list-comment-ctrl.php?msgCode=8');
        die;
    }
}


/* ************* VUES **************************/
require_once dirname(__FILE__) . '/../../templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/edit-comment.php';


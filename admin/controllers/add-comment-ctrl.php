<!-- *************************************Formulaire ajout commentaire*************************************** -->
<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../../models/Comment.php');//models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

//On check si le mdp par défault est le meme que le mdp en cours de session
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// ********************************************************************************************************

// Initialisation du tableau d'erreurs
$errorsArray = array();

//tabeau (boucle front) choix catégories
$arrayCategories = ['web','réseau','humaine','applicative'];

$title1 = 'Ajouter un commentaire';



// ********************************************************************************************************
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 

    //**************************Categories*************************

    // On verifie l'existance et on nettoie
    $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //**************************Commentaire************************

    // On verifie l'existance et on nettoie
    $comment = trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //**************************Status******************************

    // On verifie l'existance et on nettoie
    $state = intval(trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT)));


    //On test si le champ n'est pas vide
    if(empty($categories)){

        $errorsArray['categories'] = 'Le champ est obligatoire';
        
    }

    //On test si le champ n'est pas vide
    if(empty($comment)){
        
        $errorsArray['comment'] = 'Le champ est obligatoire';
        
    }

    if(empty($errorsArray))
    {
        //On instancie/On récupére les infos 
        $newComment = new Comment($categories, $comment, $state); 

        $result = $newComment->createComment();//On ajoute en bdd
        if($result===true){//Si l ajout s'est bien passé = 1


            header('location: /../../admin/controllers/list-comment-ctrl.php?msgCode=11');//On redirige av mess succés
            die;


        } else {
            // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
            $msgCode = $result;
        }

    }

}

// ********************************Vues****************************
require_once dirname(__FILE__).'/../../views/templates/header.php';
require_once dirname(__FILE__).'/../../admin/views/add-comment.php';



<!-- ***************************************Formulaire ajout article********************************************* -->
<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../../models/Article.php');//models
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

$title1 = 'Ajouter un article';

//tabeau boucle (choix catégories) front
$arrayCategories = ['web','réseau','humaine','applicative'];


// *******************************************************************************************************
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 


    //**************************categories************************

    // On verifie l'existance et on nettoie
    $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //**************************Titre******************************

    // On verifie l'existance et on nettoie
    $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //**************************article****************************

    // On verifie l'existance et on nettoie
    $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); 

    //**************************Status******************************

    // On verifie l'existance et on nettoie
    $state = intval(trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT)));

    // *********************Catégories************************
    //On test si le champ n'est pas vide
    if(empty($categories)){

        $errorsArray['categories'] = 'Le champ est obligatoire';
        
    }

    // ***************************Titre************************
    //On test si le champ n'est pas vide
    if(empty($title)){
        
        $errorsArray['title'] = 'Le champ est obligatoire';
        
    }

    // ***************************Article**********************
    //On test si le champ n'est pas vide
    if(empty($article)){
        
        $errorsArray['article'] = 'Le champ est obligatoire';
    
    }

    if(empty($errorsArray))
    {

        $newArticle = new Article($categories, $title, $article);//On instancie/On récupére les infos  

        $result = $newArticle->createArticle();//On ajoute en bdd
        if($result===true){//Si l ajout s'est bien passé = 1


            header('location: /../../admin/controllers/list-article-ctrl.php?msgCode=21');//On redirige av mess succés
            die;


        } else {
            // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
            $msgCode = $result;
        }

    }

}




// ++++++++++++++++Templates et vues+++++++++++++++++++++++++
require_once dirname(__FILE__).'/../../views/templates/header.php';
require_once dirname(__FILE__).'/../../admin/views/add-article.php';



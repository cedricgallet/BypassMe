<?php
session_start();
require_once(dirname(__FILE__).'/../../config/regex.php');
require_once(dirname(__FILE__).'/../../models/User.php');//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

if($_SESSION['user']->email == DEFAULT_EMAIL && $_SESSION['user']->password == DEFAULT_PASSWORD) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

// Initialisation du tableau d'erreurs
$errorsArray = array();
$title = 'Modification d\'un utilisateur en cours ...';
$show_modal = false;

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

// Nettoyage du status 
$state = intval(trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT)));

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 
    
     // pseudo
    // On verifie l'existance et on nettoie
    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($pseudo)){
        // On test la valeur
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);

        if(!$testRegex){
            $errorsArray['pseudo'] = 'Merci de choisir un pseudo valide';
        }
    }else{
        $errorsArray['pseudo'] = 'Le champ est obligatoire';
    }

    // **********************Email******************************

    // On verifie l'existance et on nettoie
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    //On test si le champ n'est pas vide
    if(!empty($email)) 
    {
        // On test la valeur
        $testMail = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$testMail){
            $errorsArray['email'] = 'Le mail n\'est pas valide';
        }

    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
    }
    // **********************************************


    // Si il n'y a pas d'erreurs, on met à jour le patient.
    if(empty($errorsArray))
    {

        $user = new User($pseudo, $email, "", "",$state);//On instancie/On récupére les infos 

        $result = $user->update($id);//On ajoute en bdd        

        if($result===true){//Si l ajout s'est bien passé = 1
            
            header('location: /../../admin/controllers/list-user-ctrl.php?msgCode=2');//On redirige av mess succés

        } else {
            // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
            $msgCode = $result;
        }
        
    
    }

}else{
    $user = User::get($id);
    // Si l'utilisateur n'existe pas, on redirige vers la liste complète avec un code erreur
    if($user){
        $id = $user->id;
        $pseudo = $user->pseudo;
        $email =$user->email;
        $state =$user->state;
    } else {
        header('location: /../../admin/controllers/list-user-ctrl.php?msgCode=3');
        die;
    }
}


/* ************* VUES **************************/
require_once dirname(__FILE__) . '/../../views/templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/edit-user.php';


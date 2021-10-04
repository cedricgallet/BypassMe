<?php
session_start();
require_once(dirname(__FILE__).'/../../config/regex.php');
require_once(dirname(__FILE__).'/../../models/User.php');//Models

if (!isset($_SESSION['admin'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

// Initialisation du tableau d'erreurs
$errorsArray = array();
$title = 'Modification d\'un utilisateur en cours ...';

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    // Pseudo
    // On verifie l'existance et on nettoie
    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($pseudo)){
        // On test la valeur
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);

        if($testRegex == false){
            $errorsArray['pseudo'] = 'Merci de choisir un nom valide';
        }
    }else{
        $errorsArray['pseudo'] = 'Le champ est obligatoire';
    }

    // ***************************************************************
    
    // EMAIL
    // On verifie l'existance et on nettoie
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    //On test si le champ n'est pas vide
    if(!empty($email)){
        // On test la valeur
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$testEmail){
            $errorsArray['email'] = 'L\'email n\'est pas valide';
        }
    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
    }

    // ***************************************************************

    // Si il n'y a pas d'erreurs, on met à jour l'utilisateur.
    if(empty($errorsArray))
    {    
        // Nettoyage de l'id passé en GET dans l'url
        $id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

        $user = new user($pseudo, $email,"","");//On instancie/On récupère les infos
        //var_dump($user);die;

        $result = $user->update($id);//On met a jour
        if($result===true){//si la MAJ c bien passé
            header('location: /../../admin/controllers/list-user-ctrl.php?msgCode=2');
            die;

        } else {
            // Si l'enregistrement s'est mal passé, on affiche à nouveau le formulaire de création avec un message d'erreur.
            $msgCode=$result;
        }
    }

} else {
    $user= User::get($id);
    // Si l'utilisateur n'existe pas, on redirige vers la liste complète avec un code erreur
    if($user){
        $id = $user->id;
        $pseudo = $user->pseudo;
        $email = $user->email;
    } else {
        header('location: /../../admin/controllers/list-user-ctrl.php?msgCode=3');
    }
}

/* ************* VUES **************************/
require_once dirname(__FILE__) . '/../../views/templates/header.php';
require_once dirname(__FILE__) . '/../../admin/views/edit-user.php';


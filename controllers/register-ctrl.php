<?php
require_once(dirname(__FILE__).'/../models/User.php');//models
require_once(dirname(__FILE__) .'/../utils/regex.php');
require_once(dirname(__FILE__) .'/../utils/regex.php');
require_once(dirname(__FILE__) . '/../utils/smgCode.php');


$user=null;$pseudo = '';$email = '';$password = '';$email2 = '';$password2 = '';$ip = '';$title = 'Inscription';
    
$errorsArray = array();// Initialisation du tableau d'erreurs


if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 

    // ++++++++++++++++++++++++++Pseudo+++++++++++++++++++++++++++++++++++
    // On verifie l'existance et on nettoie
    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($pseudo))
    {
        // On test la valeur
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);

        if(!$testRegex){
            $errorsArray['pseudo'] = 'Merci de choisir un nom valide';
        }
    }else{
        $errorsArray['pseudo'] = 'Le champ est obligatoire';
    }


    // **********************Email******************************

    // On verifie l'existance et on nettoie
    $cleanEmail = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $cleanEmail2 = trim(filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL));
    $email = strtolower($cleanEmail); // on transforme toute les lettres majuscule en minuscule
    $email2 = strtolower($cleanEmail2); // on transforme toute les lettres majuscule en minuscule

    //On test si le champ n'est pas vide
    if(!empty($email) && !empty($email2))
    {
        // On test la valeur
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $testEmail = filter_var($email2, FILTER_VALIDATE_EMAIL);

        if($email == $email2)
        {
            if(!$testEmail){
                $errorsArray['email'] = 'L\'email n\'est pas valide';
            }

        }else{
            $errorsArray['email'] = 'Les emails sont différents';
            $errorsArray['email2'] = 'Les emails sont différents';
        }
    
    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
        $errorsArray['email2'] = 'Le champ est obligatoire';
    }

    // ***********************Password***************************

    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if(!empty($email) && !empty($email2))
    {
        if($password!=$password2)
        {
            $errorsArray['password'] = 'Les mots de passe sont différents';
        } else {
            $cost =['cost' => 12]; // On hash le mot de passe avec Bcrypt, via un coût de 12
            $password = password_hash($password, PASSWORD_DEFAULT,$cost);
        }
        
    }else {
        $errorsArray['password'] = 'Le champ est obligatoire';
        $errorsArray['password2'] = 'Le champ est obligatoire';
    }

    // ***********************Password***************************
    if(empty($errorsArray)) // Si aucune erreur 
    {
        $ip = $_SERVER['REMOTE_ADDR'];// On stock l'adresse IP 

        $user = new User($pseudo, $email, $password, $ip); // On instancie et on récupère les infos

        if ($user) //si le compte n'existe pas, on enregistre en BDD // $user = 0 false ok
        {
            $user->createUser();
            header('location:/../controllers/login-ctrl.php');
            die;

        }else {
            header('location:/../index/.php');//A MODIFIER
        }
    }

}

/* ************* AFFICHAGE DES VUES **************************/
require_once(dirname(__FILE__) . '/../views/templates/header.php');
require_once(dirname(__FILE__) . '/../views/form/register.php');
require_once(dirname(__FILE__) . '/../views/templates/footer.php');


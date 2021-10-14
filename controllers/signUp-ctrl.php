<?php
session_start();
require_once(dirname(__FILE__).'/../config/regex.php');
require_once(dirname(__FILE__).'/../models/User.php');//Models

// Initialisation du tableau d'erreurs
$errorsArray = array();
$title = 'Inscription';
// ================================================================================
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
    $email2 = trim(filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL));

    //On test si le champ n'est pas vide
    if(!empty($email) && !empty($email2)){
        // On test la valeur
        $testMail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $testMail2 = filter_var($email2, FILTER_VALIDATE_EMAIL);

        if(!$testMail){
            $errorsArray['email'] = 'Le mail n\'est pas valide';
        }

        if(!$testMail2){
            $errorsArray['email2'] = 'Le mail n\'est pas valide';
        }

    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
        $errorsArray['email2'] = 'Le champ est obligatoire';
    }
    // ***********************Password***************************

    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    //On test si le champ n'est pas vide
    if(!empty($password) && !empty($password2))
    {

        if($password!=$password2){
            $errorsArray['password'] = 'Les mots de passe sont différents';
            $errorsArray['password2'] = 'Les mots de passe sont différents';
        } else {
            $cost =['cost' => 12]; // On hash le mot de passe avec Bcrypt, via un coût de 12
            $password = password_hash($password, PASSWORD_DEFAULT,$cost);
        }

    }else{
        $errorsArray['password'] = 'Le champ est obligatoire';
        $errorsArray['password2'] = 'Le champ est obligatoire';
    }

    // Si aucune erreur, on enregistre en BDD
    if(empty($errorsArray))
    {
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe si non ok (grâce a son email)
        $checkUser = User::getByEmail($email);

        $ip = $_SERVER['REMOTE_ADDR'];// On stock l'adresse IP 

        $user = new User($pseudo, $email, $password, $ip);//On instancie/On récupére les infos  

        if(!$checkUser)//Si l'utilisateur n'existe pas
        {
            $result = $user->createUser();//On ajoute en bdd

            if($result===true){//Si l ajout s'est bien passé = 1

                $_SESSION['user'] = $user;

                if($_SESSION['user']->email == DEFAULT_EMAIL && $_SESSION['user']->password == DEFAULT_PASSWORD) 
                {
                    header('location: /../admin/controllers/list-user-ctrl.php?msgCode=12');//On redirige av mess succés
                    die;
            
                }else {
                    header('location: /../controllers/signIn-ctrl.php?msgCode=12');//On redirige av mess succés
                    die;
                }

            } else {
                // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
                $msgCode = $result;
            }

        }else {
            header('location: /../controllers/signUp-ctrl.php?msgCode=13');//Si l'utilisateur existe on redirige av mess erreur
            die;
        }
    }
}

// **********************VUES******************************
require_once(dirname(__FILE__).'/../views/templates/header.php');
require_once(dirname(__FILE__).'/../views/user/signUp.php');
require_once(dirname(__FILE__).'/../views/templates/footer.php');

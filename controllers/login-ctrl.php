<?php
session_start();
require_once dirname(__FILE__).'/../models/User.php';

$email = '';$password = ''; $title = 'Connexion';

if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 

    // On test la valeur
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    //++++++++++++++++Email+++++++++++++++++++++++
    if(!empty($email)) // On test si le champ n'est pas vide
    {

        // On test la valeur
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$testEmail)
        {    
            $errorsArray['email'] = 'L\'email n\'est pas valide';
        }

    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
    }

    // +++++++++++++++++++++Password++++++++++++++++++++++++++
    $passwordPost = isset($_POST['password']) ? $_POST['password'] : '';

    $user = User::getByEmail($email);

    if($user)//Si l'utilisateur existe $user = 1 (true)
    {
        $isPasswordOk = password_verify($passwordPost, $user->password); //On verifie si le mdp est le bon
        if($isPasswordOk)
        {
            $_SESSION['user'] = $user; //On connecte le user
            header('location: /../controllers/landing-ctrl.php');
        }
    }
}

// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
require_once dirname(__FILE__).'/../views/templates/header.php';
require_once(dirname(__FILE__) . '/../views/templates/navbar.php');
require_once dirname(__FILE__).'/../views/form/login.php';
require_once dirname(__FILE__).'/../views/templates/footer.php';
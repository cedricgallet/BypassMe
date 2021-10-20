<?php
session_start();
require_once dirname(__FILE__).'/../models/User.php';
require_once dirname(__FILE__).'/../config/config.php';

$errorsArray = array();
$title = 'Connexion';


if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 

     //++++++++++++++++Email+++++++++++++++++++++++
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)); // On nettoie

    if(!empty($email)) // On test si le champ n'est pas vide
    {
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL); // On test la valeur

        if(!$testEmail)
        {    
            $errorsArray['email'] = 'L\'email n\'est pas valide';
        }

    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
    }

    // +++++++++++++++++++++Password++++++++++++++++++++++++++
    $password =  $_POST['password'];
    
    if(!empty($password)) // On test si le champ n'est pas vide
    {
            // Si aucune erreur, on enregistre en BDD
        if(empty($errorsArray))
        {
            $user = User::getByEmail($email);//On check si user exite
            
            if($user)//Si vrai = true 1
            {
                $isPasswordOk = password_verify($password, $user->password);
                if($isPasswordOk)//Si mdp est le meme que celui en bdd
                {
                    $_SESSION['user'] = $user;//On crée la session
                    // +++++++++++++++++++++++Connection administration+++++++++++++++++++++++

                    $passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);//On check si le mdp par défault est le meme que le mdp en cours

                    if($_SESSION['user']->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS) {

                                    
                        header('location: /../admin/controllers/list-user-ctrl.php');//On redirige l'admin vers la liste des utilisateurs
                        die;

                    }else {
                        //On connecte l'utilisateur
                        header('location: /../controllers/landing-ctrl.php');//On redirige l'utilisateur vers le tableau de bord
                        die;
                    }

                }else {
                    $errorsArray['password'] = 'Le mot de passe est incorrect';
                }
        
            }else {
                header('location: /../controllers/signIn-ctrl.php?msgCode=19');//si le compte existe déjà on redirige av mess erreur
                die;
            }

        }
    
    }else{
        $errorsArray['password'] = 'Le champ est obligatoire';
    }
}

// +++++++++++++++++VUES++++++++++++++++++++++++++++++++++
require_once dirname(__FILE__).'/../views/templates/header.php';
require_once dirname(__FILE__).'/../views/user/signIn.php';
require_once dirname(__FILE__).'/../views/templates/footer.php';
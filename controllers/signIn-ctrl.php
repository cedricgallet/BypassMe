<?php
session_start();
require_once dirname(__FILE__).'/../models/User.php';

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

            if($user)//Donc si user existe(vrai) = true 1
            {

                $isPasswordOk = password_verify($password, $user->password);
                if($isPasswordOk)//Si mdp est le meme que celui en bdd
                {

                    // +++++++++++++++++++++++Connection administration+++++++++++++++++++++++
                    $defaultEmail = 'galletcedric@protonmail.com';
                    $defaultPassword = 'cccccccc';


                    if($email == $defaultEmail && $password == $defaultPassword) 
                    {
                        //On connecte l'administrateur
                        $_SESSION['admin'] = $user;
                        header('location: /../admin/controllers/list-user-ctrl.php');//On redirige vers le tableau de bord
                        die;

                    }else {
                        //On connecte l'utilisateur
                        $_SESSION['user'] = $user;
                        header('location: /../controllers/landing-ctrl.php');//On redirige vers le tableau de bord
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






    // Si aucune erreur, on enregistre en BDD
    if(empty($errorsArray))
    {
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe si non ok (grâce a son email)
        $checkUser = User::getByEmail($email);

        //var_dump($user);die;
        if($checkUser)//Si l'utilisateur existe = 1
        {
            $isPasswordOk = password_verify($password, $user->password);
            

            if($isPasswordOk){//Si le mdp est le meme quand bdd
                // +++++++++++++++++++++++Connection administration+++++++++++++++++++++++
                $defaultEmail = 'galletcedric@protonmail.com';
                $defaultPassword = 'cccccccc';


                if($email == $defaultEmail && $password == $defaultPassword) 
                {
                    //On connecte l'administrateur
                    $_SESSION['admin'] = $user;
                    header('location: /../admin/controllers/list-user-ctrl.php');//On redirige vers le tableau de bord
                    die;

                }else {
                    //On connecte l'utilisateur
                    $_SESSION['user'] = $user;
                    header('location: /../controllers/landing-ctrl.php');//On redirige vers le tableau de bord
                    die;
                }
            }
        }else {
            header('location: /../controllers/signUp-ctrl.php?msgCode=13');//Si l'utilisateur n'existe pas on redirige av mess erreur
            die;
        }
    }
}

// +++++++++++++++++VUES++++++++++++++++++++++++++++++++++
require_once dirname(__FILE__).'/../views/templates/header.php';
require_once dirname(__FILE__).'/../views/user/signIn.php';
require_once dirname(__FILE__).'/../views/templates/footer.php';
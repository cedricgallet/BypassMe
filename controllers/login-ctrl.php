<?php
session_start(); // Démarrage de la session  
include(dirname(__FILE__).'/../models/User.php');//models


$email = ""; $password =""; 

///////////////////////////EMAIL/PASSWORD : NETTOYAGE ET VALIDATION ET CREATION/CONNEXION BDD////////////////////////

if($_SERVER["REQUEST_METHOD"] == "POST") //Si il ya des données d'envoyées
{

    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si champs email, password ne sont pas vident
    {
        
        // Nettoyage
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        $password = $_POST['password']; 


        // On vérifie si l'utilisateur existe
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe  si oui ok (grâce a son email)
        $user = User::getByEmail($email);

        // var_dump($user); ok
        // die;

        if($user) //Si (vrai) l'email/l'utilisateur existe = 1
        {
            if($testEmail) // Si le mail est bon format
            {
                if(password_verify($password, $user->password))//Si le mdp est le bon
                {
                    

                    $_SESSION['user'] = $user; // On crée la session/On connecte l'utilisateur 
                    header('Location: /../controllers/landing-ctrl.php');
                    die;

                        
                    
                }else{ 
                    header('Location: /../views/form/login.php?login_err=password');
                    die; 
                }

            }else{ 
                header('Location: /../views/form/login.php?login_err=email'); 
                die; 
            }

        }else{ 
            header('Location: /../views/form/login.php?login_err=already'); 
            die; 
        }

    }else{ 
        header('Location: /../views/form/login.php?login_err=empty'); // si le formulaire est envoyé sans aucune données
        die; 
    }
}

include(dirname(__FILE__).'/../views/form/login.php');





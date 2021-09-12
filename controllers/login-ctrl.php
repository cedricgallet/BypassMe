<?php
session_start(); // Démarrage de la session
include(dirname(__FILE__).'/../utils/regex.php');
include(dirname(__FILE__).'/../models/User.php');//models

include(dirname(__FILE__).'/../views/templates/navbar.php');
include(dirname(__FILE__).'/../views/form/login.php');
include(dirname(__FILE__).'/../views/templates/footer.php');


$email = ""; $password =""; 

///////////////////////////EMAIL/PASSWORD : NETTOYAGE ET VALIDATION ET CREATION/CONNEXION BDD////////////////////////

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si champs email, password ne sont pas vident
    {
        
        // Nettoyage
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $password = $_POST['password']; 


        // On vérifie si l'utilisateur existe
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe  si non ok (grâce a son email)
        $user = User::getByEmail($email);

        // var_dump($user);
        // die;

        if($user) //Si l'email/l'utilisateur existent = 1
        {
            if($testEmail) // Si le mail est bon format
            {
                if(password_verify($password, $user->password))
                {
                
                        //On connecte le user
                        $_SESSION['user'] = $user;

                    // var_dump($user);
                    // die;

                    
                        header('Location: /../views/landing.php');
                        die;
    
    
                            
                }else{ 
                    header('Location: /../views/form/login.php?msgCode=20'); 
                    die; 
                }

            }else{ 
                header('Location: /../views/form/login.php?msgCode=16'); 
                die; 
            }

        }else{ 
            header('Location: /../views/form/login.php?msgCode=19'); 
            die; 
        }

    }else{ 
        header('Location: /../views/form/login.php?msgCode=18'); // si le formulaire est envoyé sans aucune données
        die; 
    }
    
} 






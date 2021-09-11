<?php
session_start(); // Démarrage de la session  
include(dirname(__FILE__).'/../utils/regex.php');
include(dirname(__FILE__).'/../models/User.php');//models

$email = ""; $password ="";$title ='Connexion';
///////////////////////////EMAIL/PASSWORD : NETTOYAGE ET VALIDATION ET CREATION/CONNEXION BDD////////////////////////

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si champs email, password ne sont pas vident
    {
        
        // XSS/Nettoyage
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $password = $_POST['password']; 


        // On vérifie si l'utilisateur existe
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe  si non ok (grâce a son email)
        $checkUser = User::getUserByEmail($email);

        // var_dump($checkUser);
        // die;

        if($checkUser > 0) //Si l'email/l'utilisateur existent = 1
        {
            if($testEmail) // Si le mail est bon niveau format
            {
                if(password_verify($password, $singleUser->password)) // Si le mot de passe est le bon
                {


                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user'] = $user;

                    // var_dump($user);
                    // die;

                    

                    header('Location: /../controllers/landing-ctrl.php');
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

// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++
include(dirname(__FILE__).'/../views/templates/navbar.php');
include(dirname(__FILE__).'/../views/form/login.php');
include(dirname(__FILE__).'/../views/templates/footer.php');





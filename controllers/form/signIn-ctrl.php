<?php
if (empty(session_id())){
    session_start(); // Démarrage de la session        
} 
require_once __DIR__.'/../../models/User.php';//models

$email = ""; $password =""; $title = 'Connexion';


if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si champs email, password ne sont pas vident
    {

        // XSS
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $password = $_POST['password']; 
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        $user = User::getByEmail($email);//On récupére les infos user 


        //L'email/l'utilisateur existent
        if($user)
        {
            // Si le mail est bon niveau format
            if($testEmail)
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $user->password))
                {


                    //ON CONNECTE L'UTILISATEUR
                    $_SESSION['user'] = $user;    
                    header('Location: /../controllers/landing-ctrl.php');
                    die;



                }else{ 
                    header('Location: /../views/form/signIn.php?msgCode=20'); 
                    die; 
                }
            }else{ 
                header('Location: /../views/form/signIn.php?msgCode=16'); 
                die; 
            }
        }else{ 
            header('Location: /../views/form/signIn.php?msgCode=19'); 
            die; 
        }
    }else{ 
        header('Location: /../views/form/signIn.php?msgCode=18'); // si le formulaire est envoyé sans aucune données
        die; 
    }
    
} 

// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++
include dirname(__FILE__).'/../../views/templates/navbar.php';
include dirname(__FILE__).'/../../views/form/signIn.php';
include dirname(__FILE__).'/../../views/templates/footer.php';


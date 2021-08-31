<?php
session_start(); // Démarrage de la session        
include(dirname(__FILE__).'/../utils/db.php'); // On inclut la connexion à la base de données
include(dirname(__FILE__).'/../utils/regex.php');
include(dirname(__FILE__).'/../models/User.php');//models

$email = ""; $password ="";
///////////////////////////EMAIL/PASSWORD : NETTOYAGE ET VALIDATION ET CREATION/CONNEXION BDD////////////////////////

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si champs email, password ne sont pas vident
    {
        // Patch XSS
        $email = htmlspecialchars($_POST['email']); 
        $password = htmlspecialchars($_POST['password']);  
        $email = strtolower($email); // email transformé en minuscule

        // On instancie
        $user = new User();
        $user->email = $email;
        // récupération des infos de l'utilisateur (correspondant au mail,id,pseudo)
        $singleUser = $user->readOneUser($id,$email);

        //L'email/l'utilisateur existent(si requete renvoie 1 c'est ok)
        if($singleUser > 0)
        {
            // Si le mail est bon niveau format
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $singleUser->password))
                {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user']['id'] = $singleUser->id;
                    $_SESSION['user']['pseudo'] = $singleUser->pseudo;

                    header('Location: /../controllers/landing-ctrl.php');
                    die();

                }else{ 
                    header('Location: /../views/form/login.php?login_err=password'); 
                    die(); 
                }
            }else{ 
                header('Location: /../views/form/login.php?login_err=email'); 
                die(); 
            }
        }else{ 
            header('Location: /../views/form/login.php?login_err=already'); 
            die(); 
        }
        
    }else{ 
        header('Location: /../views/form/login.php?login_err=empty');
        die();
    } // si le formulaire est envoyé sans aucune données

}

// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
include(dirname(__FILE__).'/../views/templates/navbar.php');
if($_SERVER["REQUEST_METHOD"] != "POST") 
{
    include(dirname(__FILE__).'/../views/form/login.php');
}
include(dirname(__FILE__).'/../views/templates/footer.php');





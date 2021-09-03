<?php
if (empty(session_id())) session_start(); // Démarrage de la session        
require_once __DIR__.'/../utils/db.php'; // On inclut la connexion à la base de données
require_once __DIR__.'/../utils/regex.php';
require_once __DIR__.'/../models/User.php';//models

$email = ""; $password ="";$title ='Connexion';
///////////////////////////EMAIL/PASSWORD : NETTOYAGE ET VALIDATION ET CREATION/CONNEXION BDD////////////////////////

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si champs email, password ne sont pas vident
    {
        // Patch XSS
        $email = htmlspecialchars($_POST['email']); 
        $password = htmlspecialchars($_POST['password']); 
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        // On instancie
        $user = new User();
        // récupération des infos de l'utilisateur (correspondant au mail,id)
        $singleUser = $user->readOneUser($id,$email);

        //L'email/l'utilisateur existent(si requete renvoie 1 c'est ok)
        if($singleUser > 0)
        {
            // Si le mail est bon niveau format
            if($testEmail != false)
            {
                // Si le mot de passe est le bon
                if(password_verify($password, $singleUser->password))
                {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user']['id'] = $singleUser->id;
                    $_SESSION['user']['pseudo'] = $singleUser->pseudo;
                    $_SESSION['user']['email'] = $singleUser->email;
                    $_SESSION['user']['ip'] = $singleUser->ip;

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
require_once __DIR__.'/../views/templates/navbar.php';
if($_SERVER["REQUEST_METHOD"] != "POST") 
{
    require_once __DIR__.'/../views/form/login.php';
}
require_once __DIR__.'/../views/templates/footer.php';





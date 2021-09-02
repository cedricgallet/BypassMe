<?php
require_once __DIR__.'/../utils/db.php'; // On inclut la connexion à la base de données
require_once __DIR__.'/../utils/regex.php';
require_once __DIR__.'/../models/User.php';//models

$id='';$pseudo=''; $email=''; $password=''; $ip=''; $token='';$title = 'Inscription';

// On vérifie que les données sont bien envoyées
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['email2']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        // Patch XSS
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $email2 = htmlspecialchars($_POST['email2']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);


        // On vérifie si l'utilisateur existe
        $user = new User();// On instancie
        $singleUser = $user->readOneUser($id,$email);//récupération des infos de l'utilisateur (correspondant au mail et id)
    
        // Si la requête renvoie un 0 alors l'utilisateur n'existe pas 
        if($singleUser == 0)
        { 
            if($testRegex != false)// On vérifie le format du pseudo
            {               
                if($testEmail != false)// Si l'email est au bon format
                {
                    if($password === $password2)// si les deux mdp sont les mêmes
                    {
                        // On hash le mot de passe avec Bcrypt, via un coût de 12
                        $cost = ['cost' => 12];
                        $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                                            
                        $ip = $_SERVER['REMOTE_ADDR'];// On stock l'adresse IP 
                        
                        $users = new User($pseudo, $email, $password, $ip, $token);//On récupère les infos/On instancie
                        $users->create();

                        // On redirige avec le message de succès
                        header('Location:/../views/landing.php?reg_err=success');
                        die();

                    }else{ 
                        header('Location: /../views/form/registration.php?reg_err=password'); 
                        die();
                    }

                }else{ 
                    header('Location: /../views/form/registration.php?reg_err=email'); 
                    die();
                }

            }else{ 
                header('Location: /../views/form/registration.php?reg_err=pseudo_length'); 
                die();
            }

        }else{ 
            header('Location: /../views/form/registration.php?reg_err=already'); 
            die();
        }

    } else {
        header('Location: /../views/form/registration.php?reg_err=empty'); 
        die();
    }     
    
}

// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
require_once __DIR__.'/../views/templates/navbar.php';
if($_SERVER["REQUEST_METHOD"] != "POST") 
{
    require_once __DIR__.'/../views/form/registration.php';
}
require_once __DIR__.'/../views/templates/footer.php';




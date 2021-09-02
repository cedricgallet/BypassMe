<?php
if ( empty(session_id()) ) session_start(); // Démarrage de la session        
require_once __DIR__.'/../utils/db.php'; // On inclut la connexion à la base de données
require_once __DIR__.'/../utils/regex.php';
require_once __DIR__.'/../models/User.php';//models

$id='';$pseudo=''; $email=''; $password=''; $ip=''; $token=''; $title = 'Inscription';

// On vérifie que les données sont bien envoyées
if($_SERVER["REQUEST_METHOD"] == "POST") 
{

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
        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule
        $email2 = strtolower($email2); // on transforme toute les lettres majuscule en minuscule


        // On vérifie si l'utilisateur existe
       // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe (grâce a son email)
        $checkEmail = User::checkDuplicate($email);

        //if ($checkEmail == false) echo "check : " .$checkEmail; else echo "lol";

        // Si la requête renvoie un 0 alors l'utilisateur n'existe pas 
        if($checkEmail == 0)
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
                        $user = null;
                        $user = new User("", $pseudo, $email, $password, $ip, $token);//On récupère les infos/On instancie
                        $user->create();

                        // On instancie
                        $user = new User();
                        // On récupère les infos infos de l'utilisateur 
                        $singleUser = $user->readOneUser($id,$email);

                        //On crée les sessions
                        $_SESSION['user']['id'] = $singleUser->id;
                        $_SESSION['user']['pseudo'] = $singleUser->pseudo;
                        $_SESSION['user']['email'] = $singleUser->email;
                        $_SESSION['user']['ip'] = $singleUser->ip;    

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




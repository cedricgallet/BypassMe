<?php
if (empty(session_id())){
    session_start(); // Démarrage de la session  
}       
require_once __DIR__.'/../utils/regex.php';
require_once __DIR__.'/../models/User.php';//models


$isRegistered = false; $user =null; $id ='';$pseudo=''; $email=''; $password=''; $ip=''; $token=''; $title ='Inscription';

if($_SERVER["REQUEST_METHOD"] == "POST") //On ne controle que s'il y a des données envoyées 
{
    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['email2']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        // XSS
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);

        $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $email2 = trim(filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL));

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule
        $email2 = strtolower($email2); // on transforme toute les lettres majuscule en minuscule
        
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        // On vérifie si l'utilisateur existe
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe (grâce a son email)
        $checkUser = User::getByEmail($email);

        //if ($checkEmail == false) echo "check : " .$checkEmail; else echo "lol";  //OK OK

        if($checkUser == 0)// Si la requête renvoie un 0 alors l'utilisateur n'existe pas 
        { 
            if($testRegex)//On vérifie le format du pseudo
            {               
                if($testEmail)//Si l'email est au bon format
                {
                    if($password === $password2)// si les deux mdp sont les mêmes
                    {
                        // On hash le mot de passe avec Bcrypt, via un coût de 12
                        $cost =['cost' => 12];
                        $password =password_hash($password, PASSWORD_DEFAULT, $cost);
                                            
                        $ip = $_SERVER['REMOTE_ADDR'];// On stock l'adresse IP 

                        $user =new User($pseudo, $email, $password, $ip, $confirmation_token, "", $type);//On récupère les infos/On instancie
                        $result = $user->create();

                        if($result===true){
                            header('location: /../views/landing.php?msgCode=1');// On redirige avec le message de succès
                            die;

                        } else {
                            // Si l'enregistrement s'est mal passé, on affiche à nouveau le formulaire de création avec un message d'erreur.
                            $msgCode = $result;
                        }


                    

                    }else{ 
                        header('Location: /../views/form/registration.php?msgCode=14'); 
                        die();
                    }

                }else{ 
                    header('Location: /../views/form/registration.php?msgCode=16'); 
                    die();
                }

            }else{ 
                header('Location: /../views/form/registration.php?msgCode=15'); 
                die();
            }

        }else{ 
            header('Location: /../views/form/registration.php?msgCode=13'); 
            die();
        }

    } else {
        header('Location: /../views/form/registration.php?msgCode=18'); 
        die();
    }     
}     
// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
require_once __DIR__.'/../views/templates/navbar.php';
require_once __DIR__.'/../views/form/registration.php';
require_once __DIR__.'/../views/templates/footer.php';




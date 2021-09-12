<?php
session_start(); // Démarrage de la session  
include(dirname(__FILE__).'/../models/User.php');//models
include(dirname(__FILE__).'/../views/form/register.php');


$user = null; $pseudo=''; $email=''; $password='';


if($_SERVER["REQUEST_METHOD"] == "POST") //Si il ya des données d'envoyées
{
    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['email2']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        // XSS/Nettoyage
        $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
        
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $email2 = trim(filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL));
        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule
        $email2 = strtolower($email2); // on transforme toute les lettres majuscule en minuscule
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        $password = $_POST['password'];
        $password2 = $_POST['password2'];    
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);


        // On vérifie si l'utilisateur existe
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe  si non ok (grâce a son email)
        $CheckUser = User::getByEmail($email);

    //var_dump($user);  // = booleen false 0 methode ok

        if($CheckUser==0)// Si l'utilisateur n'existe pas 
        { 
            if($testRegex)//Si le format du pseudo est correct
            {         
                if($email === $email2)//Si les 2 emails sont les mêmes
                {         
                    if($testEmail)//Si l'email est au bon format
                    {
                        if($password === $password2)// si les deux mdp sont les mêmes
                        {


                            $cost =['cost' => 12]; // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $password = password_hash($password, PASSWORD_DEFAULT, $cost);
                                                
                            $ip = $_SERVER['REMOTE_ADDR'];// On stock l'adresse IP 

                            $user = new User($pseudo, $email, $password, $ip);// On récupère les infos/On instancie
                            $user->createUser();

                            header('location: /../controllers/login-ctrl.php');
                            die;



                        }else{ 
                            header('Location: /../views/form/register.php?msgCode=14'); 
                            die;
                        }

                    }else{ 
                        header('Location: /../views/form/register.php?msgCode=16'); 
                        die;
                    }

                }else{ 
                    header('Location: /../views/form/register.php?msgCode=17'); 
                    die;
                }

            }else{ 
                header('Location: /../views/form/register.php?msgCode=15'); 
                die;
            }

        }else{ 
            header('Location: /../views/form/register.php?msgCode=13'); 
            die;
        }

    } else {
        header('Location: /../views/form/register.php?msgCode=18'); 
        die;
    }  
    
}     

<?php
include(dirname(__FILE__).'/../models/User.php');//models

$user = null; $pseudo = ''; $email = ''; $password = '';


if($_SERVER["REQUEST_METHOD"] == "POST") // On controle le type que si il ya des données d'envoyées 
{
    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['email2']) && !empty($_POST['password']) && !empty($_POST['password2']))
    {
        // XSS/Nettoyage
        $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING));
        
        $cleanEmail = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $cleanEmail2 = trim(filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL));
        $email = strtolower($cleanEmail); // on transforme toute les lettres majuscule en minuscule
        $email2 = strtolower($cleanEmail2); // on transforme toute les lettres majuscule en minuscule
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

        $password = $_POST['password'];
        $password2 = $_POST['password2'];    
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);

        //var_dump($email); die;  // ok


        // On vérifie si l'utilisateur existe
        // ON invoque la méthode statique permettant de vérifier si l'utilisateur existe  si non ok (grâce a son email)
        $CheckUser = User::getByEmail($email);

        //var_dump($CheckUser); die; // = booleen false 0 methode ok

        if($CheckUser == 0) // Si l'utilisateur n'existe pas 
        { 
            if($testRegex)//Si (vrai) le format du pseudo est correct
            {         
                if($email === $email2)//Si les 2 emails sont les mêmes
                {         
                    if($testEmail)//Si l'email est au bon format
                    {
                        if($password === $password2)// si les 2 mdp sont les mêmes
                        {


                            $cost =['cost' => 12]; // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $password = password_hash($password, PASSWORD_DEFAULT, $cost);
                                                
                            $ip = $_SERVER['REMOTE_ADDR'];// On stock l'adresse IP 

                            $user = new User($pseudo, $email, $password, $ip);// On récupère les infos/On instancie
                            $user->createUser();
                            
                            //var_dump($user);  // ok
                            header('location: /../controllers/login-ctrl.php?login_err=success');
                            die;

                            


                        }else{ 
                            header('Location: /../views/form/register.php?reg_err=password'); 
                            die;
                        }

                    }else{ 
                        header('Location: /../views/form/register.php?reg_err=email'); 
                        die;
                    }

                }else{ 
                    header('Location: /../views/form/register.php?eg_err=same_email'); 
                    die;
                }

            }else{ 
                header('Location: /../views/form/register.php?reg_err=pseudo_regex'); 
                die;
            }

        }else{ 
            header('Location: /../views/form/register.php?reg_err=already'); 
            die;
        }

    } else {
        header('Location: /../views/form/register.php?reg_err=empty'); 
        die;
    }  
    
} 


include(dirname(__FILE__).'/../views/form/register.php');

<?php
session_start();
require_once dirname(__FILE__).'/../models/User.php';//Models
require_once dirname(__FILE__).'/../config/config.php';//Gestion erreur + constante


$errorsArray = array();//Tableau erreur vide

$title = 'Connexion';


if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) que si il y a des données d'envoyées 
{ 

    // ********************************Email*************************************
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)); // On nettoie

    if(!empty($email)) // On test si le champ n'est pas vide
    {
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL); // On test la valeur

        if(!$testEmail)
        {    
            $errorsArray['email'] = 'L\'email n\'est pas valide';
        }

    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
    }

    // **************************Password**************************
    $password =  $_POST['password'];
        
    if(!empty($password)) // On test si le champ n'est pas vide
    {

            // Si aucune erreur, on enregistre en BDD
        if(empty($errorsArray))
        {
            $user = User::getByEmail($email);//On vérifie si l'utilisateur exite
            
            if($user)//Si vrai = true 1
            {

                $isPasswordOk = password_verify($password, $user->password);//On vérifie le mdp
                if($isPasswordOk)//Si mdp est le meme que celui en bdd
                {

                     //On stock les valeurs recuperées pour generer les cookies et ou tester si les cookies si ils existent
                    $pseudo = $user->pseudo ;
                    $email = $user->email ;
                    $state = $user->state ;

                    // **************************Cookie******************************

                    //Si les cookies n'existent pas ou si ils sont differents des infos en bdd
                    if (empty($_COOKIE['cookie-email']) || $_COOKIE['cookie-email'] != $email) 
                    {
        
                        //Si les cookies n'existe pas on en genere                     
                        //Les infos du cookie stocker chez l'utilisateur peuvent etre modifier donc on nettoie
                        setcookie('cookie-email', $email, array(

                            'expires' => time() + 60*24*36000,//Valide 1 an
                            'path' => '/',
                            'domain' => '',
                            'secure' => false, //Si true cookie uniquement transmis à travers une connexion sécurisée HTTPS depuis le client.$_SERVER['https']

                            'httponly' => true, //Si true, le cookie ne sera accessible que par le protocole HTTP. 
                            //Cela signifie que le cookie ne sera pas accessible via des langages de scripts, comme Javascript. 
                            //Il a été suggéré que cette configuration permet de limiter les attaques via XSS 
                            //bien qu'elle ne soit pas supportée par tous les navigateurs), néanmoins ce fait est souvent contesté. true ou false

                            'samesite' => 'lax'//valeur par défaut pour une meilleure défense contre les attaques de type cross-site request forgery (CSRF).
                            ));
                    }

                    if (empty($_COOKIE['cookie-pseudo']) || $_COOKIE['cookie-pseudo'] != $pseudo)
                    {

                        setcookie('cookie-pseudo', $pseudo , array(
                            'expires' => time() + 60*24*36000,
                            'path' => '/',
                            'domain' => '',
                            'secure' => false,
                            'httponly' => true,
                            'samesite' => 'lax'
                            ));
                    }

                    if (empty($_COOKIE['cookie-state']) || $_COOKIE['cookie-state'] != $state)
                    {

                        setcookie('cookie-state', $state , array(
                            'expires' => time() + 60*24*36000,
                            'path' => '/',
                            'domain' => '',
                            'secure' => false,
                            'httponly' => true,
                            'samesite' => 'lax'
                            ));
                    }

                    
                    
                    // *********************************************************************

                    $_SESSION['user'] = $user;//On crée la session
                                
                    // **********************Connection administration**********************

                    //On check si le mdp par défault est le meme que le mdp en bdd
                    $passDefault =  password_verify(DEFAULT_PASS, $user->password);

                    if($user->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS) 
                    {
                        header('location: /../admin/controllers/list-user-ctrl.php');//On redirige l'admin vers la liste des utilisateurs
                        die;        

                    }else {
                        header('location: /../controllers/landing-ctrl.php');//On redirige l'utilisateur vers son tableau de bord
                        die;
                    }



                }else {
                    $errorsArray['password'] = 'Le mot de passe est incorrect';
                }
        
            }else {
                header('location: /../controllers/signIn-ctrl.php?msgCode=19');//si le compte existe déjà on redirige av mess erreur
                die;
            }

        }

    }else{
        $errorsArray['password'] = 'Le champ est obligatoire';
    }

}

// **************************VUES***************************
require_once dirname(__FILE__).'/../views/templates/header.php';
require_once dirname(__FILE__).'/../views/user/signIn.php';
require_once dirname(__FILE__).'/../views/templates/footer.php';
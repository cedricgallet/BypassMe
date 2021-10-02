<?php   
session_start(); // Démarrage de la session  
require_once dirname(__FILE__).'/../models/User.php';//models

// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../views/user/signUp.php?msgCode=30');
    die();
}

$title ='Modifier mon mot de passe';

// ++++++++++++++++++++++++++++++UPDATE MOT DE PASSE+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

if($_SERVER["REQUEST_METHOD"] == "POST")//On controle le type que si il y a des données d'envoyées 
{

    // Si les données sont envoyées/non vide 
    if(!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password2']))
    {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $new_password2 = $_POST['new_password2'];


        // On récupère les infos de l'utilisateur
        $check_password  = $_pdo->prepare('SELECT password FROM user WHERE confirmation_token = :confirmation_token');
        $check_password->execute(array(
        "confirmation_token" => $_SESSION['user']
        ));
        $data_password = $check_password->fetch();


        if(password_verify($current_password, $data_password['password'])) // Si le mot de passe est le bon
        {
            if($new_password === $new_password2) // Si les 2 mdp sont les mêmes
            {

                $cost = ['cost' => 12]; // On chiffre le mot de passe
                $new_password = password_hash($new_password, PASSWORD_DEFAULT, $cost);


                $update = $pdo->prepare('UPDATE user SET password = :password WHERE confirmation_token = :confirmation_token'); // On met à jour la table utiisateurs
                $update->execute(array(
                    "password" => $new_password,
                    "confirmation_token" => $_SESSION['user']
                ));
                // On redirige
                header('Location: /../controllers/userUpdatePassword-ctrl.php?msgCode=35');
                die;


            }else{ 
                header('Location: /../controllers/userUpdatePassword-ctrl.php?msgCode=14'); 
                die;
            }

        }else{ 
            header('Location: /../controllers/userUpdatePassword-ctrl.php?msgCode=20'); 
            die; 
        }
        
    }else {
        header('Location: /../controllers/userUpdatePassword-ctrl.php?msgCode=18'); 
        die();
    }  
}  

// +++++++++++++++++++Templates et vues+++++++++++++++++++++++++++
require_once dirname(__FILE__).'/../views/templates/header.php';
require_once dirname(__FILE__) .'/../views/user/UserUpdatePassword.php';
require_once dirname(__FILE__) .'/../views/templates/footer.php';


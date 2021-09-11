<?php   
session_start(); // Démarrage de la session  
include(dirname(__FILE__).'/../utils/db.php'); // On inclut la connexion à la base de données
include(dirname(__FILE__).'/../models/User.php');//models

// Si la session n'existe pas 
if(!isset($_SESSION['user']['id']))
{
    header('Location:/../views/form/login.php');
    die();
}

$error = [];
$title ='Modifier mon mot de passe';

// ++++++++++++++++++++++++++++++UPDATE MOT DE PASSE+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Si les données sont envoyées/non vide 
if(!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password2']))
{
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $new_password2 = $_POST['new_password2'];


    // On récupère les infos de l'utilisateur
    $check_password  = $bdd->prepare('SELECT password FROM user WHERE confirmation_token = :confirmation_token');
    $check_password->execute(array(
    "confirmation_token" => $_SESSION['user']
    ));
    $data_password = $check_password->fetch();


    if(password_verify($current_password, $data_password['password'])) // Si le mot de passe est le bon
    {
        if($new_password === $new_password2) // Si le mot de passe tapé est bon
        {

            $cost = ['cost' => 12]; // On chiffre le mot de passe
            $new_password = password_hash($new_password, PASSWORD_DEFAULT, $cost);


            $update = $pdo->prepare('UPDATE user SET password = :password WHERE confirmation_token = :confirmation_token'); // On met à jour la table utiisateurs
            $update->execute(array(
                "password" => $new_password,
                "confirmation_token" => $_SESSION['user']
            ));
            // On redirige
            header('Location: /../views/landing.php');
            die;


        }else{ 
            header('Location: /../views/form/register.php?msgCode=14'); 
            die;
        }

    }else{ 
        header('Location: /../views/form/login.php?msgCode=20'); 
        die; 
    }
    
}else {
    header('Location: /../views/form/register.php?msgCode=18'); 
    die();
}  

// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
include(dirname(__FILE__).'/../../views/templates/navbar.php');
include(dirname(__FILE__).'/../../views/landing.php');
include(dirname(__FILE__).'/../../views/templates/footer.php');

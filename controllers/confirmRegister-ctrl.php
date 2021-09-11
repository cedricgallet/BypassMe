<?php
session_start(); // Démarrage de la session       
include(dirname(__FILE__) . '/../models/User.php');

$isRegistered = false;


$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));// Nettoyage de l'id passé en GET dans l'url


$tokenGet = trim(filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING));// Nettoyage du token passé en GET dans l'url


$user = User::getUser($id);// Récupération du compte user en bdd

// var_dump($user);
// die;

if($user && $tokenGet==$user->confirmation_token)//Comparer le token en GET avec le token en base
{
    $result = User::validateSignUp($id);

    // var_dump($result);
    // die;

    if($result)
    {
        $_SESSION['user'] = $user;
        $isRegistered = true;
    }
}


include(dirname(__FILE__) . '/../views/templates/header.php');
include(dirname(__FILE__) . '/../views/confirmRegister.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');

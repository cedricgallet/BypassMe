<?php
session_start(); // Démarrage de la session  

// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../views/form/login.php');
    die();
}

include("../addImage.php");

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    SaveImage("avatar_file", "../uploads/avatars/" . $_SESSION["user"] -> id . ".png");

    header("Location: landing-ctrl.php");
    die();
}

// +++++++++++++++++++Templates et vues+++++++++++++++++++++++++++
include(dirname(__FILE__) .'/../views/templates/navbar.php');
include(dirname(__FILE__) .'/../views/form/userAddAvatar.php');
include(dirname(__FILE__) .'/../views/templates/footer.php');

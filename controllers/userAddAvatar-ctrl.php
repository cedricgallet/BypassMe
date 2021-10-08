<?php
session_start(); // Démarrage de la session  

$title = 'Modifier mon avatar';

// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../controllers/signIn-ctrl.php?smgCode=30');
    die();
}

require_once(dirname(__FILE__).'/../utils/function.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
        SaveImage('avatar_file', '../uploads/users/' . $_SESSION['user']->id && $_SESSION['admin']->id . '.png');
        header('Location: ../controllers/landing-ctrl.php?smgCode=36');
        die();

}else {
    header('Location: /../controllers/landing-ctrl.php?smgCode=37');
    die;
}




// +++++++++++++++++++Templates et vues+++++++++++++++++++++++++++
require_once(dirname(__FILE__).'/../views/templates/header.php');
require_once(dirname(__FILE__) .'/../views/user/userAddAvatar.php');
require_once(dirname(__FILE__) .'/../views/templates/footer.php');

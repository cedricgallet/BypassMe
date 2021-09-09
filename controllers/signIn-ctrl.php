<?php
session_start();
include dirname(__FILE__).'/../models/User.php';
include dirname(__FILE__).'/../utils/config.php';//Gestion erreur';

$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$passwordPost = isset($_POST['password']) ? $_POST['password'] : '';

$user = User::getByEmail($email);

if($user){
    $isPasswordOk = password_verify($passwordPost, $user->password);
    if($isPasswordOk){
        //On connecte le user
        $_SESSION['user'] = $user;
        header('location: /index.php');
    }
}


include dirname(__FILE__).'/../views/templates/header.php';

include dirname(__FILE__).'/../views/user/signIn.php';

include dirname(__FILE__).'/../views/templates/footer.php';
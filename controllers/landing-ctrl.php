<?php   
session_start();// Démarrage de la session 
include(dirname(__FILE__).'/../utils/db.php'); // On inclut la connexion à la base de données
include(dirname(__FILE__).'/../utils/regex.php');
include(dirname(__FILE__).'/../models/User.php');//models

// Si la session n'existe pas 
if(!isset($_SESSION['user']))
{
    header('Location:/../views/form/login.php');
    die();
}

$error = [];

// ++++++++++++++++++++++++++++++UPDATE MOT DE PASSE+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Si les données sont envoyées/non vide 
if(!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password_retype']))
{
    // Patch XSS 
    $current_password = htmlspecialchars($_POST['current_password']);
    $new_password = htmlspecialchars($_POST['new_password']);
    $new_password_retype = htmlspecialchars($_POST['new_password_retype']);

    // On récupère les infos de l'utilisateur
    //$check_password  = $bdd->prepare('SELECT password FROM users WHERE token = :token');
    //$check_password->execute(array(
    //    "token" => $_SESSION['user']
    //));
    //$data_password = $check_password->fetch();

    // Si le mot de passe est le bon
    if(password_verify($current_password, $data_password['password']))
    {
        // Si le mot de passe tapé est bon
        if($new_password === $new_password_retype)
        {

            // On chiffre le mot de passe
            $cost = ['cost' => 12];
            $new_password = password_hash($new_password, PASSWORD_BCRYPT, $cost);
            // On met à jour la table utiisateurs
            $update = $pdo->prepare('UPDATE users SET password = :password WHERE token = :token');
            $update->execute(array(
                "password" => $new_password,
                "token" => $_SESSION['user']
            ));
            // On redirige
            header('Location: /../views/landing.php');
            die();

        } else{
            $error['password'] = "Les mot de passe sont differents!!";          
            die();
        }

    }
    else{
        $error['password'] = "Le mot de passe est incorrecte!!";          
        die();
    }

}
else{
    header('Location: /../views/landing.php');
    die();
}


// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
include(dirname(__FILE__).'/../views/templates/navbar.php');
include(dirname(__FILE__).'/../views/landing.php');
include(dirname(__FILE__).'/../views/templates/footer.php');


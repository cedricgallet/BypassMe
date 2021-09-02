<?php
if ( empty(session_id()) ) session_start(); // Démarrage de la session        
require_once __DIR__ .'/../utils/db.php'; // On inclut la connexion à la base de données
require_once __DIR__.'/../utils/regex.php';
require_once __DIR__.'/../models/User.php';//models
require_once __DIR__.'/../views/templates/navbar.php';


// Si la session n'existe pas 
if(!isset($_SESSION['user']['id']))
{
    header('Location:/../views/form/login.php');
    die();
}

if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])) {
    $tailleMax = 2097152;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');

    if($_FILES['avatar']['size'] <= $tailleMax) 
    {
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

        if(in_array($extensionUpload, $extensionsValides)) 
        {
            $chemin = "/../assets/img/membres/avatars".$_SESSION['id'].".".$extensionUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

            if($resultat) 
            {
                $updateavatar = $bdd->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
                $updateavatar->execute(array(
                    'avatar' => $_SESSION['id'].".".$extensionUpload,
                    'id' => $_SESSION['id']
                    ));
                header('Location: /../views/landing.php?id='.$_SESSION['id']);

            } else {
            $msg = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $msg = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        }
    } else {
        $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
}

require_once __DIR__ .'/../views/templates/navbar.php';
require_once __DIR__ .'/../views/form/landingAddAvatar.php';
require_once __DIR__ .'/../views/templates/footer.php';

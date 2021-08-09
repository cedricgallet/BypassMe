<?php

session_start(); // Démarrage de la session    
include(dirname(__FILE__). '/../utils/config.php'); // On inclut la connexion à la base de données

include(dirname(__FILE__).'/../utils/regex.php');

// Tableau d'erreur vide //
$error = [];

    ///////////////////////////EMAIL/PASSWORD : NETTOYAGE ET VALIDATION MDP ET CREATION/CONNEXION BDD////////////////////////

if($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(!empty($_POST['email']) && !empty($_POST['password'])) // Si champs email, password ne sont pas vident
    {
            $email = $_POST["email"];
            $testEmail = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
            $password = $_POST['password'];

            // On regarde si l'utilisateur est inscrit dans la table users
            $check = $bdd->prepare('SELECT pseudo, email, password, token FROM users WHERE email = ?');
            $check->execute(array($email));
            $data = $check->fetch();
            $row = $check->rowCount();

        // Si l'utilisateur existe
        if($row > 0)         
        {
            //  On vérifie si c'est le format attendu est correct
            if($testEmail)
            {
            
                if(password_verify($password, $data['password']))
                {
                    // On créer la session et on redirige sur landing.php
                    $_SESSION['user'] = $data['token'];

                    header('Location: /../views/form/landing.php');
                    die();

                } else {
                    $error["password"] = "Le mot de passe est incorrecte!!";
                    
                }

            } else {
                $error["email"] = "L'email n'est pas au bon format!!"; 
            }   
        } else { // On retourne une erreur
            $error["row"] = "Le compte n'existe pas!!";
        }
    
    } else { // Pour les champs obligatoires/Vides,OU on redirige sur login???
        $error["email"] = "Tous les champs sont obligatoires!!";
        $error["password"] = "Tous les champs sont obligatoires!!";
    }
}


 ////////////////////////////////////RENDU DES VUES CONCERNEES////////////////////////////////////////////

include(dirname(__FILE__).'/../views/templates/navbar.php');

if($_SERVER["REQUEST_METHOD"] != "POST" || !empty($error))
{
    // On réaffiche le formulaire 
    include(dirname(__FILE__).'/../views/form/login.php');

}

include(dirname(__FILE__).'/../views/templates/footer.php');





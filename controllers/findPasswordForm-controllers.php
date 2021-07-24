<?php

// Initialiser la session
session_start();

// Tableau d'erreur vide //
$error = [];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email1 = trim(filter_input(INPUT_POST, 'email1', FILTER_SANITIZE_EMAIL));

     // On vérifie que ce n'est pas vide
    if(!empty($email1) && !empty($email2)){
        $testEmail = filter_var($email1, FILTER_VALIDATE_EMAIL);
        //  On vérifie si c'est le format attendu 
        if(!$testEmail){
            $error["email1"] = "L email n'est pas au bon format!"; 
        } 
        

    } else { // Pour les champs obligatoires/Vides, on retourne une erreur
        $error["email1"] = "Vous devez entrer un email!";
    } 
}


//comparez l email avec la BDD si ok envoi du nouveau mot de passe

//var_dump($error);


//////////////////////////////////////////////////////////RENDU DES VUES CONCERNEES////////////////////////////////////////////////////////

include(dirname(__FILE__).'/../views/templates/navBar.php');

if($_SERVER["REQUEST_METHOD"] != "POST" || !empty($error)){
     // On réaffiche le formulaire d'inscription
    include(dirname(__FILE__).'/../views/findPasswordForm/findPasswordForm.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');

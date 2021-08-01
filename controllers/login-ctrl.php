<?php

include(dirname(__FILE__).'/../utils/regex.php');

// Tableau d'erreur vide //
$error = [];
//echo 'bonjour';

// ON VERIFIFIE QUE LE FORMULAIRE EST ENVOYÉ

if($_SERVER["REQUEST_METHOD"] == "POST") {

    //////////////////////////////////////PSEUDO : NETTOYAGE ET VALIDATION/////////////////////////////////////

    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    
    // On vérifie que ce n'est pas vide
    if(!empty($pseudo)){
        //  On vérifie si c'est le format attendu 
        if(!$testRegex){
            $error["pseudo"] = "Le pseudo n'est pas au bon format!!"; 
        } else {
            // Vérifier la longueur de chaine (on aurait pu le faire dans la regex)
            if(strlen($pseudo)<=1 || strlen($pseudo)>=20){
                $error["pseudo"] = "La longueur du pseudo n'est pas bonne";
            }
        }
    } else { // Pour les champs obligatoires, on retourne une erreur    
        $error["pseudo"] = "Vous devez entrer un pseudo!";
    }    

      ////////////Etablir une correspondance avec le mot de passe chiffré de la base de données et le mot de passe saisi par l'utilisateur/////////////////



}

////////////////////////////////////RENDU DES VUES CONCERNEES////////////////////////////////////////////

include(dirname(__FILE__).'/../views/templates/navbar.php');

if($_SERVER["REQUEST_METHOD"] != "POST" || !empty($error)){
    // On réaffiche le formulaire 
    include(dirname(__FILE__).'/../views/form/login.php');
}else {
    include(dirname(__FILE__).'/../models/home.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');





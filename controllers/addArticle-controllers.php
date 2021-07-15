<?php

// Tableau d'erreur vide //
$error = [];

include(dirname(__FILE__).'/../utils/regex.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($pseudo)){
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);
        //  On vérifie si c'est le format attendu 
        if(!$testRegex){
            $error["pseudo"] = "Le pseudo n'est pas au bon format!!"; 
        } else {
            // Vérifier la longueur de chaine (on aurait pu le faire dans la regex)
            if(strlen($pseudo)<=1 || strlen($pseudo)>=10){
                $error["pseudo"] = "La longueur du pseudo  n'est pas bonne";
            }
        }
    } else { // Pour les champs obligatoires, on retourne une erreur
        $error["pseudo"] = "Vous devez entrer un pseudo!";
    }

    //CONNEXION BDD + ENVOI
}

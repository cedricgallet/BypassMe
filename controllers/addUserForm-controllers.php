<?php

// Tableau d'erreur vide //
$error = [];

include(dirname(__FILE__).'/../utils/regex.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {

    ////////////////////////////////////////////////////////// PSEUDO : NETTOYAGE ET VALIDATION//////////////////////////////////////////////////////////////////////

    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    
    // On vérifie que ce n'est pas vide
    if(!empty($pseudo)){
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);
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

    //CONNEXION BDD + ENVOI

    //var_dump($error);


    ////////////////////////////////////////////////////////////////EMAIL : NETTOYAGE ET VALIDATION//////////////////////////////////////////////////////////////////////

    $email1 = trim(filter_input(INPUT_POST, 'email1', FILTER_SANITIZE_EMAIL));
    $email2 = trim(filter_input(INPUT_POST, 'email2', FILTER_SANITIZE_EMAIL));

     // On vérifie que ce n'est pas vide
    if(!empty($email1) && !empty($email2)){
        $testEmail = filter_var($email1, FILTER_VALIDATE_EMAIL);
        //  On vérifie si c'est le format attendu 
        if(!$testEmail){
            $error["email1"] = "L email n'est pas au bon format!"; 
            $error["email2"] = "L email n'est pas au bon format!"; 
        } else {
            // On verifie si sa correspond
            if ($email1 != $email2) {
                $error["email1"] = "Les deux email sont différents";
                $error["email2"] = "Les deux email sont différents";
            }
        } 
        

    } else { // Pour les champs obligatoires/Vides, on retourne une erreur
        $error["email1"] = "Vous devez entrer un email!";
        $error["email2"] = "Vous devez entrer un email!";
    } 

    //CONNEXION BDD + ENVOI    

   ///////////////////////////////////////////////////////////////////PASSWORD : VALIDATION///////////////////////////////////////////////

    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

     // On vérifie que ce n'est pas vide
    if (!empty($_POST['password1']) && !empty($_POST['password2'])) { 
        $password_encrypted = password_hash($password1, PASSWORD_BCRYPT);

        if($password1 != $password2) {
            $error['password1'] = "Les mots de passe sont différents!!";
            $error['password2'] = "Les mots de passe sont différents!!";

        } else {
            $testRegex = preg_match('/'.REGEX_PASSWORD.'/',$password1);

            if(!$testRegex) {
                $error['password1'] = 'Il vous faut au moins 8 caractéres, 1 Majuscule, 1 minuscule, 1chiffre, 1 caractére spécial';
                $error['password2'] = 'Il vous faut au moins 8 caractéres, 1 Majuscule, 1 minuscule, 1chiffre, 1 caractére spécial';
            }   
        }

    } 

    else {
        $error['password1'] = 'Le mot de passe est obligatoire !!';
        $error['password2'] = 'Le mot de passe est obligatoire !!';
    }        
        //===============================================CONNEXION BDD + ENVOI +INSCRIPTION==============================================


    //var_dump($error);

    

}




//////////////////////////////////////////////////////////RENDU DES VUES CONCERNEES////////////////////////////////////////////////////////

include(dirname(__FILE__).'/../views/templates/navBar.php');

if($_SERVER["REQUEST_METHOD"] != "POST" || !empty($error)){
     // On réaffiche le formulaire d'inscription
    include(dirname(__FILE__).'/../views/addUserForm/addUserForm.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');




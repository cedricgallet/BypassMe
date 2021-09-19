<?php
require_once(dirname(__FILE__) . '/../config/regex.php');

require_once(dirname(__FILE__) . '/../models/User.php');


// Initialisation du tableau d'erreurs
$errorsArray = array();
/*************************************/

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
/*************************************************************/

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // lastname
    // On verifie l'existance et on nettoie
    $lastname = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($lastname)){
        // On test la valeur
        $testRegex = preg_match(REGEX_PSEUDO,$pseudo);

        if($testRegex == false){
            $errorsArray['name_error'] = 'Merci de choisir un nom valide';
        }
    }else{
        $errorsArray['name_error'] = 'Le champ est obligatoire';
    }

    // ***************************************************************
    
    // EMAIL
    // On verifie l'existance et on nettoie
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    //On test si le champ n'est pas vide
    if(!empty($mail)){
        // On test la valeur
        $testemail = filter_var($email, FILTER_VALIDATE_EMAIL);

        if($testEmail == false){
            $errorsArray['email_error'] = 'Le mail n\'est pas valide';
        }
    }else{
        $errorsArray['email_error'] = 'Le champ est obligatoire';
    }

    // ***************************************************************

    // Si il n'y a pas d'erreurs, on met à jour le patient.
    if(empty($errorsArray) ){    
        $patient = new User($lastname, $firstname, $birthdate, $phone, $mail);
        $result = $patient->update($id);
        if($result===true){
            header('location: /controllers/list-user-ctrl.php?msgCode=2');
        } else {
            // Si l'enregistrement s'est mal passé, on affiche à nouveau le formulaire de création avec un message d'erreur.
            $msgCode=$result;
        }
    }
} else {
    $patient= User::get($id);
    // Si le patient n'existe pas, on redirige vers la liste complète avec un code erreur
    if($patient){
        $id = $patient->id;
        $lastname = $patient->lastname;
        $firstname = $patient->firstname;
        $birthdate = $patient->birthdate;
        $phone = $patient->phone;
        $mail = $patient->mail;
    } else {
        header('location: /controllers/list-user-ctrl.php?msgCode=3');
    }
    /*************************************************************/
}

/* ************* AFFICHAGE DES VUES **************************/

include(dirname(__FILE__) . '/../views/templates/header.php');
    include(dirname(__FILE__) . '/../views/patients/form-user.php');
include(dirname(__FILE__) . '/../views/templates/footer.php');

/*************************************************************/
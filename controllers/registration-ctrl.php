<?php
include(dirname(__FILE__).'/../utils/config.php'); // On inclu la connexion à la bdd

// Tableau d'erreur vide //
$error = [];

include(dirname(__FILE__).'/../utils/regex.php');


// On vérifie que les données sont bien envoyées
if($_SERVER["REQUEST_METHOD"] == "POST") {

    ////////////////////////////////////// PSEUDO : NETTOYAGE ET VALIDATION////////////////////////////

    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    // On vérifie si l'utilisateur existe
    $check = $bdd->prepare('SELECT pseudo, email, password FROM users WHERE email = ?');
    $check->execute(array($email));
    $data = $check->fetch();
    $row = $check->rowCount();
    
    // On vérifie que ce n'est pas vide
    if(!empty($pseudo))
    {
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);
        //  On vérifie si c'est le format attendu 
        if(!$testRegex)
        {
            $error["pseudo"] = "Le pseudo n'est pas au bon format!!"; 
        } else {
            // Vérifier la longueur de chaine (on aurait pu le faire dans la regex)
            if(strlen($pseudo)<=1 || strlen($pseudo)>=20)
            {
                $error["pseudo"] = "La longueur du pseudo n'est pas bonne";
            }
        }
    } else 
    { // Pour les champs obligatoires, on retourne une erreur
        $error["pseudo"] = "Vous devez entrer un pseudo!";
    }


    //////////////////////////////////////EMAIL : NETTOYAGE ET VALIDATION/////////////////////////////////////

    $email = $_POST["email"];
    $email2 = $_POST["email2"];
    $testEmail = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

     // On vérifie que ce n'est pas vide
    if(!empty($email) && !empty($email2)){
        //  On vérifie si c'est le format attendu 
        if(!$testEmail)
        {
            $error["email"] = "L email n'est pas au bon format!"; 
            $error["email2"] = "L email n'est pas au bon format!"; 
        } else {
            // On verifie si sa correspond
            if ($email != $email2) 
            {
                $error["email"] = "Les deux email sont différents";
                $error["email2"] = "Les deux email sont différents";
            }
        } 
        

    } else { // Pour les champs obligatoires/Vides, on retourne une erreur
        $error["email"] = "Vous devez entrer un email!";
        $error["email2"] = "Vous devez entrer un email!";
    } 

   ////////////////////////////////////////PASSWORD : VALIDATION///////////////////////////////////////////:

    $password = $_POST['password'];
    $password2 = $_POST['password2'];

     // On vérifie que ce n'est pas vide
    if (!empty($_POST['password']) && !empty($_POST['password2']))
    { 

        if($password === $password2)
        { // si les 2 mdp sont les meme
        
            // On hash le mot de passe avec Bcrypt, via un coût de 12
            $cost = ['cost' => 12];
            $password = password_hash($password, PASSWORD_BCRYPT, $cost);

            // On stock l'adresse IP
            $ip = $_SERVER['REMOTE_ADDR']; 

            // On insère dans la base de données
            $insert = $bdd->prepare('INSERT INTO users(pseudo, email, password, ip, token) VALUES(:pseudo, :email, :password, :ip, :token)');
            $insert->execute(array(
                'pseudo' => $pseudo,
                'email' => $email,
                'password' => $password,
                'ip' => $ip,
                'token' => bin2hex(openssl_random_pseudo_bytes(64))
            ));
            
            // On redirige vers le tableau de bord
            header('Location:/../views/form/landing.php');
            die;

        } else {
            $error['password'] = "Les mots de passe sont différents!!";
            $error['password2'] = "Les mots de passe sont différents!!";
        }

    } else {
        $error['password'] = 'Le mot de passe est obligatoire !!';
        $error['password2'] = 'Le mot de passe est obligatoire !!';
    }     
    
}

////////////////////////////////RENDU DES VUES CONCERNEES//////////////////////////////

include(dirname(__FILE__).'/../views/templates/navbar.php');

if($_SERVER["REQUEST_METHOD"] != "POST" || !empty($error))
{
    // On réaffiche le formulaire 
    include(dirname(__FILE__).'/../views/form/registration.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');




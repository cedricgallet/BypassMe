<?php   
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../config/regex.php');
require_once(dirname(__FILE__).'/../models/User.php');//Models
require_once(dirname(__FILE__).'/../config/config.php');//Constante + Gestion erreur

// ****************************SECURITE ACCES PAGE*************************** 
if(!isset($_SESSION['user']))
{
    header('Location:/../controllers/signUp-ctrl.php?msgCode=38');
    die();
}
// ***********************************************************************************

$title ='Modifier mes informations';

$errorsArray = array();//Tableau erreur vide

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

if($_SERVER["REQUEST_METHOD"] == "POST")//On controle le type que si il y a des données d'envoyées 
{

    //**************************Mdp actuel******************************
    $current_password = $_POST['current_password'];


    //**************************Nouveau mot de passe******************************
    $new_password = $_POST['new_password'];


    //**************************Confirmation nouveau mot de passe******************************
    $new_password2 = $_POST['new_password2'];


    //**************************Status******************************
    // On verifie l'existance et on nettoie
    $state = intval(trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_NUMBER_INT)));


    // *************************pseudo************************
    // On verifie l'existance et on nettoie
    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));

    //On test si le champ n'est pas vide
    if(!empty($pseudo)){
        // On test la valeur
        $testRegex = preg_match('/'.REGEX_PSEUDO.'/',$pseudo);

        if(!$testRegex){
            $errorsArray['pseudo'] = 'Merci de choisir un pseudo valide';
        }
    }else{
        $errorsArray['pseudo'] = 'Le champ est obligatoire';
    }

    // **********************Email******************************
    
    // On verifie l'existance et on nettoie
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

    //On test si le champ n'est pas vide
    if(!empty($email))
    {
        // On test la valeur
        $testMail = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$testMail){
            $errorsArray['email'] = 'Le mail n\'est pas valide';
        }

    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
    }

    // *************************Mot de passe actuel*************************

    //On test si le champ n'est pas vide
    if(!empty($current_password))
    {
        //On vérifie si mdp actuel est le meme que celui en cours
        $isPasswordOk = password_verify($current_password, $_SESSION['user']->password);

    }else{
        $errorsArray['current_password'] = 'Le champ est obligatoire';
    }


    // *************************Nouveau mot de passe*************************

    //On test les autre champs si seulement le mdp actuel est le bon 
    if(!empty($new_password) && !empty($new_password2))
    {

        if($new_password!=$new_password2){
            $errorsArray['new_password'] = 'Les mots de passe sont différents';
            $errorsArray['new_password2'] = 'Les mots de passe sont différents';

        } else {
            $cost =['cost' => 12]; // On hash le mot de passe avec Bcrypt, via un coût de 12
            $password = password_hash($new_password, PASSWORD_DEFAULT,$cost);
        }

    }else{
        $errorsArray['new_password'] = 'Le champ est obligatoire';
        $errorsArray['new_password2'] = 'Le champ est obligatoire';
    }
    

    if($isPasswordOk)//Si mdp actuel est le meme que celui en cours
    {

        // Et si aucune erreur, on met a jour 
        if(empty($errorsArray))
        {

            $user = new User($pseudo, $email, $password, "", $state);//On instancie/On récupére les infos
            
            $result = $user->update($id);//On met a jour le mdp        

            if($result===true){//Si la MAJ s'est bien passé = 1
                
                header('location: /../controllers/landing-ctrl.php?msgCode=35');//On redirige av mess succés
                die;

            } else {
                // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
                $msgCode = $result;
            }

        }

    }else{
        $errorsArray['current_password'] = 'Le mot de passe est incorrect';
    }

}
    
// *****************************Vues*****************************
require_once dirname(__FILE__).'/../views/templates/header.php';
require_once dirname(__FILE__) .'/../views/user/userUpdateProfil.php';
require_once dirname(__FILE__) .'/../views/templates/footer.php';
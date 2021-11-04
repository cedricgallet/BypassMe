<?php   
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../admin/utils/regex.php');
require_once(dirname(__FILE__).'/../admin/models/User.php');//Models
require_once(dirname(__FILE__).'/../admin/config/config.php');//Constante + Gestion erreur

// ****************************SECURITE ACCES PAGE*************************** 
if(!isset($_SESSION['user']))
{
    header('Location:/../user/controllers/signUp-ctrl.php?msgCode=38');
    die();
}
// ***********************************************************************************

$title ='Modification du profil en cours ...';

$errorsArray = array();//Tableau erreur vide

// Nettoyage de l'id passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));


if($_SERVER["REQUEST_METHOD"] == "POST")//On controle le type que si il y a des données d'envoyées 
{


    // *****************************Pseudo******************************
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

    //**************************Mdp actuel******************************
    $current_password =  $_POST['current_password'];

    if(!empty($current_password)) // On test si le champ n'est pas vide
    {
        $user = User::get($id);//On check si l'utilisateur exite

        $isPasswordOk = password_verify($current_password, $user->password);

    }else{
        $errorsArray['password'] = 'Le champ est obligatoire';
    }



    //**************************Nouveau mot de passe + Confirmation nouveau mot de passe********************
    $new_password = $_POST['new_password'];
    $new_password2 = $_POST['new_password2'];


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


   
    // Et si aucune erreur
    if (empty($errorsArray)) 
    {
        if($isPasswordOk)//Si mdp actuel est le meme que celui en bdd
        {



            $user = new User($pseudo, $email, $password, "", "");//On instancie/On récupére les infos
            
            $result = $user->update($id);//On met a jour le mdp        
            if($result===true){//Si la MAJ s'est bien passé = 1
                
                // +++++++++++++++++++++++Redirection administration+++++++++++++++++++++++

                //On check si le mdp par défault(constante) est le meme que le mdp en bdd
                $passDefault =  password_verify(DEFAULT_PASS, $user->password);

                if($user->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS) 
                {

                                
                    header('location: /../user/controllers/landing-ctrl.php?msgCode=35');//On redirige l'admin av mess succés vers vers le tableau de bord
                    die;


                // Sinon on redirige l' utilisateur
                }else {
                    header('location: /../user/controllers/landing-ctrl.php?msgCode=35');//On redirige l'utilisateur av mess succés vers le tableau de bord
                    die;
                }


            } else {
                // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
                $msgCode = $result;
            }
            

        }else{
            $errorsArray['current_password'] = 'Le mot de passe est incorrect';
        }

    }


}else{
    $user = User::get($id);//On récupère les infos 

    if($user){//Si l'utilisateur existe on affiche
        $id = $user->id;
        $pseudo = $user->pseudo;
        $email =$user->email;

    } else { // Si l'utilisateur n'existe pas, on redirige vers la meme page avec un code erreur
        header('location: /../user/controllers/userUpdateProfil-ctrl.php?msgCode=19');
        die;
    }
}

    
// *****************************Vues*****************************
require_once dirname(__FILE__).'/../templates/header.php';
require_once dirname(__FILE__) .'/../user/views/userUpdateProfil.php';
require_once dirname(__FILE__) .'/../templates/footer.php';
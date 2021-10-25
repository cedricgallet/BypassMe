<?php
session_start(); // Démarrage de la session  
require_once dirname(__FILE__).'/../../models/User.php';//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************

if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

// ********************************************************************************************************

// Nettoyage de l'id de l'utilisateur passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//On récupère les infos
$user = User::get($id);

//Si l'utilisateur existe
if ($user)//Si vrai 
{

    $pseudo = $user->pseudo ;
    $email = $user->email ;
    $password = $user->password ;
    $state = $user->state ;


    if ($state = 1)    
    {

        $state = 0;//On désactive l'utilisateur

        $user = new User($pseudo, $email, $password, "", $state);//On instancie/On récupére les infos 

        $result = $user->update($id);//On met a jour        
        if($result===true){//Si la MAJ s'est bien passé = 1
            

            // On deconnecte l'utilisateur 
            header('location: /../../controllers/signOut-ctrl.php');
            die;

        
        } else {
            // Si l'enregistrement s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
            $msgCode = $result;
        }    


    }


}


<?php
session_start(); // Démarrage de la session  
require_once dirname(__FILE__).'/../../admin/models/User.php';//Models
require_once(dirname(__FILE__).'/../../admin/config/config.php');//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************

if (!isset($_SESSION['user'])) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

//On check si le mdp par défault est le meme que le mdp en cours
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);

if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// ********************************************************************************************************

// Nettoyage de l'id de l'utilisateur passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//On récupère les infos
$user = User::getUser($id);

//Si l'utilisateur existe
if ($user->state == 0)//Si status(compte) désactivé
{
    $id = $user->id;
    $pseudo = $user->pseudo ;
    $email = $user->email ;
    $password = $user->password ;

    $user->state = 1;//On active
    $state = $user->state ;

    $user = new User($pseudo, $email, $password, "", $state);//On instancie/On récupére les infos 

    $result = $user->updateUser($id);//On met a jour        

    if($result===true){//Si la MAJ s'est bien passé = true 1
        

        // On redirige av mess succes
        header('location: /../../admin/controllers/list-user-ctrl.php?msgCode=50'. '&id=' . $id);
        die;

    
    } else {
        // Si l'a MAJ s'est mal passé, on réaffiche le formulaire av un mess d'erreur.
        header('location: /../../admin/controllers/list-user-ctrl.php?msgCode=49');
        die;
    }    

}


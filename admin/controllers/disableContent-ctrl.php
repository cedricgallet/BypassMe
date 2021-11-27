<?php
session_start(); // Démarrage de la session  
require_once dirname(__FILE__).'/../../admin/models/User.php';//Models
require_once dirname(__FILE__).'/../../admin/config/config.php';//Constante + gestion erreur

// *****************************************SECURITE ACCES PAGE******************************************

if (!isset($_SESSION['user'])) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

// ********************************************************************************************************

// Nettoyage de l'id de l'utilisateur passé en GET dans l'url
$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//On récupère les infos
$user = User::getUser($id);

//Si l'utilisateur existe
if ($user)//Si vrai 
{

    $id = $user->id;
    $pseudo = $user->pseudo ;
    $email = $user->email ;
    $password = $user->password ;
    $state = $user->state ;


    if ($state == 1)    
    {

        $state = 0;//On désactive l'utilisateur

        $user = new User($pseudo, $email, $password, "", $state);//On instancie/On récupére les infos 

        $result = $user->updateUser($id);//On met a jour        
        if($result===true)//Si la MAJ s'est bien passé = 1
        {
            
            //On check si le mdp par défault(constante) est le meme que le mdp en cours
            $passDefault = password_verify(DEFAULT_PASS, $_SESSION['user']->password);

            if($_SESSION['user']->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS) 
            {
                //On redirige l'administrateur av mess succes
                header('Location: /../../admin/controllers/list-user-ctrl.php?msgCode=48' . '&id='. $id); 
                die;
            
            }else {
                // On redirige et on deconnecte l'utilisateur 
                header('location: /../../user/controllers/signOut-ctrl.php?msgCode=48');
                die;
            }

        
        } else {
            if ($_SESSION['user']->email == DEFAULT_EMAIL) 
            {
                // Si l'a MAJ s'est mal passé, on redirige av un mess d'erreur.
                header('location: /../../admin/controllers/list-user-ctrl.php?msgCode=47');
                die;
            } else {
                // Si l'a MAJ s'est mal passé, on redirige av un mess d'erreur.
                header('location: /../../user/controllers/landing-ctrl.php?msgCode=47');
                die;
            }

        }    


    }


}


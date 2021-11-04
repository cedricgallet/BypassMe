<?php
session_start(); // Démarrage de la session  
require_once(dirname(__FILE__).'/../../admin/models/Message.php');//Models
require_once(dirname(__FILE__).'/../../admin/models/User.php');//Models

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../user/controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}
// ********************************************************************************************************

// Tableau des sujets des messages //
$arraySubject = ['soummettre une idée','signaler un bug sur le site','signaler un lien mort', 'supprimer mon compte'];

$title = 'Déposer un message ?';

//On ne controle que s'il y a des données envoyées 
if($_SERVER['REQUEST_METHOD'] == 'POST') // On controle le type(post) 
{   

    // *********************Sujet du message**********************

    // On verifie l'existance et on nettoie
    $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); // On nettoie

    //On test si le champ n'est pas vide
    if(empty($subject)){
        $errorsArray['subject'] = 'Le champ est obligatoire';
    }

    // ********************Message**********************

    // On verifie l'existance et on nettoie
    $message = trim(filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES)); // On nettoie

    //On test si le champ n'est pas vide
    if(empty($message)){
        $errorsArray['message'] = 'Le champ est obligatoire';
    }

    // ***********************Email***********************

    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)); // On nettoie

    if(!empty($email)) // On test si le champ n'est pas vide
    {
        $testEmail = filter_var($email, FILTER_VALIDATE_EMAIL); // On test la valeur

        if(!$testEmail){    
            $errorsArray['email'] = 'L\'email n\'est pas valide';
        
        }

    }else{
        $errorsArray['email'] = 'Le champ est obligatoire';
    }
    // ***********************************************

    if(empty($errorsArray))
    {
        //Utilisation des transactions
        $pdo = Database::db_connect();
        $pdo->beginTransaction();

        $id_user = $_SESSION['user']->id;

        $getNewMessage = new Message($subject, $message, '', '', '',$id_user);//On instancie/On récupére les infos 

        $createMessage = $getNewMessage->createMessage();

        
        if($createMessage === true)
        {
                     
                $pdo->commit(); // Valide la transaction et exécute toutes les requetes 

                header('location: /../../user/controllers/add-message-ctrl.php?msgCode=40');//On redirige l'admin av mess succés
                die;
            

        } else {
            $pdo->rollBack(); // Annulation de toutes les requêtes exécutées avant la levée de l'exception

                // Si l'enregistrement s'est mal passé, on redirige av un mess d'erreur.
                header('location: /../../user/controllers/add-message-ctrl.php?msgCode=42');
                die;
        }  

    }
    
}else{
    $id = $_SESSION['user']->id;
    $user = User::get($id);//On récupère les infos et si l'utilisateur existe

    if($user)//Si vrai on affiche
    { 
        $id = $user->id;
        $email = $user->email;

    } else { // Si l'utilisateur n'existe pas, on redirige vers la liste complète avec un code erreur
        header('location: /../../user/controllers/add-message-ctrl.php?msgCode=3');
        die;
    }
}
    
                
// ++++++++++++++++++++Templates et vues++++++++++++++++++++++++
require_once(dirname(__FILE__).'/..//../templates/header.php');
require_once(dirname(__FILE__).'/../../user/views/add-message.php');
require_once(dirname(__FILE__).'/../../templates/footer.php');


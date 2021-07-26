<?php  

// Initialiser la session
session_start();

// Tableau d'erreur vide //
$error = [];

// Tableau des catégories disponibles //
$arrayCategories = ['applicative','web','réseau','humaine',];


// Tableau des sujets disponible //
$arraySubject = ['avis sur un article','soummettre une idée','signaler un bug sur le site'];


// Vérifiez si l'utilisateur est connecté, sinon redirigez vers la page de connexion
// if(!isset($_SESSION["pseudo"])){
//     header("Location: /controllers/login-controllers.php");
// } else {
//     $error["pseudo"] = "Vous devevez être connecter pour envoyer un commentaire.";
// }

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($categories)){
        //  On vérifie si c'est le format attendu 
        $categories = trim(filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_STRING));
    
    } else {
        $error["categories"] = "Le format du titre est incorrect!";
    }  

    if(!empty($subject)){
        //  On vérifie si c'est le format attendu 
        $subject = trim(filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING));
    
    } else {
        $error["subject"] = "Le format du sujet est incorrect!";
    }

    if(!empty($comment)){
        //  On vérifie si c'est le format attendu 
        $comment = trim(filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING));
    
    } else {
        $error["comment"] = "Le format du titre est incorrect!";
    }  

}  
//////////////////////////////////////////////////////////RENDU DES VUES CONCERNEES////////////////////////////////////////////////////////

include(dirname(__FILE__).'/../views/templates/navBar.php');

if($_SERVER["REQUEST_METHOD"] != "POST" || !empty($error)){
     // On réaffiche le formulaire d'inscription
    include(dirname(__FILE__).'/../views/form/contact.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');


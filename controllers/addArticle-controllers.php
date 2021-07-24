<?php

// Initialiser la session
session_start();

// Tableau d'erreur vide //
$error = [];

$arrayCategories = ['applicative','web','reseau','humaine'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($titre)) {
        //  On vérifie si c'est le format attendu 
        $titre = trim(filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING));
    
    } else {
        $error["titre"] = "Le format du titre est incorrect!";
    }  

    if(!empty($article)) {
        //  On vérifie si c'est le format attendu 
        $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING));
    
    } else {
        $error["article"] = "Le format du text est incorrect!";
    }  

}  

  ////Etablir une correspondance avec le mot de passe chiffré de la base de données et le mot de passe saisi par l'utilisateur/////////////



//////////////////////////////////////////////////////////RENDU DES VUES CONCERNEES////////////////////////////////////////////////////////

include(dirname(__FILE__).'/../views/templates/navBar.php');

if($_SERVER["REQUEST_METHOD"] != "POST" || !empty($error)){
     // On réaffiche le formulaire d'inscription
    include(dirname(__FILE__).'/../views/form/addArticleForm.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');


<?php

// Tableau d'erreur vide //
$error = [];


if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($article)){
        //  On vérifie si c'est le format attendu 
        $article = trim(filter_input(INPUT_POST, 'article', FILTER_SANITIZE_STRING));
    
    }
} else {
}        

    //CONNEXION BDD + ENVOI


//////////////////////////////////////////////////////////RENDU DES VUES CONCERNEES////////////////////////////////////////////////////////

include(dirname(__FILE__).'/../views/templates/navBar.php');

if($_SERVER["REQUEST_METHOD"] != "POST" || !empty($error)){
     // On réaffiche le formulaire d'inscription
    include(dirname(__FILE__).'/../views/AddArticleForm/addArticleForm.php');
}

include(dirname(__FILE__).'/../views/templates/footer.php');


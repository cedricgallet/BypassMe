<?php 
if (empty(session_id())) 
{
    session_start(); // Démarrage de la session 
}        
session_unset(); // on nettoe les variables de session
session_destroy(); // on détruit la session
header('Location:/../views/home.php'); // On redirige
die();

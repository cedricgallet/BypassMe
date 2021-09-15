<?php 
session_start(); // Démarrage de la session  
unset($_SESSION['user']); // on nettoye les variables de session
header('Location:/../index.php'); // On redirige
die;

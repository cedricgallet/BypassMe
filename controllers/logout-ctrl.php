<?php 
session_start(); // Démarrage de la session  
unset($_SESSION['user']); // on nettoye les variables de session
header('Location:/../views/home.php'); // On redirige
die;

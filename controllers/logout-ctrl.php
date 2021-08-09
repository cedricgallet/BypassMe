<?php 
    session_start(); // demarrage de la session

    session_destroy(); // on détruit la session

    header('Location:/../views/home.php'); // On redirige
    
    die();

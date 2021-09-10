<?php
if (empty(session_id())){
    session_start(); // Démarrage de la session        
} 
require_once __DIR__ . '/../views/templates/navbar.php';
require_once __DIR__ . '/../views/templates/header.php';
require_once __DIR__ . '/../views/home.php';
require_once __DIR__ . '/../views/templates/footer.php';



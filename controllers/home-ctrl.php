<?php
// Génération du home:
if (empty(session_id())) 
{
    session_start(); // Démarrage de la session 
}        

require_once __DIR__ . '/../views/home.php';



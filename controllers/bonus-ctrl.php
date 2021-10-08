<?php
session_start(); // Démarrage de la session  

// si la session n'existe pas ou si l'utilisateur n'est pas connecté on redirige
if(!isset($_SESSION['user'])){
    header('Location:/../views/user/sigIn.php?msgCode=30');
    die();
}

// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
require_once(dirname(__FILE__).'/../views/templates/header.php');
require_once(dirname(__FILE__).'/../views/user/bonus.php');
require_once(dirname(__FILE__).'/../views/templates/footer.php');



<?php

// Initialiser la session
session_start();


// Génération du Navbar:
include(dirname(__FILE__).'/views/templates/navBar.php');

// Génération du header:
include(dirname(__FILE__).'/views/templates/header.php');


// Génération du Main:
include(dirname(__FILE__).'/models/accueil.php');

// Génération du Footer:
include(dirname(__FILE__).'/views/templates/footer.php');






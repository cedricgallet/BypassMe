<?php

// Initialiser la session
session_start();


// Génération du Navbar:
include(dirname(__FILE__).'/views/templates/navbar.php');

// Génération du header:
include(dirname(__FILE__).'/views/templates/header.php');

// Génération du mainModels:
include(dirname(__FILE__).'/models/home.php');

// Génération du Footer:
include(dirname(__FILE__).'/views/templates/footer.php');






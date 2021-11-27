<?php
session_start(); // Démarrage de la session  

// *********************SECURISER ACCES PAGE**************
if(!isset($_SESSION['user'])){
    header('Location:/../views/user/sigIn.php?msgCode=38');
    die();
}


// +++++++++++++++++++++TEMPLATES ET VUE++++++++++++++++++++++++++++
require_once(dirname(__FILE__).'/../../templates/header.php');
require_once(dirname(__FILE__).'/../../user/views/bonus.php');
require_once(dirname(__FILE__).'/../../templates/footer.php');



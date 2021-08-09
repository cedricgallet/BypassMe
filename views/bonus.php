<?php

session_start(); // Démarrage de la session    
include(dirname(__FILE__). '/../utils/config.php'); // On inclut la connexion à la base de données


// Génération du Navbar:
include(dirname(__FILE__).'/../views/templates/navbar.php');
// Génération du Header:
include(dirname(__FILE__).'/../views/templates/header.php');
?>


    <div class='container-fluid'>
        <div class='row'>
            <div class='col-lg-10 col-md-12 col-sm-12'>
            
                <p>BONJOUR</p> <!-- ===============================CONTENU DES BONUS======================================= -->
            </div>
            <?php
            // Génération du rightMenu:
            include(dirname(__FILE__).'/../views/templates/rightMenu.php');
            ?>
        </div>
    </div>

<?php
// Génération du Footer:
include(dirname(__FILE__).'/../views/templates/footer.php');
?>

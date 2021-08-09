<?php

session_start();
include(dirname(__FILE__).'/../utils/config.php'); // ajout connexion bdd 

// Génération du Navbar:
include(dirname(__FILE__).'/../views/templates/navbar.php');

// Génération du header:
include(dirname(__FILE__).'/../views/templates/header.php');


    // si la session n'existe pas ou si l'utilisateur n'est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:/index.php');
        die();
    }


?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12">
            <!-- ===============================CONTENU DES SOLUTIONS======================================= -->
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



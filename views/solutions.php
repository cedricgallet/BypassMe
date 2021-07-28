<?php

// Génération du Navbar:
include(dirname(__FILE__).'/../views/templates/navbar.php');

// Génération du header:
include(dirname(__FILE__).'/../views/templates/header.php');

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



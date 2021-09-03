<?php
if (empty(session_id())) session_start(); // Démarrage de la session        
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


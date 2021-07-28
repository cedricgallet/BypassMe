<?php

// Initialiser la session
session_start();

// Génération de la Navbar:
include(dirname(__FILE__).'/../views/templates/navbar.php');

?>

<div id="mentionPoli" class="d-flex align-items-center container-fluid mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-3 mb-2 mt-2">
                <div class="card-body">
                    <h2 class="card-title text-center mb-3">
                        - Mentions légales -
                    </h2>
                    <p class="card-text">
                        - Conformément aux dispositions de la loi n° 2004-575 du 21 juin 2004 pour la confiance en
                        l’économie numérique,
                        il est précisé aux utilisateurs du site LookThis l’identité des différents intervenants dans le
                        cadre de sa réalisation et de son suivi.
                    </p>

                    <h3>Edition du site:</h3>
                    <p class="card-text">
                        
                        - Le site LookThis est édité par Cédric Gallet, inscrit en tant qu’auto-entrepreneur au RCS de
                        Toulon sous le
                        numéro de Siret 51194517200035.
                    </p>

                    <p class="card-text">
                        - Responsable de publication Cédric Gallet
                    </p>

                    <h3>Hébergeur:</h3>
                    <p class="card-text">
                        
                        - Le site LookThis est hébergé par la société K Media Tech – https://www.wpxhosting.com/

                        Le stockage des données personnelles des Utilisateurs est exclusivement réalisé sur les centre
                        de données
                        (“clusters”) localisés dans des Etats membres de l’Union Européenne de la société K Media Tech.

                        Nous contacter

                        Par email : LookThis@protonmail.com

                        
                    <h3>CNIL:</h3>
                    <p class="card-text">
                        - Le représentant de ce site s’engage à conserver dans ses systèmes informatiques et dans des
                        conditions
                        raisonnables de sécurité une preuve de la transaction comprenant le bon de commande et la
                        facture.
                    </p>

                    <p class="card-text">
                        - Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée, l’Utilisateur dispose
                        d’un droit
                        d’accès, de modification et de suppression des informations collectées par LookThis. Pour
                        exercer ce
                        droit, il reviendra à l’Utilisateur d’envoyer un message à l’adresse suivante :
                        LookThis@protonmail.com
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php

    // Génération du Footer:
    include(dirname(__FILE__).'/../views/templates/footer.php');

    ?>

    <!-- Bootstrap js -->
    <script src="/assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>
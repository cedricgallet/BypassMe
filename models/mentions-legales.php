<?php

// Initialiser la session
session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/../assets/img/favicon.ico">
    <!-- Lien css -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <!-- Lien bootstap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Mentions Légales</title>
</head>

<body>
<?php

// Génération du Header+Navbar:
include(dirname(__FILE__).'/../views/templates/navBar.php');

?>

    <div id="mentionPoli" class="d-flex align-items-center container-fluid h-100">
        <div class="card shadow rounded-3 mb-2 mt-2">
            <div class="card-body">
                <h2 class="card-title mb-3">
                    Mentions légales
                </h2>
                <p class="card-text"> Conformément aux dispositions de la loi n° 2004-575 du 21 juin 2004 pour la
                    confiance
                    en
                    l’économie numérique,
                    il est précisé aux utilisateurs du site LookThis l’identité des différents intervenants dans le
                    cadre de sa
                    réalisation et de son suivi.
                    Edition du site

                    Le site LookThis est édité par Cédric Gallet, inscrit en tant qu’auto-entrepreneur au RCS de
                    Toulon sous le
                    numéro de Siret 51194517200035.
                    Responsable de publication

                    Cédric Gallet
                    Hébergeur

                    Le site LookThis est hébergé par la société K Media Tech – https://www.wpxhosting.com/

                    Le stockage des données personnelles des Utilisateurs est exclusivement réalisé sur les centre
                    de données
                    (“clusters”) localisés dans des Etats membres de l’Union Européenne de la société K Media Tech.

                    Nous contacter

                    Par email : LookThis@protonmail.com

                    CNIL

                    Le représentant de ce site s’engage à conserver dans ses systèmes informatiques et dans des
                    conditions
                    raisonnables de sécurité une preuve de la transaction comprenant le bon de commande et la
                    facture.

                    Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée, l’Utilisateur dispose
                    d’un droit
                    d’accès, de modification et de suppression des informations collectées par LookThis. Pour
                    exercer ce
                    droit, il reviendra à l’Utilisateur d’envoyer un message à l’adresse suivante :
                    LookThis@protonmail.com
                </p>
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
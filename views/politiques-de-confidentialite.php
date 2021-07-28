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
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <!-- Lien css -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <!-- Lien bootstap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>Politique de confidentialité</title>
</head>

<body>

<?php

    // Génération de la Navbar:
    include(dirname(__FILE__).'/../views/templates/navbar.php');

?>

<div id="mentionPoli" class="d-flex align-items-center container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-3 mb-2 mt-2">
                <div class="card-body">
                    <h2 class="card-title text-center mb-3">
                        - Politiques de Confidentialité -
                    </h2>

                    <p class="card-text">Soucieux du respect de la vie privée de ses Utilisateurs, cédric Gallet
                        (ci-après le « Dirigeant») s’engage à assurer la protection des données personnelles de ses Utilisateurs.

                        Par conséquent, aucune donnée transmise par l’intermédiaire de notre site ne pourra être
                        consultée
                        par un tiers
                        non autorisé. Le Dirigeant prend toutes les précautions utiles pour préserver la sécurité de ces
                        données et
                        notamment, empêcher qu’elles soient déformées ou endommagées.

                        Le Dirigeant traite l’ensemble des données de ses Utilisateurs conformément à la présente
                        politique
                        de
                        confidentialité.
                    </p>

                    <h3>I. Définitions</h3>
                    <p class="card-text">

                        – donnée personnelle : toute information relative à une personne physique identifiée ou qui peut
                        être
                        identifiée, directement ou indirectement, par référence à un numéro d’identification ou à un ou
                        plusieurs
                        éléments qui lui sont propres.

                        – Utilisateur : toute personne physique majeure capable, ou toute personne morale, utilisant les
                        services qui
                        sont proposés sur le Site LookThis@protonmail.com, pouvant être soit un particulier, soit un professionnel.
                    </p>

                    <h3>II. Collecte et diffusion des données personnelles</h3>
                    <p class="card-text">

                        Le Dirigeant est susceptible de collecter des données personnelles liées à l’Utilisateur
                        notamment
                        lors :

                        – de la navigation sur le Site

                        – de la création d’un compte

                        – d’une demande de renseignement ou de prise de contact

                        – de la rédaction d’un commentaire

                        Les informations susceptibles d’être collectées par le Dirigeant sont celles ayant trait à
                        l’identité de
                        l’Utilisateur, à ses coordonnées postales et/ou électroniques, à un numéro de carte bancaire ou
                        encore à des
                        données de connexion.

                        Toutes les données à caractère personnel recueillies par le Dirigeant sont obligatoires et
                        nécessaires pour
                        bénéficier des Services proposés par le Dirigeant. Chaque donnée collectée par la Société est en
                        accord avec la
                        ou les finalités poursuivies.

                        L’ensemble des données personnelles ainsi recueillies par le Dirigeant peuvent être transmises à
                        des
                        prestataires extérieurs afin d’assurer le bon fonctionnement des Services, notamment le
                        traitement
                        effectif du
                        paiement. Lors d’un paiement en ligne, toutes les données personnelles transmises sont
                        protégées.
                    </p>

                    <h3>III. Conservation des données personnelles</h3>
                    <p class="card-text">

                        Les données personnelles de l’Utilisateur sont conservées jusqu’à leur suppression à la demande
                        de
                        l’Utilisateur
                        ou par la Société.

                        Le Dirigeant conservera dans ses systèmes informatiques et dans des conditions raisonnables de
                        sécurité une
                        preuve de la transaction comprenant le bon de commande et la facture conformément aux
                        dispositions
                        du Code de
                        commerce relatives à la durée de conservation des livres et documents créés à l’occasion
                        d’activités
                        commerciales et du Code de la consommation relatives à la conservation des contrats conclus par
                        voie
                        électronique, en l’occurrence dix ans.
                    </p>

                    <h3>IV. Hébergement des données personnelles</h3>
                    <p class="card-text">

                        Le site LookThis.com est hébergé par la société SiteGround.



                        Le stockage des données personnelles des Utilisateurs est exclusivement réalisé sur les centres
                        de
                        données («
                        clusters ») localisés dans des Etats membres de l’Union Européenne de la société SiteGround.
                    </p>

                    <h3>V. Droit d’accès et de suppression des données personnelles par l’Utilisateur</h3>
                    <p class="card-text">

                        Conformément aux dispositions de la loi 78-17 du 6 janvier 1978 modifiée, l’Utilisateur dispose
                        d’un
                        droit
                        d’accès aux informations collectées par le Dirigeant :

                        – l’Utilisateur peut demander à tout moment la modification de ses données

                        – l’Utilisateur peut demander à tout moment la rectification de données erronées

                        – l’Utilisateur peut demander à tout moment la suppression de données existantes

                        Pour exercer ce droit, il reviendra à l’Utilisateur d’envoyer un message à l’adresse suivante :
                        pierre.giraud@edhec.com.
                    </p>

                    <h3>VI. Utilisation de cookies</h3>
                    <p class="card-text">

                        Le Dirigeant informe l’Utilisateur qu’il peut être amené à utiliser des cookies. Ce dernier
                        accepte
                        expressément l’utilisation des cookies en poursuivant sa navigation sur le site.

                        Un cookie est un fichier texte susceptible d’être enregistré dans un terminal lors de la
                        consultation d’un
                        service en ligne avec un logiciel de navigation. Un fichier cookie permet à son émetteur,
                        pendant sa
                        durée de
                        validité, de reconnaître le terminal concerné à chaque fois que ce terminal accède à un contenu
                        numérique
                        comportant des cookies du même émetteur.
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
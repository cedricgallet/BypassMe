<!DOCTYPE html>
<html lang="fr">

<?php if ( empty(session_id()) ) session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/../assets/img/logo.png">
    <!-- Lien css -->
    <link href="/../assets/css/style.css" rel="stylesheet">
    <!-- Lien bootstap -->
    <link href="/../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href='http://fonts.googleapis.com/css?family=Allan:bold' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Cardo' rel='stylesheet' type='text/css'>
    <title>LookThis</title>
</head>

<body>

    <!-- =======================NAVBAR========================= -->

    <div class="container-fluid p-0">

        <nav class="navbar navbar-expand-lg navbar-dark border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="/../views/home.php">
                    <img src="/../assets/img/logo.png" alt="" width="70" height="70" class="d-inline-block">
                    LookThis
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class='nav-item'>
                            <a class='nav-link' href='/../views/home.php'>Accueil</a>
                        </li>

                        <li class='nav-item dropdown'>
                            <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                                data-bs-toggle='dropdown' aria-expanded='false'>
                                Catégories
                            </a>
                            <ul class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <li>
                                    <a class='dropdown-item'
                                        href='/../views/faille-applicative.php'>Faille-applicative</a>
                                </li>
                                <li>
                                    <hr class='dropdown-divider'>
                                </li>
                                <li><a class='dropdown-item' href='/../views/faille-humaine.php'>Faille-humaine</a>
                                </li>
                                <li>
                                    <hr class='dropdown-divider'>
                                </li>
                                <li><a class='dropdown-item' href='/../views/faille-reseaux.php'>Faille-réseaux</a>
                                </li>
                                <li>
                                    <hr class='dropdown-divider'>
                                </li>
                                <li><a class='dropdown-item' href='/../views/faille-reseaux.php'>Faille-web</a>
                                </li>
                            </ul>
                        </li>


                        <?php
                            if(isset($_SESSION['user'])) {
                                echo "<li class='nav-item'>
                                        <a class='nav-link' href='/../views/bonus.php'>Bonus</a>
                                    </li>";
                            }
                
                        ?>
                    </ul>

                    <!-- ======================================RECHERCHER========================================= -->

                    <form class="d-flex">
                        <input class="form-control rounded-pill me-2 mb-2" type="search" placeholder="xss,mitm,.."
                            aria-label="Search">
                        <button class="btn btn-outline-warning btn-sm me-2" type="submit">Chercher</button>
                    </form>

                    <ul id='logoutLogin' class='nav navbar-nav navbar-right text-white h-100'>

                        <!-- =========================================AFFICHAGE BOUTON SE DECONNECTER ET MON ESPACE================================ -->

                        <?php
                        // si la session n'existe pas
                        if(!isset($_SESSION['user'])){
                            echo " <li>
                                    <a href='/../controllers/login-ctrl.php'
                                        class='bottom text-decoration-none rounded-pill'>
                                        Se connecter</a>
                                        

                                    <a href='/../controllers/registration-ctrl.php'
                                        class='bottom text-decoration-none rounded-pill'>
                                        Inscription
                                    </a>
                                </li>";
                        } else {
                                // Si la session existe on affiche  
                            echo "<li>
                                    <a href='/../controllers/logout-ctrl.php'
                                    class='bottom text-decoration-none rounded-pill'>
                                    ".$_SESSION['user']['pseudo']."</a>
                                    

                                    <a href='/../controllers/landing-ctrl.php'
                                    class='bottom text-decoration-none rounded-pill'>
                                    Mon compte</a>
                                </li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- ==============================FIN NAVBAR===================================-->

    <!-- ==============================HEADER===================================-->
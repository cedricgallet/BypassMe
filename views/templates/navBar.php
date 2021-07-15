<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/../assets/img/favicon.ico">
    <!-- Lien css -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <!-- Lien bootstap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <title>lookThis</title>
</head>

<body>

    <!-- =======================DEBUT HEADER + NAVBAR========================= -->

    <header class="bg-body border-bottom">
        <nav class="navbar navbar-expand-lg sticky-top">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <img class="d-lg-none text-end" src="/assets/img/logo.png" height="40" width="40">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto w-75 align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="/../index.php">Accueil</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                aria-expanded="false">Catégories</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/views/faille-applicative.php">Faille-applicative</a>
                                </li>
                                <li><a class="dropdown-item" href="/views/faille-humaine.php">Faille-humaine</a></li>
                                <li><a class="dropdown-item" href="/views/faille-reseaux.php">Faille-reseaux</a></li>
                                <li><a class="dropdown-item" href="/views/faille-web.php">Faille-web</a>
                                </li>
                            </ul>
                        </li>
                        <!-- Logo: -->
                        <div><a href="/../index.php"><img class=" rounded-pill img-fluid d-none d-lg-block"
                                    src="/assets/img/logo.png" height="70" width="70"></a></div>
                        <li class="nav-item">
                            <a class="nav-link" href="/views/solutions.php">Solutions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="page-1.html">Bonus</a>
                        </li>
                    </ul>
                    <!-- ============================DEBUT CHAMP RECHERCHER============================ -->

                    <form class="d-flex">
                        <input class="form-control me-2 shadow" type="search" placeholder="xss,mitm,ect..."
                            aria-label="Search">
                        <button class="btn btn-outline-secondary rounded-pill me-2 text-white border-white"
                            type="submit">Rechercher</button>
                    </form>

                    <!-- ============================FIN CHAMP RECHERCHER============================ -->

                    <div><a class="nav-link rounded-pill text-white border border-white me-2 border-white"
                            href="/controllers/userConnexion-controllers.php">Connexion</a>
                    </div>
                    <div><a class="nav-link rounded-pill text-white border border-white border-white "
                            href="/controllers/addUserForm-controllers.php">S'inscrire</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- ==============================FIN NAVBAR===================================-->
    </header>
    <!-- =======================================FIN HEADER==================================== -->
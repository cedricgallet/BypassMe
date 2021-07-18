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
    <link href="/../assets/css/style.css" rel="stylesheet">
    <!-- Lien bootstap -->
    <link href="/../assets/css/bootstrap.min.css" rel="stylesheet">
    <title>LookThis</title>
</head>

<body>

    <!-- =======================DEBUT HEADER + NAVBAR========================= -->

    <header>
        <nav class="navbar navbar-expand-lg navbar-light border-bottom">
            <div class="container-fluid">
                <a class="navbar-brand" href="/../index.php">
                    <img src="/../assets/img/logo.png" alt="" width="35" height="35" class="d-inline-block">
                    LookThis
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/../index.php">Accueil</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Catégories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item"
                                        href="/../views/faille-applicative.php">Faille-applicative</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" 
                                        href="/../views/faille-humaine.php">Faille-humaine</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" 
                                        href="/../views/faille-reseaux.php">Faille-reseaux</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" 
                                        href="/../views/faille-reseaux.php">Faille-web</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#">Solutions</a>
                        </li>
                    </ul>

                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="xss,mitm,.."
                            aria-label="Search">
                        <button class="btn btn-outline-warning me-2" type="submit">Chercher</button>
                    </form>

                    <ul class="nav navbar-nav navbar-right text-white h-100">
                        <li>
                            <a href="/controllers/userConnexion-controllers.php"
                                class="bottom text-decoration-none rounded-pill">
                                Se connecter</a>

                            <a href="/controllers/addUserForm-controllers.php"
                                class="bottom text-decoration-none rounded-pill">
                                Inscription
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

            <!-- ==============================FIN NAVBAR===================================-->

    <!-- =======================================FIN HEADER==================================== -->
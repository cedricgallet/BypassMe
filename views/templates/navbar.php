<nav class="navbar navbar-expand-lg navbar-dark border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand" href="/../index.php">
            <img src="/../assets/img/logo.png" alt="logo représentant le site LooKthis" width="70" height="70"
                class="d-inline-block">
            LookThis
        </a>
        <!-- ==========================AVATAR============================= -->
        <div id="avatar">
            <img width="70" height="70" src=<?php 
                            echo (file_exists("/../uploads/avatars/" . 1 . ".png")) ? "/../uploads/avatars/" . 1 . ".png" : "/../uploads/avatars/empty.png";
                            ?> alt="avatar-default">
        </div>
        <!-- =================================================================== -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                        <li><a class="dropdown-item" href="/../views/faille-applicative.php">Faille-applicative</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li><a class="dropdown-item" href='/../views/faille-humaine.php'>Faille-humaine</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li><a class='dropdown-item' href='/../views/faille-reseaux.php'>Faille-réseaux</a></li>

                        <li>
                            <hr class='dropdown-divider'>
                        </li>

                        <li><a class='dropdown-item' href='/../views/faille-reseaux.php'>Faille-web</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/../controllers/comment-ctrl.php">Contact</a>
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

                <!-- ======================AFFICHAGE BOUTON SE DECONNECTER ET MON COMPTE================== -->

                <?php
                            // si la session n'existe pas
                            if(!isset($_SESSION['user']))
                            {
                                echo " <li>
                                        <a href='/../controllers/login-ctrl.php'
                                            class='bottom text-decoration-none rounded-pill'>
                                            Se connecter |</a>
                                            
                                        <a href='/../controllers/register-ctrl.php'
                                            class='bottom text-decoration-none rounded-pill'>
                                            S'inscrire
                                        </a>
                                    </li>";
                                    
                            } else {
                                    // Si la session existe on affiche  
                                echo "<li>
                                        <a href='/../controllers/logout-ctrl.php'
                                        class='bottom text-decoration-none rounded-pill'>
                                        Deconnexion |</a>
                                        
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
<!-- ==============================FIN NAVBAR===================================-->
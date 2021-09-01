<?php
require_once __DIR__.'/../views/templates/navbar.php';
?>

<div id="landingSpace" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-md-12 h-100">
            <div class="text-center h-100">
                <div><h2 class="p-5">Bonjour <?=$_SESSION['user']['pseudo'] ?> ! </h2></div>
                <div class="mb-4"><h2><?=$title ?? ''?></h2></div>

                <!-- Boutton -->

                <a href="/../controllers/logout-ctrl.php" class="btn btn-danger">Déconnexion</a>
                <a href="/../views/form/landingUpdatePassword.php" class="btn btn-info text-white">Changer
                    mon mot de passe</a>
                <a href="/../views/form/landingAddAvatar.php" class="btn btn-info text-white">Changer
                    mon avatar</a>
                <a href="/../views/home.php" class="btn btn-danger ">Accueil</a>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__.'/../views/templates/footer.php';
?>


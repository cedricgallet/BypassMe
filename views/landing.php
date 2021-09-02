<?php
require_once __DIR__.'/../views/templates/navbar.php';
?>

<div id="landingSpace" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-12 col-lg-12">
            <div class="text-center h-100">
                <div><h2 class="p-5">Bonjour <?=$_SESSION['user']['pseudo'] ?> ! </h2></div>
                <div class="mb-4"><h2><?=$title ?? ''?></h2></div>
            </div>
        </div>
        <!-- Boutton -->
        <div class="col-12 col-lg-6 d-flex flex-column align-items-center mt-5 h-100">
            <a href="/../views/home.php" class="boutton btn btn-danger mb-2">Accueil</a>
            <a href="/../views/form/landingUpdatePassword.php" class="boutton btn btn-info text-white mb-2">Changer
                mon mot de passe</a>
            <a href="/../views/form/landingAddAvatar.php" class="boutton btn btn-info text-white mb-2">Changer
                mon avatar</a>
                <a href="/../controllers/logout-ctrl.php" class="boutton btn btn-danger mb-2">Déconnexion</a>
                <a href="/../controllers/delete-ctrl.php" class="boutton btn btn-warning ">supprimer mon compte</a>
        </div>
        
        <div class="col-12 col-lg-6 d-flex justify-content-center mt-5 h-100">
            <div class="card" style="width: 20rem; height:30rem;">
                <img src="/../assets/img/membres/avatars/avatar1.jpeg" class="card-img-top" alt="avatar-personnel">
                <div class="card-body shadow">
                    <h4 class="card-title">Mes informations</h4>
                    <ul class="list-group list-group-flush">
                        <li class="text-info">Pseudo: <?=$_SESSION['user']['pseudo'] ?></li>
                        <li class="text-info">Email: <?=$_SESSION['user']['email'] ?></li>
                        <li class="text-info">IP: <?=$_SESSION['user']['ip'] ?></li>
                    </ul>   
                </div>
            </div>
        </div>        
    </div>
</div>

<?php
require_once __DIR__.'/../views/templates/footer.php';
?>


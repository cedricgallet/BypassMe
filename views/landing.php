<div id="landingSpace" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-12 col-lg-12">
            <div class="text-center h-100">
                <div><h2 class="pt-5 mb-3">Bonjour <?=$_SESSION['user']['pseudo'] ?> ! </h2></div>
                <div class="mb-5"><h2><?=$title ?? ''?></h2></div>
            </div>
        </div>
        <!-- Boutton -->
        <div class="col-12 col-lg-6 d-flex justify-content-center mt-3 h-100">
            <div class="card bg-transparent" style="width: 20rem; height:31rem;">
                <img src="/../assets/img/membres/avatars/avatar1.jpeg" class="card-img-top" alt="avatar-personnel">
                <div class="card-body">
                    <h4 class="card-title mb-0">Mes informations</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-info bg-transparent p-0">Pseudo: <?=$_SESSION['user']['pseudo'] ?></li>
                        <li class="list-group-item text-info bg-transparent p-0">Email: <?=$_SESSION['user']['email'] ?></li>
                        <li class="list-group-item text-info bg-transparent p-0">IP: <?=$_SESSION['user']['ip'] ?></li>
                    </ul>   
                </div>
            </div>        
        </div>
        
        <div class="col-12 col-lg-6 d-flex flex-column align-items-center mt-3 h-100">
        <a href="/../views/home.php" class="boutton btn btn-danger mb-2">Accueil</a>
            <a href="/../views/form/landingUpdatePassword.php" class="boutton btn btn-info text-white mb-2">Changer
                mon mot de passe</a>
            <a href="/../views/form/landingAddAvatar.php" class="boutton btn btn-info text-white mb-2">Changer
                mon avatar</a>
                <a href="/../controllers/logout-ctrl.php" class="boutton btn btn-danger mb-2">Déconnexion</a>
                <a href="/../controllers/delete-ctrl.php" class="boutton btn btn-warning ">supprimer mon compte</a>

            
        </div>        
    </div>
</div>



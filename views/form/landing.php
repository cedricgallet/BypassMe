<?php 
    session_start();//On demarre la session
    include(dirname(__FILE__).'/../../utils/config.php'); // ajout connexion bdd 
    include(dirname(__FILE__).'/../../views/templates/navbar.php'); // Génération du navbar:

   // si la session existe pas soit si l'utilisateur n'est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:/../views/form/login.php');
        die();
    }

    // On récupere les données de l'utilisateur
    $req = $bdd->prepare('SELECT * FROM users WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();
        
?>

<div id="landingSpace" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-md-12 h-100">
            <div class="text-center h-100">
                <h2 class="p-5">Bonjour <?php echo  $data['pseudo']; ?> ! Bienvenue sur ton espace personnel</h2>

                <!-- Boutton modal -->

                <a href="/../controllers/logout-ctrl.php" class="btn btn-danger">Déconnexion</a>

                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                    data-bs-target="#change_password">Changer
                    mon mot de passe</button>

                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#avatar">Changer
                    mon avatar</button>


                <a href="/../views/home.php" class="btn btn-danger ">Accueil</a>
            </div>
        </div>


        <!-- ======================================CHANGER MOT DE PASSE=================================== -->
        <!-- Modal -->
        <div class="col-md-12 p-0">
            <div class="modal fade" id="change_password" tabindex="-1" aria-labelledby="avatarLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="avatarLabel">Changer mon mot de passe</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="/../controllers/landingChange_password-ctrl.php" method="POST">
                                <div class="mb-3">
                                    <label for='current_password'>Mot de passe actuel</label>
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for='new_password'>Nouveau mot de passe</label>
                                    <input type="password" id="new_password" name="new_password" class="form-control"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label for='new_password_retype'>Confirmer le nouveau mot de passe</label>
                                    <input type="password" id="new_password_retype" name="new_password_retype"
                                        class="form-control" required>
                                    <button type="submit" class="btn btn-success mt-2">Sauvegarder</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===================================CHANGER AVATAR ================================= -->


        <div class="col-md-12 p-0">
            <div class="modal fade" id="avatar" tabindex="-1" aria-labelledby="avatarLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="avatarLabel">Changer mon avatar</h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="layouts/change_avatar.php" method="POST" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="avatar">Images autorisées : png, jpg, jpeg, gif - max 20Mo</label>
                                    <input type="file" name="avatar_file"
                                        accept="image/png, image/jpg, image/jpeg, image/gif">
                                    <button type="submit" class="btn btn-success mb-2">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <?php
// Génération du footer
include(dirname(__FILE__).'/../../views/templates/footer.php');
?>
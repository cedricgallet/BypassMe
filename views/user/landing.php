    <div id="landingSpace" class="container-fluid h-100 p-0">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-12">
                <div class="text-center h-100">
                    <?php
                    // si la session n'existe pas
                    if(isset($_SESSION['admin']))
                    {
                        ?>

                        <div><h2 class="pt-5 mb-3"><?='Bonjour'.' '. $_SESSION['admin']->pseudo ?> ! </h2></div>

                <?php } else { ?>

                        <div><h2 class="pt-5 mb-3"><?='Bonjour'.' '. $_SESSION['user']->pseudo ?> ! </h2></div>
                    
                                
                    <?php } ?>

                    <div class="mb-5"><h2><?=$title ?? ''?></h2></div>
                    <div><span id="horloge"></span></div>
                </div>
            </div>
        
            <div class="col-12 col-lg-6 mt-3 h-100">
                <div class="card bg-transparent" style="width: 20rem; height:31rem;">
                    <!-- +++++++++++++++++++++Affichage avatar+++++++++++++++++++++++++ -->
                    <div id= "avatar">
                        <img width="150" height="150" src =
                            <?php 
                            echo (file_exists("/../uploads/users/" . 1 . ".png")) ? "/../uploads/users/" . 1 . ".png" : "/../uploads/users/empty.png";
                            ?>
                            alt = "avatar par défault">
                    </div> 
                    <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                    <div class="card-body">
                            <h4 class="card-title mb-0">Mes informations</h4>
                            <!-- Boutton -->
                            <?php
                                // si la session n'existe pas
                        
                                if(isset($_SESSION['admin']))
                                {
                                    ?>

                                    <div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item text-info bg-transparent p-0">Pseudo: <?=$_SESSION['admin']->pseudo ?></li>
                                            <li class="list-group-item text-info bg-transparent p-0">Email: <?=$_SESSION['admin']->email ?></li>
                                            <li class="list-group-item text-info bg-transparent p-0">IP: <?=$_SESSION['admin']->ip ?></li>
                                        </ul>  
                                    <div>

                                    <?php } else { ?>
                                    <div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item text-info bg-transparent p-0">Pseudo: <?=$_SESSION['user']->pseudo ?></li>
                                            <li class="list-group-item text-info bg-transparent p-0">Email: <?=$_SESSION['user']->email ?></li>
                                            <li class="list-group-item text-info bg-transparent p-0">IP: <?=$_SESSION['user']->ip ?></li>
                                        </ul>  
                                    <div>
                                                        
                                        
                            <?php } ?>

                            
                        </div>
                    </div>
                </div>        
            </div>
                <?php
                // si la session n'existe pas
        
                if(isset($_SESSION['admin']))
                {
                    ?>

                        <div class="col-12 col-lg-6 mt-3 h-100">
                            <a href="/../index.php" class="boutton btn btn-danger mb-2">Accueil</a>

                            <a href="/../controllers/userUpdatePassword-ctrl.php" class="boutton btn btn-danger text-white mb-2">Modifier
                                mon mot de passe</a>
                                
                            <a href="/../controllers/userAddAvatar-ctrl.php" class="boutton btn btn-danger text-white mb-2">Modifier
                                mon avatar</a>

                            <a href="/../admin/controllers/list-user-ctrl.php" class="boutton btn btn-danger text-white mb-2">Ajouter/Modifier/supprimer
                            un utilisateur</a>

                            <a href="/../admin/controllers/add-article-ctrl.php" class="boutton btn btn-danger text-white mb-2">Ajouter/Modifier/supprimer
                            un article</a>

                            <a href="/../admin/controllers/add-comment-ctrl.php" class="boutton btn btn-danger text-white mb-2">Ajouter/Modifier
                            un commentaire</a>

                            <a href="/../controllers/signOut-ctrl.php" class="boutton btn btn-danger mb-2">Déconnexion</a>
                        </div>   

                    <?php } else { ?>

                        <div class="col-12 mt-3 h-100">
                            <a href="/../index.php" class="boutton btn btn-danger mb-2">Accueil</a>

                            <a href="/../controllers/userUpdatePassword-ctrl.php" class="boutton btn btn-danger text-white mb-2">Modifier
                                mon mot de passe</a>
                                
                            <a href="/../controllers/userAddAvatar-ctrl.php" class="boutton btn btn-danger text-white mb-2">Ajouter/Modifier
                                mon avatar</a>
                                <a href="/../controllers/signOut-ctrl.php" class="boutton btn btn-danger mb-2">Déconnexion</a>
                        </div>   
                                        
                        
            <?php } ?>

        </div>
    </div>




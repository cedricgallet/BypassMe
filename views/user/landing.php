<div id="landingSpace" class="container-fluid h-100">
    <div class="row justify-content-center">
        <div><h2 class="text-center mt-5"><?='Bonjour'.' '. $_SESSION['user']->pseudo ?> ! </h2></div>
            <div class="text-center"><h2><?=$title ?? ''?></h2></div>

        <div class="col-12 col-lg-6 h-100">
            <div class="card rounded-2">    
                <div class="card-body">
                    <div class="card-header text-center"><strong><?=$_SESSION['user']->pseudo?></strong></div>

                        <p class="card-text"><strong>Email - </strong>
                            <?=htmlentities($_SESSION['user']->email)?>
                        </p>

                        <p class="card-text"><strong>Ip - </strong>
                            <?=htmlentities($_SESSION['user']->ip)?>
                        </p>

                        <p class="card-text"><strong>Ajouté -</strong>
                        <?=htmlentities(date('d-m-Y', strtotime($_SESSION['user']->created_at)))?>
                        </p> 

                    </div>    
                </div>
            </div>
        </div>
        
        <div class="d-flex justify-content-center col-12 col-lg-6 w-100">

            <?php
                // si l'admin est connecté
                if(isset($_SESSION['user']))
                {
                    if ($_SESSION['user']->email == DEFAULT_EMAIL && isset($_SESSION['user']->password) == DEFAULT_PASSWORD) {
                
                
                ?>

                    <a href="/../index.php" class="m-2 boutton btn btn-danger mb-2">Accueil</a>

                    <a href="/../controllers/userUpdatePassword-ctrl.php" class="m-2 boutton btn btn-danger text-white mb-2">Modifier
                        mon mot de passe</a>
                        
                    <a href="/../controllers/userAddAvatar-ctrl.php" class="m-2 boutton btn btn-danger text-white mb-2">Modifier
                        mon avatar</a>

                    <a href="/../admin/controllers/list-user-ctrl.php" class="m-2 boutton btn btn-danger text-white mb-2">Ajouter/Modifier/supprimer
                    un utilisateur</a>

                    <a href="/../admin/controllers/list-article-ctrl.php" class="m-2 boutton btn btn-danger text-white mb-2">Ajouter/Modifier/supprimer
                    un article</a>

                    <a href="/../admin/controllers/list-comment-ctrl.php" class="m-2 boutton btn btn-danger text-white mb-2">Ajouter/Modifier/supprimer
                    un commentaire</a>

                    <a href="/../controllers/signOut-ctrl.php" class="m-2 boutton btn btn-danger mb-2">Déconnexion</a>


                <?php } else { ?>

                    <a href="/../index.php" class="m-2 boutton btn btn-danger mb-2">Accueil</a>

                    <a href="/../controllers/userUpdatePassword-ctrl.php" class="m-2 boutton btn btn-danger text-white mb-2">Modifier
                        mon mot de passe</a>
                        
                    <a href="/../controllers/userAddAvatar-ctrl.php" class="m-2 boutton btn btn-danger text-white mb-2">Modifier
                    mon avatar</a>

                    <a href="/../controllers/commentForm-ctrl.php" class="m-2 boutton btn btn-danger mb-2">Commenter</a>

                    <a href="/../controllers/signOut-ctrl.php" class="m-2 boutton btn btn-danger mb-2">Déconnexion</a>
                            
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>





        
        
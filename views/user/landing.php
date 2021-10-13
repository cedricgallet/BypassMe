<div id="landingSpace" class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <!-- +++++++++++++++++++++++++MODALE CONFIRMATION DESACTIVATION+++++++++++++++ -->
        <div id="id01" class="modal">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">×</span>

            <form class="modal-content" action="/../../admin/controllers/delete-user-ctrl.php?id=<?=htmlentities($user->id)?>;">
                <div class="container">
                    <h1>Désactiver le compte ?</h1>
                        <p>Etes-vous sûr de vouloir désactiver ce compte?</p>
                
                    <div class="clearfix">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Abandonner</button>
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="deletebtn">Désactiver</button>
                    </div>
                </div>
            </form>
        </div>

        <div><h2 class="text-center mt-5"><?='Bonjour'.' '. $_SESSION['user']->pseudo ?> ! </h2></div>
            <div class="text-center"><h2><?=$title ?? ''?></h2></div>

        <div class="col-12 col-lg-6">

            <div class="card rounded-2">
                <!-- +++++++++++++++++++++Affichage avatar+++++++++++++++++++++++++ -->
                <div id= "avatar">
                    <img width="150" height="150" src =
                        <?php 
                        echo (file_exists("/../uploads/users/" . 1 . ".jpeg")) ? "/../uploads/users/" . 1 . ".jpeg" : "/../uploads/users/empty.jpeg";
                        ?>
                        alt = "avatar par défault">
                </div>
            
                <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    
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
        
        <div class="col-12 col-lg-6">

            <?php
                // si la session n'existe pas
                if(isset($_SESSION['user']->email) == DEFAULT_EMAIL && isset($_SESSION['user']->password) == DEFAULT_PASSWORD)
                {
            ?>

                <a href="/../index.php" class="boutton btn btn-danger mb-2">Accueil</a>

                <a href="/../controllers/userUpdatePassword-ctrl.php" class="boutton btn btn-danger text-white mb-2">Modifier
                    mon mot de passe</a>
                    
                <a href="/../controllers/userAddAvatar-ctrl.php" class="boutton btn btn-danger text-white mb-2">Modifier
                    mon avatar</a>

                <a href="/../admin/controllers/list-user-ctrl.php" class="boutton btn btn-danger text-white mb-2">Ajouter/Modifier/supprimer
                un utilisateur</a>

                <a href="/../admin/controllers/list-article-ctrl.php" class="boutton btn btn-danger text-white mb-2">Ajouter/Modifier/supprimer
                un article</a>

                <a href="/../admin/controllers/add-comment-ctrl.php" class="boutton btn btn-danger text-white mb-2">Ajouter/Modifier/supprimer
                un commentaire</a>

                <a href="/../controllers/signOut-ctrl.php" class="boutton btn btn-danger mb-2">Déconnexion</a>
                <button onclick="document.getElementById('id01').style.display='block'">Open Modal</button>


            <?php } else { ?>

                <a href="/../index.php" class="boutton btn btn-danger mb-2">Accueil</a>

                <a href="/../controllers/userUpdatePassword-ctrl.php" class="boutton btn btn-danger text-white mb-2">Modifier
                    mon mot de passe</a>
                    
                <a href="/../controllers/userAddAvatar-ctrl.php" class="boutton btn btn-danger text-white mb-2">Modifier
                    mon avatar</a>
                    <a href="/../controllers/signOut-ctrl.php" class="boutton btn btn-danger mb-2">Déconnexion</a>

                    <button onclick="return confirmDisable();">Open Modal</button>

                            
                        
            <?php } ?>
        </div>
    </div>
</div>





        
        
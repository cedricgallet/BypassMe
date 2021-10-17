<div id="bgLanding" class="container-fluid h-100">
    <div class="row justify-content-center align-items-center h-100">

        <div class="col-12 text-center">

            <div><h2 class="text-center"><?='Bonjour'.' '. $_SESSION['user']->pseudo ?> ! </h2></div>
            <div class="text-center"><h2><?=$title ?? ''?></h2></div>
        </div>

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <div class="col-12 col-lg-4 bg-success">

            <?php
                // si l'admin est connecté
                if(isset($_SESSION['user']))
                {
                    $passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);//On vérifie le mdp  par défault avec le mdp en cours de session si oui ok

                    if($_SESSION['user']->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS)//Si la vérif est == aux constantes
                    {
                                            
                ?>
                    <div class="text-center">
                        <a href="/../index.php" class="m-2 boutton btn card-header border mb-2">Accueil</a>

                        <a href="/../controllers/signOut-ctrl.php" class="bg-dark m-2 boutton btn text-danger border mb-2">Déconnexion</a>
                    </div>

                <?php } else { ?>

                    <div class="text-center">
                        <a href="/../index.php" class="bg-dark m-2 boutton btn card-header border mb-2">Accueil</a>
                            
                        <a href="/../controllers/commentForm-ctrl.php" class="bg-dark m-2 boutton btn card-header border mb-2">Commenter</a>

                    </div>
                        
                <?php } ?>
            <?php } ?>
        </div>

        <div class="col-12 col-lg-4">

            <div class="card rounded-2">    
                <div class="card-body">
                    <div class="text-center card-header"><strong><?=$_SESSION['user']->pseudo?></strong></div>

                        <p class="mt-2 card-text"><strong>Email - </strong>
                            <?=htmlentities($_SESSION['user']->email)?>
                        </p>

                        <p class="card-text"><strong>Ip - </strong>
                            <?=htmlentities($_SESSION['user']->ip)?>
                        </p>

                        <p class="card-text"><strong>Status - </strong>
                            <strong><?=htmlentities($_SESSION['user']->state)?></strong> (activé = 1/désactivé = 0)
                        </p>

                        <p class="card-text"><strong>Ajouté le </strong>
                            <?=htmlentities(date('d-m-Y', strtotime($_SESSION['user']->created_at)))?>
                        </p> 

                        <p class="card-text"><strong>Dernière modification le </strong>
                            <?=htmlentities(date('d-m-Y', strtotime($_SESSION['user']->updated_at)))?>
                        </p> 

                    </div>    
                </div>
            </div>
            <div class="col-12 col-lg-4 bg-success">
            <?php
                // si l'admin est connecté
                if(isset($_SESSION['user']))
                {
                    $passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);//On vérifie le mdp en cours avec le mdp par défault si oui ok

                    if($_SESSION['user']->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS)//Si la vérif est == aux constantes
                    {
                                            
                    ?>
                        <div class="text-center">

                            <a href="/../controllers/userUpdateProfil-ctrl.php" class="bg-dark m-2 boutton btn card-header border text-white mb-2">Modifier
                                mes informations</a>
                                
                            <a href="/../admin/controllers/list-user-ctrl.php" class="bg-dark m-2 boutton btn card-header border text-white mb-2">Ajouter/Modifier/supprimer
                            un utilisateur</a>

                            <a href="/../admin/controllers/list-article-ctrl.php" class="bg-dark m-2 boutton btn card-header border text-white mb-2">Ajouter/Modifier/supprimer
                            un article</a>

                            <a href="/../admin/controllers/list-comment-ctrl.php" class="bg-dark m-2 boutton btn card-header border text-white mb-2">Ajouter/Modifier/supprimer
                            un commentaire</a>

                        </div>

                <?php } else { ?>

                        <div class="text-center">

                            <a href="/../controllers/userUpdateProfil-ctrl.php" class="bg-dark m-2 boutton btn card-header border text-white mb-2">Modifier
                                mes informations</a>
                                
                            <a href="/../controllers/signOut-ctrl.php" class="bg-dark m-2 boutton btn text-danger border mb-2">Déconnexion</a>

                        </div>
                        
                <?php } ?>
                <?php } ?>
            </div>

            <div class="col-12 bg-success text-center">
                <a href="/../controllers/signOut-ctrl.php" class="bg-dark m-2 boutton btn text-danger border mb-2" onclick="return confirmDeleteYourAccount();">Désactiver mon compte</a>

                <a href="/../controllers/commentForm-ctrl.php" class=" bg-dark m-2 boutton btn text-danger border mb-2" onclick="return confirmDisableYourAccount();">Supprimer mon compte</a>

            </div>
        </div>
    </div>
</div>





        
        
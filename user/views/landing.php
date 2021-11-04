<div id="bgLanding" class="container-fluid h-100 p-0">    
    <div class="row">

        <!-- ******************Affichage d'un message d'erreur personnalisé******************* -->
        <?php 

        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
            if(!array_key_exists($msgCode, $displayMsg)){
                $msgCode = 0;
            }
            echo '<div class="fs-5 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
        } 
        ?>
        <!-- ********************************************************************************** -->

        <div class="col-12 text-center">
            
            <div><h2 class="text-center mt-5"><?='Bonjour'.' '. $user->pseudo ?> ! </h2></div>
            <div class="text-center mb-5"><h2><?=$title ?? ''?></h2></div>
        </div>

        <div class="d-flex justify-content-around col-12 mt-5 bg-dark border" style="height: 200px;">
            <?php
            // si 
            if(isset($_SESSION['user']))
            {
                    //On check si l'admin est connecté en vérifiant que le mdp par défault(constante) est le meme que le mdp en bdd
                    $passDefault =  password_verify(DEFAULT_PASS, $user->password);

                    if($user->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS) 
                    {
                 
                    ?>
                    
                    <div class="d-flex align-items-center">
                        <a href="/../index.php" class="m-2 boutton btn text-white mb-2 border">Accueil</a>

                        <a href="/../user/controllers/userUpdateProfil-ctrl.php?id=<?=htmlentities($user->id)?>" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Modifier
                                mon profil</a>
                    </div>

                    <div class="d-flex align-items-center">                               
                        <a href="/../admin/controllers/list-user-ctrl.php" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Ajouter/Modifier/Désactiver/supprimer
                        un utilisateur</a>

                        <a href="/../admin/controllers/list-article-ctrl.php" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Ajouter/Modifier/Désactiver/supprimer
                        un article</a>

                        <a href="/../admin/controllers/list-message-ctrl.php" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Ajouter/Modifier/Désactiver/supprimer
                        un message</a>

                        <a href="/../admin/controllers/list-comment-ctrl.php" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Ajouter/Modifier/Désactiver/supprimer
                        un commentaire</a>

                        <a href="/../user/controllers/signOut-ctrl.php" class="bg-dark m-2 boutton btn text-danger border mb-2">Déconnexion</a>

                    </div>


                <?php } else { ?>

                    <div class="text-center">
                        <a href="/../index.php" class="bg-dark m-2 boutton btn text-white border mb-2">Accueil</a>
                            
                        <a href="/../user/controllers/add-message-ctrl.php?id=<?=htmlentities($user->id)?>" class="bg-dark m-2 boutton btn text-success border mb-2">Contacter</a>
                    </div>

                    <div class="text-center">
                        <a href="/../user/controllers/userUpdateProfil-ctrl.php?id=<?=htmlentities($user->id);?>" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Modifier
                            mon profil</a>
                            
                        <a href="/../user/controllers/signOut-ctrl.php" class="bg-dark m-2 boutton btn text-danger border mb-2">Déconnexion</a>
                    </div>
                        
                <?php } ?>
            <?php } ?>
        </div>

        <div id="signUpForm" class="d-flex justify-content-center col-12 mt-5">

            <div class="card rounded-2">
                <div class="card-body">

                    <p class="d-flex card-text card-header text-center justify-content-start">Pseudo -> 
                        <?=htmlentities($user->pseudo)?>    
                    </p>

                    <p class="mt-3 card-text text-center"><strong>Email - </strong>
                        <?=htmlentities($user->email)?>
                    </p>

                    <p class="card-text text-center"><strong>Ip - </strong>
                        <?=htmlentities($user->ip)?>
                    </p>

                    <hr class="text-dark">

                    <p class="card-text m-0"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y à H:i', strtotime($user->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y à H:i', strtotime($user->updated_at)))?>          
                    </p>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center align-items-center col-12 mt-5 bg-dark border" style="height: 200px;">
            <div class="col-12 text-center">
                <a href="/../admin/controllers/disableContent-ctrl.php?id=<?=htmlentities($user->id);?>" class="bg-dark m-2 boutton btn text-danger border mb-2" onclick="return confirmDisableYourAccount();">Désactiver mon compte</a>

                <a href="/../admin/controllers/message-ctrl.php?id=<?=htmlentities($user->id);?>" class="bg-dark m-2 boutton btn text-danger border mb-2" onclick="return confirmDeleteYourAccount();"><strong>Supprimer mon compte</strong></a>
            </div>
        </div>
    </div>
</div>

<!-- ********************************************* -->
<script src="/../assets/js/checkConfirm.js"></script>



        
        
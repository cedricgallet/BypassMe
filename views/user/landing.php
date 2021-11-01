<div id="" class="container-fluid h-100 p-0">    
    <div class="row h-100">

        <!-- ******************Affichage d'un message d'erreur personnalisé******************* -->
        <?php 

        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
            if(!array_key_exists($msgCode, $displayMsg)){
                $msgCode = 0;
            }
            echo '<div class="fs-3 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
        } 

        ?>
        <!-- ********************************************************************************** -->

        <div class="col-12 text-center">
            
            <div><h2 class="text-center mt-5"><?='Bonjour'.' '. $user->pseudo ?> ! </h2></div>
            <div class="text-center"><h2><?=$title ?? ''?></h2></div>
        </div>

        <div class="col-12 col-lg-4">
            <?php
            // si l'admin est connecté
            if(isset($_SESSION['user']))
            {
                    //On check si le mdp par défault est le meme que le mdp en cours
                    $passDefault =  password_verify(DEFAULT_PASS, $user->password);

                    if($user->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS) 
                    {
                 
                    ?>
                    

                    <div class="text-center">
                        <a href="/../index.php" class="m-2 boutton btn text-success border mb-2">Accueil</a>

                        <a href="/../controllers/userUpdateProfil-ctrl.php?id=<?=htmlentities($user->id)?>" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Modifier
                                mon profil</a>

                        <a href="/../controllers/signOut-ctrl.php" class="bg-dark m-2 boutton btn text-danger border mb-2">Déconnexion</a>
                    </div>


                <?php } else { ?>


                    <div class="text-center">
                        <a href="/../index.php" class="bg-dark m-2 boutton btn text-white border mb-2">Accueil</a>
                            
                        <a href="/../controllers/add-message-ctrl.php?id=<?=htmlentities($user->id)?>" class="bg-dark m-2 boutton btn text-success border mb-2">Contacter</a>

                    </div>
                        
                <?php } ?>
            <?php } ?>
        </div>

        <div class="col-12 col-lg-4">

            <div class="card rounded-2">
                <div class="mt-3 ms-3">

                    <!-- **************************Status******************************** -->
                    <?php
                      if ($user->state == 0) {                    
                  ?>

                        <div class='fs-5 card-text text-warning text-start me-1'><strong>Status de l'utilisateur > </strong> <strong
                                class="text-danger">DÉSACTIVÉ</strong>
                        </div>

                        <?php } else { ?>

                        <div class='fs-5 card-text text-warning text-start me-1'><strong>Status de l'utilisateur > </strong> <strong
                                class="text-success">ACTIVÉ</strong>
                        </div>

                        <?php } ?>
                    <!-- ************************************************************** -->
                    
                </div>

                <div class="card-body">

                    <p class="card-text card-header text-center">Pseudo -> 
                        <?=htmlentities($user->pseudo)?>    
                    </p>

                    <p class="mt-3 card-text"><strong>Email - </strong>
                        <?=htmlentities($user->email)?>
                    </p>

                    <p class="card-text"><strong>Ip - </strong>
                        <?=htmlentities($user->ip)?>
                    </p>

                    <p class="card-text"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y à H:i', strtotime($user->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y à H:i', strtotime($user->updated_at)))?>          
                    </p>
                </div>
            </div>






            <div class="id-card-wrapper">
                <div class="id-card">
                    <div class="profile-row">
                        <div class="dp">
                            <div class="dp-arc-outer"></div>
                            <div class="dp-arc-inner"></div>
                            <img src="/../assets/img/logo.png" alt="avatar choisi par l'utilisateur">
                        </div>
                        <div class="desc">
                            <h1>Tony Stark</h1>
                                <p>Strength: Ironman Suit</p>
                                <p>Weakness: None</p>
                                <p>Known as: Iron Man</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-12 col-lg-4">
            <?php
                // Si c'est un admnin qui est connecté
                if(isset($_SESSION['user']))
                {

                    //On check si le mdp par défault est le meme que le mdp en cours
                    $passDefault =  password_verify(DEFAULT_PASS, $user->password);

                    if($user->email == DEFAULT_EMAIL && $passDefault == DEFAULT_PASS) 
                    {
                                            
                        ?>
                        <div class="text-center">
                                
                            <a href="/../admin/controllers/list-user-ctrl.php" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Ajouter/Modifier/supprimer
                            un utilisateur</a>

                            <a href="/../admin/controllers/list-article-ctrl.php" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Ajouter/Modifier/supprimer
                            un article</a>

                            <a href="/../admin/controllers/list-message-ctrl.php" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Ajouter/Modifier/supprimer
                            un message</a>

                            <a href="/../admin/controllers/list-comment-ctrl.php" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Ajouter/Modifier/supprimer
                            un commentaire</a>

                        </div>

                        <!-- ******************************Si c'est un utilisateur qui est connecté**************************** -->
                    <?php } else { ?>

                        <div class="text-center">

                            <a href="/../controllers/userUpdateProfil-ctrl.php?id=<?=htmlentities($user->id);?>" class="bg-dark m-2 boutton btn btnLanding border text-white mb-2">Modifier
                                mon profil</a>
                                
                            <a href="/../controllers/signOut-ctrl.php" class="bg-dark m-2 boutton btn text-danger border mb-2">Déconnexion</a>

                        </div>
                        
                <?php } ?>
                <?php } ?>
            </div>

            <div class="col-12 text-center">
                <a href="/../admin/controllers/disableAccount-ctrl.php?id=<?=htmlentities($user->id);?>" class="bg-dark m-2 boutton btn text-danger border mb-2" onclick="return confirmDisableYourAccount();">Désactiver mon compte</a>

                <a href="/../admin/controllers/message-ctrl.php" class="bg-dark m-2 boutton btn text-danger border mb-2" onclick="return confirmDeleteYourAccount();"><strong>Supprimer mon compte</strong></a>

            </div>
        </div>
    </div>
</div>

<!-- ********************************************* -->
<script src="/../assets/js/checkConfirm.js"></script>



        
        
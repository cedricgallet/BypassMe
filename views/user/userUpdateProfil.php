<!-- ***************************************UPDATE PROFIL*************************************** -->
<div id="bgLanding" class="container-fluid h-100 p-0">
        <div class="row justify-content-center">

            <!-- Affichage d'un message d'erreur personnalisé -->
            <?php 

                require_once(dirname(__FILE__).'/../../config/config.php');//Constante + Gestion erreur

                if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                    if(!array_key_exists($msgCode, $displayMsg)){
                        $msgCode = 0;
                    }
                    echo '<div class="fs-4 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                } 

            ?>

            <h2 class="d-flex justify-content-center align-items-center mt-5 mb-5"><?=$title ?? ''?></h2>


            <div class="col-lg-3 mb-5">                   
                <form id="signUpForm" class="border needs-validation rounded-3 p-2" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">

                    <!-- *******************************CHAMP PSEUDO**********************************== -->

                    <div class="mb-3">
                        <label for="pseudo" class="col-form-label text-warning">Pseudo*</label>

                        <input type="text" 
                                name="pseudo" 
                                id="pseudo" 
                                class="form-control text-info bg-transparent"
                                title="Le pseudo ne doit pas contenir les caractères suivant: > <"
                                autocomplete="given-name"
                                value="<?= htmlentities($pseudo ?? '')?>"
                                pattern="<?=REGEX_PSEUDO?>" required>

                    </div>
                    <div class="invalid-feedback-2"><?=htmlentities($errorsArray['pseudo'] ?? '')?></div>
                

                    <!-- *******************************CHAMP EMAIL**********************************== -->

                    <div class="mb-3">
                    <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                        <input type="email" 
                                name="email" 
                                class="form-control text-info bg-transparent" 
                                id="email" 
                                aria-describedby="emailHelp" 
                                autocomplete="email"
                                value="<?= htmlentities($email ?? '')?>" required>
                    </div>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['email'] ?? '')?></div>
                
                    <!-- **********************************CHAMP MOT DE PASSE ACTUEL******************************* -->

                    <div class="mb-3">
                        <label for='current_password' class="col-form-label text-warning">Mot de passe actuel*</label>                       
                        <input type="password" 
                                id="current_password" 
                                name="current_password"
                                class="form-control text-info bg-transparent" required>
                    </div>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['current_password'] ?? '')?></div>

                    <!-- **********************************CHAMP NOUVEAU MOT DE PASSE******************************* -->

                    <div class="mb-3">
                        <label for='new_password' class="col-form-label text-warning">Nouveau mot de passe*</label>
                        <input type="password" 
                                id='errPass1'    
                                name="new_password" 
                                class="form-control text-info bg-transparent"
                                required>
                    </div>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['new_password'] ?? '')?></div>

                    <!-- **********************************CHAMP NOUVEAU MOT DE PASSE CONFIRMATION******************************* -->

                    <div class="mb-3">
                        <label for='new_password2' class="col-form-label text-warning">Confirmer le nouveau mot de passe*</label>
                        <input type="password" 
                                id='errPass2' 
                                name="new_password2"
                                class="form-control text-info bg-transparent" 
                                required>
                        <div class="invalid-feedback-2"><?= htmlentities($errorsArray['new_password2'] ?? '')?></div>

                    <!-- ***************************************CHANGER AVATAR********************************** -->

                    <div class="mt-3">
                        <form class="border" method="POST" action="" enctype="multipart/form-data">
                            <div class="upload-wrapper">
                                <span class="w-50 file-name">Images autorisées :<hr> png, jpeg - 2Mo Max</span>
                                <label class="w-50 d-flex justify-content-center align-items-center" for="file-upload">Choisir un avatar ?<input type="file" id="file-upload" name="profile"></label>
                            </div>
                        </form>
                    </div>

                    <!-- **************************************************************************************** -->

                    <div class="d-flex justify-content-center align-items-center">
                        <button type="submit" 
                                class="btn card-header border mt-3">Mettre a jour mon profil ?</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- ************************************************* -->
<script src="/../assets/js/checkPass.js"></script>
<script src="/../assets/js/checkValidation.js"></script>
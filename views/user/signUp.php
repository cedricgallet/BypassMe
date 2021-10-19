<!-- ==============================FORMULAIRE INSCRIPTION============================= -->

<div id="signUpForm" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="d-flex justify-content-end align-items-center  col-12 login-wrap h-100">        

            <!-- =============================CHAMP PSEUDO=============================== -->
            <div class="signUpForm card bg-transparent col-12 col-lg-3">                            
            
                <div class=""><h2 class=""><?=$title ?? ''?></h2>
                </div>

                <!-- Affichage d'un message d'erreur personnalisé -->
                <?php 

                if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                    if(!array_key_exists($msgCode, $displayMsg)){
                        $msgCode = 0;
                    }
                    echo '<div class="fs-3 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                } 

                ?>

                <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                    <input type="hidden" value="<?= htmlentities($id ?? '') ?>" class="form-control" id="id" name="id">

                    <div class="form-outline">
                    <label for="pseudo" class="col-form-label text-warning">Pseudo*</label>

                        <input type="text" 
                                name="pseudo" 
                                id="pseudo" 
                                class="form-control text-info bg-transparent"
                                title="Le pseudo ne doit pas contenir les caractères suivant: > <"
                                placeholder="Entrez votre pseudo"
                                autocomplete="given-name"
                                value="<?= htmlentities($pseudo ?? '')?>"
                                pattern="<?=REGEX_PSEUDO?>" required>

                    </div>
                    <div class="invalid-feedback-2"><?=htmlentities($errorsArray['pseudo'] ?? '')?></div>
                

                    <!-- ===========================CHAMP EMAIL============================== -->

                    <div class="form-outline">
                    <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                        <input type="email" 
                                name="email" 
                                class="form-control text-info bg-transparent" 
                                id="email" 
                                aria-describedby="emailHelp" 
                                placeholder="Adresse e-mail" 
                                autocomplete="email"
                                value="<?= htmlentities($email ?? '')?>" required>
                    </div>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['email'] ?? '')?></div>

                    <!-- =============================CHAMP EMAIL CONFIRMATION=========================== -->

                    <div class="form-outline">
                    <label for="email2" class="col-form-label text-warning">Confirmation Email*</label>

                        <input type="email" 
                                name="email2" 
                                class="form-control text-info bg-transparent" 
                                id="email2"
                                aria-describedby="emailHelp" 
                                placeholder="Confirmez votre e-mail" 
                                autocomplete="email2"
                                value="<?= htmlentities($email2 ?? '')?>" required>
                    </div>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['email2'] ?? '')?></div>
                
                    <!-- ==========================CHAMP MOT DE PASSE========================== -->
                
                    <div class="form-outline">
                    <label for="password" class="col-form-label text-warning">Mot de passe*</label>

                        <input type="password" 
                                name="password" 
                                class="form-control text-info bg-transparent" 
                                id="password"
                                placeholder="Votre mot de passe" 
                                autocomplete="new-password" 
                                minlength="8" 
                                maxlength="20" 
                                value="<?= htmlentities($password ?? '')?>" required>
                    </div>

                    <div class='invalid-feedback-2' id='errPass1'><?=htmlentities($errorsArray['password'] ?? '')?></div>

                    <!-- ============================CHAMP MOT DE PASSE CONFIRMATION======================= -->

                    <div class="form-outline">
                    <label for="password2" class="col-form-label text-warning">Confirmation mot de passe*</label>

                        <input type="password" 
                                name="password2" 
                                class="form-control text-info bg-transparent" 
                                id="password2"
                                placeholder="Confirmez votre mot de passe" 
                                autocomplete="new-password" 
                                minlength="8"
                                maxlength="20"
                                value="<?= htmlentities($password2 ?? '')?>" required>
                    </div>
                    <div class='invalid-feedback-2' id='errPass2'><?=htmlentities($errorsArray['password2'] ?? '')?></div>                    
                
                    <!-- ++++++++++++++++++++++Ajout avatar+++++++++++++++++++++++++++ -->
                    <div class="mt-2 upload-wrapper">
                        <span class="w-50 file-name">Images autorisées :<hr> png, jpeg - 2Mo Max</span>
                        <label class="d-flex justify-content-center align-items-center w-50" for="file-upload">Choisir un avatar<input type="file" id="file-upload" name="uploadedFile"></label>
                    </div>
                    

                    <div class="form-outline mt-4 mb-5">
                        <button id="btnSubmit" 
                                type="submit" 
                                class="form-control btn card-header border submit px-3 rounded-pill">Créer mon compte</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- ===============================FIN INSCRIPTION============================= -->
<script src="/../assets/js/checkPass.js"></script>
<script src="/../../assets/js/checkValidation.js"></script>
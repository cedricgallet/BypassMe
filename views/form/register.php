<!-- ==============================FORMULAIRE INSCRIPTION============================= -->

    <div id="signInForm" class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="d-flex flex-column col-12 col-lg-4">
                <h2 class="mt-5"><?=$title ?? ''?></h2>
                <div class="login-wrap p-0">

                <!-- Affichage d'un message d'erreur personnalisé -->
                <?php 
                if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                    if(!array_key_exists($msgCode, $displayMsg)){
                        $msgCode = 0;
                    }
                    echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                } 

                ?>
                    <!-- =============================CHAMP PSEUDO=============================== -->

                    <form id="signUpForm" class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <input type="hidden" value="<?= $id ?? '' ?>" class="form-control" id="id" name="id">

                        <div class="form-outline">
                            <input type="text" 
                                    name="pseudo" 
                                    id="pseudo" 
                                    class="form-control"
                                    title="Le pseudo n' est pas au format attendu-Caractère interdit: > <"
                                    placeholder="Entrez votre pseudo"
                                    autocomplete="given-name"
                                    value="<?= htmlentities($_POST['pseudo'] ?? '')?>"
                                    pattern="<?=REGEX_PSEUDO?>" 'required>

                            <label for="pseudo" class="col-form-label text-warning">Pseudo*</label>

                            <div class="valid-feedback">Parfait!</div>
                            <div class="invalid-feedback">Merci de choisir un nom valide.</div>
                        </div>
                        <div class="text-danger"><?=htmlentities($errorsArray['pseudo'] ?? '')?></div>
                    

                        <!-- ===========================CHAMP EMAIL============================== -->

                        <div class="form-outline">
                            <input type="email" 
                                    name="email" 
                                    class="form-control" 
                                    id="email" 
                                    aria-describedby="emailHelp" 
                                    placeholder="Adresse e-mail" 
                                    autocomplete="email"
                                    value="<?= htmlentities($_POST['email'] ?? '')?>" 'required>
                            <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                            <div class="valid-feedback">Parfait!</div>
                            <div class="invalid-feedback">Merci de choisir un email valide.</div>
                        </div>
                        <div class="text-danger"><?= htmlentities($errorsArray['email'] ?? '')?></div>

                        <!-- =============================CHAMP EMAIL CONFIRMATION=========================== -->

                        <div class="form-outline">
                            <input type="email" 
                                    name="email2" 
                                    class="form-control" 
                                    id="email2"
                                    aria-describedby="emailHelp" 
                                    class="form-control" 
                                    placeholder="Confirmez votre e-mail" 
                                    autocomplete="email2"
                                    value="<?= htmlentities($_POST['email2'] ?? '')?>" 'required>
                            <label for="email2" class="col-form-label text-warning">Adresse Email*</label>

                            <div class="valid-feedback">Parfait!</div>
                            <div class="invalid-feedback">Merci de choisir un email valide.</div>
                        </div>
                        <div class="text-danger"><?= htmlentities($errorsArray['email2'] ?? '')?></div>
                    
                        <!-- ==========================CHAMP MOT DE PASSE========================== -->
                    
                        <div class="form-outline">

                            <input type="password" 
                                    name="password" 
                                    class="form-control" 
                                    id="password"
                                    placeholder="Votre mot de passe" 
                                    autocomplete="new-password" 
                                    minlength="8" 
                                    maxlength="20" 
                                    value="<?= htmlentities($_POST['password'] ?? '')?>" 'required>
                                    <label for="password" class="col-form-label text-warning">Mot de passe*</label>
                        </div>

                        <div class='text-danger' id='errPass1'><?=htmlentities($errorsArray['password'] ?? '')?></div>

                        <!-- ============================CHAMP MOT DE PASSE CONFIRMATION======================= -->

                        <div class="form-outline">

                            <input type="password" 
                                    name="password2" 
                                    class="form-control" 
                                    id="password2"
                                    placeholder="Confirmez votre mot de passe" 
                                    autocomplete="new-password" 
                                    minlength="8"
                                    maxlength="20"
                                    value="<?= htmlentities($_POST['password2'] ?? '')?>" 'required>
                                    <label for="password2" class="col-form-label text-warning">Confirmation mot de passe*</label>
                        </div>
                        <div class='text-danger' id='errPass2'><?=htmlentities($errorsArray['password2'] ?? '')?></div>
                        
                        
                        <div class="form-outline mt-4 mb-5">
                            <button id="btnSubmit" 
                                    type="submit" 
                                    class="form-control btn btn-outline-warning submit px-3 rounded-pill">Créer mon compte</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- ===============================FIN INSCRIPTION============================= -->
<script src="/assets/js/checkPass.js"></script>

<!-- ==========================================================FORMULAIRE INSCRIPTION========================================================= -->

<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgForm.jpg);">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-6">
        <h2 class="text-center">Inscription</h2>
            <div class="login-wrap p-0">
                
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="signin-form">

                    <!-- =============================================CHAMP PSEUDO=============================================== -->

                    <div class="form-group">
                        <label for="pseudo" class="col-form-label text-warning">Pseudo*</label>
                        <input type="text" name="pseudo" id="pseudo" title="Le pseudo n' est pas au format attendu"
                            placeholder="Entrez votre pseudo" class="form-control"
                            autocomplete="given-name"
                            value="<?= htmlentities($_POST['pseudo'] ?? '', ENT_QUOTES, 'UTF-8')?>"
                            pattern="<?=REGEX_PSEUDO?>" 'required>
                        <div class="text-danger"><?= htmlentities($error['pseudo'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                    </div>

                    <!-- ============================================CHAMP EMAIL=================================================== -->


                    <div class="form-group">
                        <label for="email" class="col-form-label text-warning">Adresse Email*</label>
                        <input type="email" name="email" class="form-control" id="email" class="form-control"
                            placeholder="Adresse e-mail" autocomplete="email"
                            value="<?= htmlentities($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8')?>" 'required>
                        <div class="text-danger"><?= htmlentities($error['email'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                    </div>

                    <!-- =====================================CHAMP EMAIL CONFIRMATION============================================== -->

                    <div class="form-group">
                        <label for="email2" class="col-form-label text-warning">Adresse Email*</label>
                        <input type="email" name="email2" class="form-control" id="email2"
                            class="form-control" placeholder="Confirmé votre e-mail" autocomplete="email2"
                            value="<?= htmlentities($_POST['email2'] ?? '', ENT_QUOTES, 'UTF-8')?>" 'required>
                        <div class="text-danger"><?= htmlentities($error['email2'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                    </div>

                    <!-- =======================================CHAMP MOT DE PASSE================================================== -->
                
                    <div class="form-group">
                        <label for="password" class="col-form-label text-warning">Mot de passe*</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Votre mot de passe" autocomplete="new-password" minlength="8" maxlength="20" 
                            value="<?= htmlentities($_POST['password'] ?? '',)?>" 'required>
                        <div class="text-danger"><?= htmlentities($error['password'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                    </div>

                    <!-- ================================CHAMP MOT DE PASSE CONFIRMATION============================================= -->

                    <div class="form-group">
                        <label for="password2" class="col-form-label text-warning">Confirmation mot de passe*</label>
                        <input type="password" name="password2" class="form-control" id="password2"
                            placeholder="Confirmé votre mot de passe" autocomplete="new-password" minlength="8"
                            maxlength="20"
                            value="<?= htmlentities($_POST['password2'] ?? '',)?>" 'required>
                        <div class="text-danger"><?= htmlentities($error['password2'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                    </div>
                    
                    
                    <div class="form-group mt-4">
                        <button type="submit" class="form-control btn btn-outline-warning submit px-3 rounded-pill">Connexion</button>
                    </div>
                    <div class="form-group d-md-flex mt-2">
                        <div class="w-50 justify-content-end">
                            <a class="text-decoration-none text-warning" href="/../controllers/findPassword-ctrl.php" >Mot de passe oublié?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================FIN FORMULAIRE================================================================================ -->
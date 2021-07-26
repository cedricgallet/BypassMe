<div id="bgImageConnexion" class="container-fluid" style="background-image: url(/../assets/img/bgConnexion.jpg);height:90%;">
    <div id="formPosition" class="row justify-content-center align-items-center h-100">
        <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">

                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="signin-form px-4 py-3">
                    <div class="form-group">
                        <label for="pseudo" class="form-label text-warning">Pseudo*</label>
                        <input type="text" name="pseudo" id="pseudo"
                            placeholder="Entrez votre pseudo" class="form-control rounded-pill"
                            autocomplete="given-name"
                            value="<?= htmlentities($_POST['pseudo'] ?? '', ENT_QUOTES, 'UTF-8')?>"
                            pattern="<?=REGEX_PSEUDO?>" 'required>
                        <div class="text-danger"><?= htmlentities($error['pseudo'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password1" class="form-label text-warning">Mot de passe*</label>
                        <input type="password" name="password1" class="form-control rounded-pill" id="password1"
                            placeholder="Votre mot de passe" autocomplete="new-password" maxlength="20" minlength="8"
                            value="<?= htmlentities($_POST['password1'] ?? '',)?>" 'required>
                        <div class="text-white">
                            <?= htmlentities($error['password1'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>

                    <div class="form-group mt-5">
                        <button type="submit" class="form-control btn btn-outline-warning submit px-3 rounded-pill">Connexion</button>
                    </div>

                    <div class="form-group d-md-flex mt-2">
                        <div class="w-50">
                            <label class="checkbox-wrap checkbox-warning text-decoration-none text-white">Se rappeller de moi?
                                <input type="checkbox" checked>
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <div class="w-50 text-md-end">
                            <a class="text-decoration-none text-white" href="/../controllers/findPasswordForm-controllers.php" >Mot de passe oublié?</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
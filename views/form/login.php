

<div id="bgImageConnexion" class="container-fluid" style="background-image: url(/../assets/img/bgForm.jpg);height:90%;">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-4">        
            <div class="login-wrap p-0">
            <h2 class="text-center">Connexion</h2>

                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="signin-form px-4 py-3">

                <div class="form-group">
                        <label for="email" class="col-form-label text-warning">Adresse Email*</label>
                        <input type="email" name="email" class="form-control" id="email" class="form-control"
                            placeholder="Adresse e-mail" autocomplete="email"
                            value="<?= htmlentities($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8')?>" 'required>
                        <div class="text-danger"><?= htmlentities($error['email'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password" class="col-form-label text-warning">Mot de passe*</label>
                        <input type="password" name="password" class="form-control" id="password" 
                            placeholder="Votre mot de passe" autocomplete="off" minlength="8" maxlength="20" 
                            value="<?= htmlentities($_POST['password'] ?? '',)?>" 'required>
                        <div class="text-danger"><?= htmlentities($error['password'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                        
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="form-control btn btn-outline-warning submit px-3 rounded-pill">Connexion</button>
                    </div>

                    <div class="form-group d-md-flex mt-2">
                        <div class="">
                            <a class="text-decoration-none text-warning" href="/../controllers/findPassword-ctrl.php" >Mot de passe oublié?</a>
                        </div>
                    </div>
                    <div class="form-group d-md-flex mt-2">
                        <div class="">
                            <a class="text-decoration-none text-warning" href="/../controllers/registration-ctrl.php" >Nouveau ici? S'inscrire?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


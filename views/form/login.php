    <div id="signInForm" class="container-fluid h-100">
    
        <div class="row justify-content-center h-100">
        <div><h2 class="d-flex justify-content-center mt-5"><?=$title ?? ''?></h2></div>

            <div class=" col-12 col-lg-4">

                <div class="d-flex justify-content-center align-items-center login-wrap">

                    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                        <div class="form-outline">
                            <input type="email" 
                                    name="email" 
                                    class="form-control" 
                                    id="email" 
                                    placeholder="Adresse e-mail" 
                                    autocomplete="email"
                                    value="<?= htmlentities($_POST['email'] ?? '')?>" 'required>
                            <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                            <div class="valid-feedback">Parfait!</div>
                            <div class="invalid-feedback">Merci de choisir un email valide.</div>
                        </div>
                        <div class="text-danger"><?= htmlentities($errorsArray['email'] ?? '')?></div>


                        <div class="form-outline mt-3">
                            <input type="password" 
                                    name="password" 
                                    class="form-control" 
                                    id="password" 
                                    placeholder="Votre mot de passe" 
                                    autocomplete="off" 
                                    minlength="8" 
                                    maxlength="20" 
                                    value="<?= htmlentities($_POST['password'] ?? '')?>" 'required>
                            <label for="password" class="col-form-label text-warning">Mot de passe*</label>
                        </div>
                        <div class='text-danger' id='errPass1'><?=htmlentities($errorsArray['password'] ?? '')?></div>


                        <div class="form-outline mt-3">
                            <button id="btnSubmit" 
                                    type="submit" 
                                    class="form-control btn btn-outline-warning submit px-3 rounded-pill">Se connecter</button>
                        </div>

                        <div class="form-outline d-md-flex mt-2">
                            <div class="">
                                <a class="text-decoration-none text-warning" href="/../controllers/findPassword-ctrl.php" >Mot de passe oublié?</a>
                            </div>
                        </div>

                        <div class="form-outline d-md-flex mt-2">
                            <div class="">
                                <a class="text-decoration-none text-warning" href="/../controllers/register-ctrl.php" >S'inscrire?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgConnexion.jpg);">
    <div id="formPosition" class="row justify-content-center align-items-center h-100">
        <div class="col-md-6 col-lg-4">
            <div class="login-wrap p-0">
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="signin-form px-4 py-3">
                    <div class="form-group">
                        <label for="email1" class="form-label text-warning">Adresse Email*</label>
                        <input id="email1" class="form-control rounded-pill" type="email" name="email1"  
                            placeholder="Votre e-mail" autocomplete="email1"
                            value="<?= htmlentities($_POST['email1'] ?? '', ENT_QUOTES, 'UTF-8')?>" required>
                        <div class="text-danger"><?= htmlentities($error['email1'] ?? '', ENT_QUOTES, 'UTF-8')?>
                        </div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <button type="submit" class="form-control btn btn-outline-warning submit px-3 rounded-pill">Envoyer nouveau mot de passe?</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

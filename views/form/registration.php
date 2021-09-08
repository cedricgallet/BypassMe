<?php
if (empty(session_id())) {
    session_start(); // Démarrage de la session   
}
require_once __DIR__.'/../../utils/regex.php';
require_once __DIR__.'/../../views/templates/navbar.php';
require_once __DIR__.'/../../utils/config.php';
?>

<!-- ================================FORMULAIRE INSCRIPTION==================================== -->
<div id="signUpForm" class="container-fluid h-100 bgImageConnexion">
    <div class="row justify-content-center h-100">
    <h2 class="text-center mt-5"><?=$title ?? ''?></h2>

        <div class="col-12 col-lg-4">
            <div class="login-wrap p-0">

                <?php 
                    if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) 
                    {
                        if(!array_key_exists($msgCode, $displayMsg))
                        {
                            $msgCode = 0;
                        }
                        echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                    }
                ?>
                
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="signin-form">
                    <!-- ===========================CHAMP PSEUDO=========================== -->
                    
                    <div class="form-group">
                        <label for="pseudo" class="col-form-label text-warning">Pseudo*</label>
                        
                        <input type="text" name="pseudo" id="pseudo" title="Le pseudo n' est pas au format attendu"
                            placeholder="Entrez votre pseudo" class="form-control"
                            autocomplete="given-name"
                            value="<?= htmlentities($_POST['pseudo'] ?? '', ENT_QUOTES, 'UTF-8')?>"
                            pattern="<?=REGEX_PSEUDO?>" 'required>
                    </div>

                    <!-- ===========================CHAMP EMAIL============================ -->


                    <div class="form-group">
                        <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                        <input type="email" name="email" class="form-control" id="email" class="form-control"
                            placeholder="Adresse e-mail" autocomplete="email"
                            value="<?= htmlentities($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8')?>" 'required>
                    </div>

                    <!-- =================================CHAMP EMAIL CONFIRMATION============================ -->

                    <div class="form-group">
                        <label for="email2" class="col-form-label text-warning">Adresse Email*</label>

                        <input type="email" name="email2" class="form-control" id="email2"
                            class="form-control" placeholder="Confirmez votre e-mail" autocomplete="email2"
                            value="<?= htmlentities($_POST['email2'] ?? '', ENT_QUOTES, 'UTF-8')?>" 'required>
                    </div>

                    <!-- ===============================CHAMP MOT DE PASSE============================= -->
                
                    <div class="form-group">
                        <label for="password" class="col-form-label text-warning">Mot de passe*</label>

                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Votre mot de passe" autocomplete="new-password" minlength="8" maxlength="20" 
                            value="<?= htmlentities($_POST['password'] ?? '',)?>" 'required>
                    </div>

                    <!-- ============================CHAMP MOT DE PASSE CONFIRMATION========================= -->

                    <div class="form-group">
                        <label for="password2" class="col-form-label text-warning">Confirmation mot de passe*</label>

                        <input type="password" name="password2" class="form-control" id="password2"
                            placeholder="Confirmez votre mot de passe" autocomplete="new-password" minlength="8"
                            maxlength="20"
                            value="<?= htmlentities($_POST['password2'] ?? '',)?>" 'required>
                    </div>
                    
                    
                    <div class="form-group mt-4">
                        <button type="submit" class="form-control btn btn-outline-warning submit px-3 rounded-pill">Connexion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require_once __DIR__.'/../../views/templates/footer.php';
?>

<script src="/../assets/js/checkPass.js"></script>
<!-- =======================================FIN INSCRIPTION========================================== -->
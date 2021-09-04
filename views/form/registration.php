<?php
if (empty(session_id())) session_start(); // Démarrage de la session        
require_once __DIR__.'/../../utils/regex.php';
require_once __DIR__.'/../../views/templates/navbar.php';
?>

<!-- ==========================================================FORMULAIRE INSCRIPTION========================================================= -->
<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgForm.jpg);">
    <div class="row justify-content-center h-100">
    <h2 class="text-center mt-5"><?=$title ?? ''?></h2>

        <div class="col-12 col-lg-4">
            <div class="login-wrap p-0">
                <?php 
                    if(isset($_GET['reg_err']))
                    {
                        $err = htmlspecialchars($_GET['reg_err']);

                        switch($err)
                        {
                            case 'success':
                            ?>

                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>

                            <?php
                            break;

                            case 'password':
                            ?>

                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Les mots de passe sont différent
                            </div>

                            <?php
                            break;

                            case 'email':
                            ?>

                            <div class="alert alert-danger">
                    
                            <strong>Erreur</strong> Format email non valide
                            </div>

                            <?php 
                            case 'already':
                            ?>

                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Ce compte existe déjà
                            </div>

                            <?php 
                            case 'empty':
                            ?>

                            <div class="alert alert-danger">
                                <strong>Erreur</strong> Tous les champs sont obligatoires
                            </div>
                            <?php 

                        }
                    }
                ?>
                
                <form action="/../controllers/registration-ctrl.php" method="post" class="signin-form">
                <input type="hidden" value="<?= $id ?? '' ?>" class="form-control" id="id" name="id"> 
                    <!-- =============================================CHAMP PSEUDO=============================================== -->
                    
                    <div class="form-group">
                        <label for="pseudo" class="col-form-label text-warning">Pseudo*</label>
                        
                        <input type="text" name="pseudo" id="pseudo" title="Le pseudo n' est pas au format attendu"
                            placeholder="Entrez votre pseudo" class="form-control"
                            autocomplete="given-name"
                            value="<?= htmlentities($_POST['pseudo'] ?? '', ENT_QUOTES, 'UTF-8')?>"
                            pattern="<?=REGEX_PSEUDO?>" 'required>
                    </div>

                    <!-- ============================================CHAMP EMAIL=================================================== -->


                    <div class="form-group">
                        <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                        <input type="email" name="email" class="form-control" id="email" class="form-control"
                            placeholder="Adresse e-mail" autocomplete="email"
                            value="<?= htmlentities($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8')?>" 'required>
                    </div>

                    <!-- =====================================CHAMP EMAIL CONFIRMATION============================================== -->

                    <div class="form-group">
                        <label for="email2" class="col-form-label text-warning">Adresse Email*</label>

                        <input type="email" name="email2" class="form-control" id="email2"
                            class="form-control" placeholder="Confirmé votre e-mail" autocomplete="email2"
                            value="<?= htmlentities($_POST['email2'] ?? '', ENT_QUOTES, 'UTF-8')?>" 'required>
                    </div>

                    <!-- =======================================CHAMP MOT DE PASSE================================================== -->
                
                    <div class="form-group">
                        <label for="password" class="col-form-label text-warning">Mot de passe*</label>

                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Votre mot de passe" autocomplete="new-password" minlength="8" maxlength="20" 
                            value="<?= htmlentities($_POST['password'] ?? '',)?>" 'required>
                    </div>

                    <!-- ================================CHAMP MOT DE PASSE CONFIRMATION============================================= -->

                    <div class="form-group">
                        <label for="password2" class="col-form-label text-warning">Confirmation mot de passe*</label>

                        <input type="password" name="password2" class="form-control" id="password2"
                            placeholder="Confirmer votre mot de passe" autocomplete="new-password" minlength="8"
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


<!-- ================================================================FIN INSCRIPTION================================================================================ -->
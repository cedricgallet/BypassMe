<?php
session_start(); // Démarrage de la session  
include(dirname(__FILE__).'/../../utils/regex.php');
include(dirname(__FILE__).'/../../views/templates/navbar.php');
?>
<!-- ==========================================================FORMULAIRE INSCRIPTION========================================================= -->
<div id="signInForm" class="container-fluid h-100">
    <div class="row justify-content-center h-100">
    <h2 class="text-center mt-5">Inscription</h2>

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
                
                <form id="signInForm" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                    <!-- =============================================CHAMP PSEUDO=============================================== -->
                    
                    <div class="form-group">
                        <label for="pseudo" class="col-form-label text-warning">Pseudo*</label>
                        
                        <input type="text" 
                                name="pseudo" 
                                id="pseudo" 
                                class="form-control"
                                title="Le pseudo n' est pas au format attendu"
                                placeholder="Entrez votre pseudo"
                                autocomplete="given-name"
                                value="<?= htmlentities($_POST['pseudo'] ?? '')?>"
                                pattern="<?=REGEX_PSEUDO?>" 'required>
                    </div>

                    <!-- ============================================CHAMP EMAIL=================================================== -->


                    <div class="form-group">
                        <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                        <input type="email" 
                                name="email" 
                                class="form-control" 
                                id="email" 
                                aria-describedby="emailHelp" 
                                placeholder="Adresse e-mail" 
                                autocomplete="email"
                                value="<?= htmlentities($_POST['email'] ?? '')?>" 'required>
                    </div>

                    <!-- =====================================CHAMP EMAIL CONFIRMATION============================================== -->

                    <div class="form-group">
                        <label for="email2" class="col-form-label text-warning">Adresse Email*</label>

                        <input type="email" 
                                name="email2" 
                                class="form-control" 
                                id="email2"
                                class="form-control" 
                                placeholder="Confirmez votre e-mail" 
                                autocomplete="email2"
                                value="<?= htmlentities($_POST['email2'] ?? '')?>" 'required>
                    </div>

                    <!-- =======================================CHAMP MOT DE PASSE================================================== -->
                
                    <div class="form-group">
                        <label for="password" class="col-form-label text-warning">Mot de passe*</label>

                        <input type="password" 
                                name="password" 
                                class="form-control" 
                                id="password"
                                placeholder="Votre mot de passe" 
                                autocomplete="new-password" 
                                minlength="8" 
                                maxlength="20" 
                                value="<?= htmlentities($_POST['password'] ?? '')?>" 'required>
                    </div>

                    <!-- ================================CHAMP MOT DE PASSE CONFIRMATION============================================= -->

                    <div class="form-group">
                        <label for="password2" class="col-form-label text-warning">Confirmation mot de passe*</label>

                        <input type="password" 
                                name="password2" 
                                class="form-control" 
                                id="password2"
                                placeholder="Confirmez votre mot de passe" 
                                autocomplete="new-password" 
                                minlength="8"
                                maxlength="20"
                                value="<?= htmlentities($_POST['password2'] ?? '')?>" 'required>
                    </div>
                    
                    
                    <div class="form-group mt-4">
                        <input id="btnSubmit" 
                                type="submit" 
                                class="form-control btn btn-outline-warning submit px-3 rounded-pill">Créer mon compte</input>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include(dirname(__FILE__).'/../../views/templates/footer.php');
?>

<!-- ================================================================FIN INSCRIPTION================================================================================ -->
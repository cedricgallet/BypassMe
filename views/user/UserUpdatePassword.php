<!-- ======================================UPDATE MOT DE PASSE USER=================================== -->
    <div id="landingSpace" class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <h2 class="d-flex justify-content-center align-items-center">Modifier mon mot de passe</h2>

            <!-- Affichage d'un message d'erreur personnalisé -->
            <?php 
                if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                    if(!array_key_exists($msgCode, $displayMsg)){
                        $msgCode = 0;
                    }
                    echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                } 

            ?>

            <div class="col-lg-4 p-0">
                    
                <form id="signUpForm" class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                    <div class="mb-3">
                        <label for='current_password' class="text-warning">Mot de passe actuel*</label>                       
                        <input type="password" 
                                id="current_password" 
                                name="current_password"
                                class="form-control" required>
                    </div>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['current_password'] ?? '')?></div>

                    <div class="mb-3">
                        <label for='new_password' class="text-warning">Nouveau mot de passe*</label>
                        <input type="password" 
                                id='errPass1'    
                                name="new_password" 
                                class="form-control"
                                required>
                    </div>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['new_password'] ?? '')?></div>

                    <div class="mb-3">
                        <label for='new_password2' class="text-warning">Confirmer le nouveau mot de passe*</label>
                        <input type="password" 
                                id='errPass2' 
                                name="new_password2"
                                class="form-control" 
                                required>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['new_password2'] ?? '')?></div>

                        <button type="submit" 
                                class="btn btn-success mt-2">Mettre a jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<script src="/../assets/js/checkPass.js"></script>
<script src="/../assets/js/checkValidation.js"></script>
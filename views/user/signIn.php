<!-- ============================Formulaire connexion====================== -->

    <div id="signInForm" class="container-fluid h-100">
        <div class="row justify-content-end align-items-center h-100">
            <div class="signInForm d-flex flex-column col-12 col-lg-4">
                <div class="login-wrap">
                    <h2 class="mt-5"><?=$title ?? ''?></h2>

                    <!-- Affichage d'un message d'erreur personnalisé -->
                    <?php 
                        require_once(dirname(__FILE__).'/../../config/config.php');

                        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) 
                        {
                            if(!array_key_exists($msgCode, $displayMsg))
                            {
                                $msgCode = 0;
                            }
                            echo '<div class="d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        } 

                    ?>
                
                    <!-- ++++++++++++++++++++++++++++Email++++++++++++++++++++++++++++++++ -->
                    <div class="card bg-transparent">
                        
                        <div class="card-body h-100">

                            <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                            
                            <input type="hidden" value="<?= htmlentities($id ?? '') ?>" class="form-control" id="id" name="id">

                                <label for="email" class="col-form-label text-warning">Adresse Email*</label>
                                <div class="form-outline">
                                    <input type="email" 
                                            name="email" 
                                            class="form-control card-header" 
                                            id="email" 
                                            placeholder="Adresse e-mail" 
                                            autocomplete="email"
                                            value="<?= htmlentities($_POST['email'] ?? '')?>" required>
                                </div>
                                <div class="invalid-feedback-2"><?= htmlentities($errorsArray['email'] ?? '')?></div>

                                <!-- ++++++++++++++++++++++++++++Mot de passe++++++++++++++++++++++++++++++ -->
                                <label for="password" class="col-form-label text-warning">Mot de passe*</label>
                                <div class="form-outline">
                                    <input type="password" 
                                            name="password" 
                                            class="form-control card-header" 
                                            id="password" 
                                            placeholder="Votre mot de passe" 
                                            autocomplete="off" 
                                            minlength="8" 
                                            maxlength="20" 
                                            value="<?= htmlentities($_POST['password'] ?? '')?>" required>
                                </div>
                                <div class='invalid-feedback-2' id='pass'><?=htmlentities($errorsArray['password'] ?? '')?></div>
                                <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                                <div class="form-outline mt-3">
                                    <button id="btnSubmit" 
                                            type="submit" 
                                            class="form-control btn card-header border submit px-3 rounded-pill">Se connecter</button>
                                </div>

                                <div class="form-outline d-md-flex mt-2">
                                    <div class="">
                                        <a class="text-decoration-none text-warning" href="/../controllers/findPassword-ctrl.php" >Mot de passe oublié?</a>
                                    </div>
                                </div>

                                <div class="form-outline d-md-flex mt-2">
                                    <div class="">
                                        <a class="text-decoration-none text-warning" href="/../controllers/signUp-ctrl.php" >S'inscrire?</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<script src="/../assets/js/checkValidation.js"></script>
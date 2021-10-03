    <!-- ==============================FORMULAIRE INSCRIPTION============================= -->

    <div id="signInForm" class="container-fluid h-100">
        <div class="row h-100">
        <h2 class="d-flex justify-content-center mt-5"><?=$title ?? ''?></h2>

            <div class="col-12 d-flex login-wrap p-0 h-100">

                <!-- Affichage d'un message d'erreur personnalisé -->
                <?php 
                require_once(dirname(__FILE__).'/../../config/config.php');

                    if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                        if(!array_key_exists($msgCode, $displayMsg)){
                            $msgCode = 0;
                        }
                        echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                    } 

                ?>
                
                <!-- =============================CHAMP PSEUDO=============================== -->
                <div class="d-flex align-items-center justify-content-center col-12 col-lg-4">                            

                    <form id="signUpForm" class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                            <input type="hidden" value="<?= $id ?? '' ?>" class="form-control" id="id" name="id">

                            <div class="form-outline">
                            <label for="pseudo" class="col-form-label text-warning">Pseudo*</label>

                                <input type="text" 
                                        name="pseudo" 
                                        id="pseudo" 
                                        class="form-control"
                                        title="Le pseudo ne doit pas contenir les caractères suivant: > <"
                                        placeholder="Entrez votre pseudo"
                                        autocomplete="given-name"
                                        value="<?= htmlentities($pseudo ?? '')?>"
                                        pattern="<?=REGEX_PSEUDO?>" 'required>

                            </div>
                            <div class="invalid-feedback-2"><?=htmlentities($errorsArray['pseudo'] ?? '')?></div>
                        

                            <!-- ===========================CHAMP EMAIL============================== -->

                            <div class="form-outline">
                            <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                                <input type="email" 
                                        name="email" 
                                        class="form-control" 
                                        id="email" 
                                        aria-describedby="emailHelp" 
                                        placeholder="Adresse e-mail" 
                                        autocomplete="email"
                                        value="<?= htmlentities($email ?? '')?>" 'required>
                            </div>
                            <div class="invalid-feedback-2"><?= htmlentities($errorsArray['email'] ?? '')?></div>

                            <!-- =============================CHAMP EMAIL CONFIRMATION=========================== -->

                            <div class="form-outline">
                            <label for="email2" class="col-form-label text-warning">Confirmation Email*</label>

                                <input type="email" 
                                        name="email2" 
                                        class="form-control" 
                                        id="email2"
                                        aria-describedby="emailHelp" 
                                        class="form-control" 
                                        placeholder="Confirmez votre e-mail" 
                                        autocomplete="email2"
                                        value="<?= htmlentities($email2 ?? '')?>" 'required>
                            </div>
                            <div class="invalid-feedback-2"><?= htmlentities($errorsArray['email2'] ?? '')?></div>
                        
                            <!-- ==========================CHAMP MOT DE PASSE========================== -->
                        
                            <div class="form-outline">
                            <label for="password" class="col-form-label text-warning">Mot de passe*</label>

                                <input type="password" 
                                        name="password" 
                                        class="form-control" 
                                        id="password"
                                        placeholder="Votre mot de passe" 
                                        autocomplete="new-password" 
                                        minlength="8" 
                                        maxlength="20" 
                                        value="<?= htmlentities($password ?? '')?>" 'required>
                            </div>

                            <div class='invalid-feedback-2' id='errPass1'><?=htmlentities($errorsArray['password'] ?? '')?></div>

                            <!-- ============================CHAMP MOT DE PASSE CONFIRMATION======================= -->

                            <div class="form-outline">
                            <label for="password2" class="col-form-label text-warning">Confirmation mot de passe*</label>

                                <input type="password" 
                                        name="password2" 
                                        class="form-control" 
                                        id="password2"
                                        placeholder="Confirmez votre mot de passe" 
                                        autocomplete="new-password" 
                                        minlength="8"
                                        maxlength="20"
                                        value="<?= htmlentities($password2 ?? '')?>" 'required>
                            </div>
                            <div class='invalid-feedback-2' id='errPass2'><?=htmlentities($errorsArray['password2'] ?? '')?></div>                    
                        </div>
                    

                        <div class="d-flex align-items-center justify-content-center col-12 col-lg-4">                            
                            <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
                            <form method="POST" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
                                <div class="upload-wrapper">
                                    <span class="file-name">Images autorisées :<hr> png, jpeg - 2Mo Max</span>
                                    <label for="file-upload">Choisir un avatar<input type="file" id="file-upload" name="uploadedFile"></label>
                                </div>
                            </form>
                        </div>

                        <div class="d-flex align-items-center justify-content-center col-12 col-lg-4">
                            <!-- +++++++++++++++++++++Affichage avatar+++++++++++++++++++++++++ -->
                            <div id= "avatar">
                                <img width="150" height="150" src =
                                <?php 
                                echo (file_exists("/../uploads/users/" . 1 . ".png")) ? "/../uploads/users/" . 1 . ".png" : "/../uploads/users/empty.png";
                                ?>
                                alt="avatar choisi ">
                            </div> 
                        </div>
                        <div class="form-outline mt-4 mb-5">
                            <button id="btnSubmit" 
                                    type="submit" 
                                    class="form-control btn btn-outline-warning submit px-3 rounded-pill">Créer mon compte</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- ===============================FIN INSCRIPTION============================= -->
<script src="/../assets/js/checkPass.js"></script>
<script src="/../../assets/js/checkValidation.js"></script>
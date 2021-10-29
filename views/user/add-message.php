<!-- *******************************************Formulaire de contact************************************************** -->
<div id="signInForm" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-12 d-flex justify-content-end login-wrap p-0 h-100">
            <div class="d-flex flex-column align-items-center justify-content-center col-12 col-lg-6 h-100">
                <div class="d-flex mb-5">
                    <h2 class=""><?=$title ?? ''?></h2>
                </div>

                <div class="col-12 col-lg-6">
                    <!-- *****************************Affichage d'un message d'erreur personnalisé************************** -->
                    <?php 

                        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                            if(!array_key_exists($msgCode, $displayMsg)){
                                $msgCode = 0;
                            }
                            echo '<div class="fs-5 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        } 

                    ?>

                    <!-- ************************************Sujet du message************************************-->

                    <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <div class="form-group mt-3">
                            <div class="mb-3">
                            <label for="subject" class="col-form-label text-warning">Sujet*</label>

                                <select name="subject" 
                                        id="subject" 
                                        class="text-info bg-transparent form-control" 
                                        value="<?= htmlentities($subject ?? '')?>" required>

                                    <option>Choix du sujet</option>

                                    <!-- **********************Boucle choix sujet******************** -->

                                    <?php foreach ($arraySubject as $subjectInSelect) {
                                    $isSelected = ($subjectInSelect==$subject) ? 'selected': '';
                                    echo "<option value=\"$subjectInSelect\" $isSelected>$subjectInSelect</option>";}?>
                                </select>
                                
                                <div class="invalid-feedback-2"><?=htmlentities($errorsArray['subject'] ?? '')?></div>
                            </div>
                        </div>

                        <!-- *****************************Message******************************-->

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="message" class="col-form-label text-warning">Message*</label>
                                 
                                <textarea
                                    name ="message" 
                                    class="text-info bg-transparent form-control" 
                                    id="message" 
                                    rows="9"
                                    minlength="10" 
                                    maxlength="250"
                                    placeholder=""
                                    required><?= htmlentities($message ?? '')?> 
                                </textarea>
                        </div>
                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['message'] ?? '')?></div>

                        <!-- **********************************Email*********************************-->

                        <div class="form-group">
                            <div class="mb-3">
                                <label for="email" class="col-form-label text-warning">Adresse Email*</label>

                                <div class="form-outline">
                                    <input type="email" 
                                            name="email" 
                                            class="form-control text-info bg-transparent" 
                                            id="email" 
                                            placeholder="Adresse e-mail" 
                                            autocomplete="email"
                                            value="<?= htmlentities($email ?? '')?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="invalid-feedback-2"><?= htmlentities($errorsArray['email'] ?? '')?></div>

                        <button type="submit" class="form-control btn text-success border submit px-3 rounded-pill">Envoyer le message ?</button>               
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- *********************************************** -->
<script src="/../../assets/js/checkConfirm.js"></script>
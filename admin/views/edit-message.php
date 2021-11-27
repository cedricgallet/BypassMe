<div id="signInForm" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-12 d-flex justify-content-end login-wrap p-0 h-100">
            <div class="d-flex flex-column align-items-center justify-content-center col-12 col-lg-6 h-100">
                <div class="d-flex">
                    <h2 class="mb-5"><?='Message de'.' '. htmlentities($pseudo ?? '').' '.'en cours de modification ...' ?? ''?></h2>
                </div>

                <!-- *************************Affichage d'un message d'erreur personnalisé************************ -->
                <?php 

                    if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                        if(!array_key_exists($msgCode, $displayMsg)){
                            $msgCode = 0;
                        }
                        echo '<div class="fs-5 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                    } 

                ?>
                <!-- ********************************************************************************************** -->

                    <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF']).'&FK='.htmlentities($getMessageUser->id_user ?? '')?>" method="post">
                        <div class="form-group mt-3">
                            <!-- **********************************Status message***************************** -->
                            <div class="form-outline">

                                <?php if ($state == 0) { ?>

                                        <div class='card-text text-warning text-start me-1'>Status du message > <strong class='text-danger'>DÉSACTIVÉ</strong>
                                        </div>

                                        <div class="form-check form-check-inline">

                                        <!-- ************Si status = 0 ************* -->
                                        <input
                                            class="form-check-input "
                                            type="checkbox"
                                            id="state"
                                            name="state"
                                            value="<?=htmlentities($state = 1) ?? ''?>">
                                            <label class="form-check-label text-success" for="state">Activer</label>
                                        </div>

                                    <?php } else { ?>

                                        <div class='card-text text-warning text-start me-1'>Status du message > <strong class='text-success'>ACTIVÉ</strong>
                                        </div>

                                        <div class="form-check form-check-inline">

                                        <!-- ************Si status = 1 ************* -->
                                        <input
                                            class="form-check-input text-danger"
                                            type="checkbox"
                                            id="state"
                                            name="state"
                                            value="<?=htmlentities($state = 0) ?? ''?>">
                                            <label class="form-check-label text-danger" for="state">Désactiver</label>
                                        </div>
                            
                                    <?php } ?>

                            </div>

                        <!-- *****************************Boucle pour choix du sujet************************* -->
                        <div class="mb-3 mt-3">
                        <label for="subject" class="col-form-label text-warning">Sujet*</label>

                            <select name="subject" 
                                    id="subject" 
                                    class="text-info bg-transparent form-control" 
                                    value="<?= htmlentities($getMessageUser->subject ?? '')?>" required>

                                    <option><?= htmlentities($getMessageUser->subject ?? '')?></option>

                                    <?php foreach ($arraySubject as $subjectInSelect) {
                                $isSelected = ($subjectInSelect==$subject) ? 'selected': '';
                                echo "<option value=\"$subjectInSelect\" $isSelected>$subjectInSelect</option>";}?>
                            </select>
                        </div>

                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['subject'] ?? '')?></div>
                        
                        <!-- **********************************Message********************************** -->
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="message" class="col-form-label text-warning">Message*</label> 
                                <textarea
                                    name ="message" 
                                    class="text-info bg-transparent form-control" 
                                    id="message" 
                                    rows="9" 
                                    minlength="10" 
                                    maxlength="300"><?= htmlentities($getMessageUser->message ?? '')?>
                                </textarea>
                        </div>
                        
                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['message'] ?? '')?></div>

                        <button type="submit" class="text-success bg-transparent btn btn-warning rounded-pill w-100 mb-2">Mettre à jour le message</button>
                        <a class="btn btn-success mt-2 rounded-pill w-100" href="/../../admin/controllers/list-message-ctrl.php">Retour à la liste
                            des messages</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
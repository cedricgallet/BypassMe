<div id="signInForm" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-12 d-flex justify-content-end login-wrap p-0 h-100">
            <div class="d-flex flex-column align-items-center justify-content-center col-12 col-lg-6 h-100">
                <div class="d-flex">
                    <h2 class=""><?=$title ?? ''?></h2>
                </div>

                <!-- Affichage d'un message d'erreur personnalisé -->
                <?php 

                        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                            if(!array_key_exists($msgCode, $displayMsg)){
                                $msgCode = 0;
                            }
                            echo '<div class="fs-3 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        } 

                    ?>

                    
                    <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF']). "?id=" . $id?>" method="post">
                        <div class="form-group mt-3">
                            <!-- **********************************Status utilisateur***************************** -->
                            <div class="form-outline">

                                <?php
                                if ($messageInfo->state == 0) {                    
                                ?>

                                    <div class="d-flex">
                                        <div class='card-text text-danger me-1'>Status du commentaire > 
                                        </div>

                                        <div class='card-text text-danger text-center'><strong>DÉSACTIVÉ</strong>
                                        </div>
                                    </div>

                                <?php } else { ?>

                                    <div class="d-flex">
                                        <div class='card-text text-success me-2'>Status du commentaire > 
                                        </div>

                                        <div class='card-text text-success text-center'><strong>ACTIVÉ</strong>
                                        </div>
                                    </div>
                        
                                <?php } ?>

                            </div>
                                    <!-- ***************************Activé/Désactivé******************** -->
                            <div class="form-group mt-3 mb-3 text-center bg-transparent">
                            <label for="state" class="col-form-label text-info">Désactiver le commentaire ?</label>

                            <select name="state" 
                                    class="form-outline" required>
                                <option selected value="<?= htmlentities($state ?? '') ?>">Options</option>

                                <option value="0">Désactiver</option>
                                <option value="1">Activer</option>
                            </select>
                        </div>

                        <!-- *****************************Boucle pour choix du sujet************************* -->
                        <div class="mb-3">

                            <select name="subject" 
                                    id="subject" 
                                    class="card-header bg-transparent form-control" 
                                    value="<?= htmlentities($subject ?? '')?>" required>

                                    <option><?= 'Sujet'.' '.'>'.' '. htmlentities($subject ?? '')?></option>

                                    <?php foreach ($arraySubject as $subjectInSelect) {
                                $isSelected = ($subjectInSelect==$subject) ? 'selected': '';
                                echo "<option value=\"$subjectInSelect\" $isSelected>$subjectInSelect</option>";}?>
                            </select>
                        </div>

                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['subject'] ?? '')?></div>
                        
                        <!-- **********************************Message********************************** -->
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="message" class="col-form-label"></label> 
                                <textarea
                                    name ="message" 
                                    class="card-header bg-transparent form-control" 
                                    id="message" 
                                    rows="9" 
                                    minlength="10" 
                                    maxlength="1500"><?= htmlentities($message ?? '')?>
                                </textarea>
                        </div>
                        
                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['message'] ?? '')?></div>

                        <button type="submit" class="text-info bg-transparent btn btn-outline-warning rounded-pill w-100 mb-2">Mettre à jour le message ?</button>
                        <a class="btn btn-success mt-2 rounded-pill w-100" href="/../../admin/controllers/list-message-ctrl.php">Retour à la liste
                            des messages</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
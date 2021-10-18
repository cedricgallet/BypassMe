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
                            echo '<div class="d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        } 

                    ?>

                    
                    <!-- +++++++++++++++++++++++++++++++++++++SUBJECT+++++++++++++++++++++++++++++++++++++++++++++++= -->
                    <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF']). "?id=" . $id?>" method="post">
                        <!-- ===========================Status utilisateur========================== -->

                        <div class="form-group mt-3">

                            <!-- ===========================Status utilisateur========================== -->

                            <div class="form-outline">

                                <?php
                                if ($commentInfo->state == 0) {                    
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

                            <div class="form-group mt-3 mb-3 text-center bg-transparent">
                            <label for="state" class="col-form-label text-info">Désactiver le commentaire ?</label>

                            <select name="state" 
                                    class="form-outline" required>
                                <option selected value="<?= htmlentities($state ?? '') ?>">Options</option>

                                <option value="0">Désactiver</option>
                                <option value="1">Activer</option>
                            </select>
                        </div>

                        <!-- ============================boucle pour choix du sujet======================= -->
                        <div class="mb-3">

                            <select name="subject" 
                                    id="subject" 
                                    class="card-header bg-transparent form-control" 
                                    value="<?= htmlentities($commentInfo->subject ?? '')?>" required>

                                    <option><?= 'Sujet'.' '.'>'.' '. ($commentInfo->subject ?? '')?></option>

                                    <?php foreach ($arraySubject as $subjectInSelect) {
                                $isSelected = ($subjectInSelect==$subject) ? 'selected': '';
                                echo "<option value=\"$subjectInSelect\" $isSelected>$subjectInSelect</option>";}?>
                            </select>
                        </div>

                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['subject'] ?? '')?></div>
                        
                        <!-- +++++++++++++++++++++++++++++++++++++CATEGORIES++++++++++++++++++++++++++++++++++++++++ -->
                        <!-- ============================boucle pour choix catégories=============================== -->
                        <div class="form-group">
                            <select name="categories" 
                                    id="categories" 
                                    class="card-header bg-transparent form-control" 
                                    value="" required>

                                <option><?= 'Categoies'.' '.'>'.' '. ($commentInfo->categories ?? '')?></option>

                                <?php foreach ($arrayCategories as $categoriesInSelect) {
                                $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';

                                echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";}?>
                            </select>
                        </div>

                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['categories'] ?? '')?></div>
                        
                        <!-- ===================================COMMENT=============================================== -->
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="comment" class="col-form-label"></label> 
                                <textarea
                                    name ="comment" 
                                    class="card-header bg-transparent form-control" 
                                    id="comment" 
                                    rows="9" 
                                    placeholder="Votre message" 
                                    value="<?= ($comment ?? '')?>"><?= htmlentities($commentInfo->comment ?? '')?>
                                </textarea>
                        </div>
                        
                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['comment'] ?? '')?></div>

                        <button type="submit" class="text-info bg-transparent btn btn-outline-warning rounded-pill w-100 mb-2">Mettre à jour le commentaire ?</button>
                        <a class="btn btn-success mt-2 rounded-pill w-100" href="/../../admin/controllers/list-comment-ctrl.php">Retour à la liste
                            des commentaires</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
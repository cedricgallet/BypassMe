
    <div id="signInForm" class="container-fluid h-100">
        <div class="row justify-content-center">
        <h2 class="text-center mt-5 mb-5">Ajouter votre commentaire</h2>

            <div class="d-flex col-12 col-lg-4 d-flex justify-content-center align-items-center">
                <div class="login-wrap p-0">


                        <?php 
                            if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) 
                            {
                                if(!array_key_exists($msgCode, $displayMsg))
                                {
                                    $msgCode = 0;
                                }
                                echo '<div class="d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                            }
                        ?>
                    
                    <!-- +++++++++++++++++++++++++++++++++++++SUBJECT+++++++++++++++++++++++++++++++++++++++++++++++= -->
                    <form id="" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <!-- ===========================Status utilisateur========================== -->

                        <div class="form-group mt-3">
                            <label for="state" class="col-form-label text-info">Désactiver l'article ?</label>

                            <select name="state" class="form-outline" required>
                                <option selected value="<?= htmlentities($state ?? '') ?>">Options</option>

                                <option value="0">Désactiver</option>
                                <option value="1">Activer</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <div class="mb-3">

                                <select name="subject" 
                                        id="subject" 
                                        class="form-control" 
                                        value="<?= htmlentities($subject ?? '')?>" required>

                                    <option>Choix du sujet</option>
                        <!-- ============================boucle pour choix du sujet================================ -->
                                    <?php foreach ($arraySubject as $subjectInSelect) {
                                $isSelected = ($subjectInSelect==$subject) ? 'selected': '';
                                echo "<option value=\"$subjectInSelect\" $isSelected>$subjectInSelect</option>";}?>
                                </select>
                                <div class="invalid-feedback-2"><?=htmlentities($errorsArray['subject'] ?? '')?></div>
                            </div>
                        </div>
                        <!-- +++++++++++++++++++++++++++++++++++++CATEGORIES++++++++++++++++++++++++++++++++++++++++ -->
                        <!-- ============================boucle pour choix catégories=============================== -->
                        <div class="form-group">
                            <select name="categories" 
                                    id="categories" 
                                    class="form-control" 
                                    value="<?= htmlentities($categories ?? '')?>" required>

                                <option>Choix de la catégorie</option>

                                <?php foreach ($arrayCategories as $categoriesInSelect) {
                                $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';

                                echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";}?>
                            </select>
                            <div class="invalid-feedback-2"><?=htmlentities($errorsArray['categories'] ?? '')?></div>
                        </div>

                        <!-- ===================================COMMENT=============================================== -->
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="comment" class="col-form-label"></label> 
                                <textarea
                                    name ="comment" 
                                    class="form-control" 
                                    id="comment" 
                                    rows="9" 
                                    placeholder="Votre message" 
                                    value="<?= htmlentities($comment ?? '')?>" required>
                                </textarea>
                        </div>
                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['comment'] ?? '')?></div>

                        <button type="submit" class="btn btn-outline-warning rounded-pill w-100 mb-5">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
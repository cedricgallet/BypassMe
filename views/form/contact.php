<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgForm.jpg);">
    <div class="row h-100">
        <div class="col-12 col-lg-6 d-flex justify-content-center align-items-center">
            <div class="login-wrap p-0">
                    <h2 class="text-center">Ajouter un commentaire</h2>
                
                
                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                    <div class="form-group mt-3">
                        <div class="mb-3">

                            <select name="subject" id="subject" class="form-control" required>
                                <option value="">Choix du sujet</option>
                    <!-- ============================boucle pour choix du sujet======================================== -->
                                <?php foreach ($arraySubject as $subjectInSelect) {
                            $isSelected = ($subjectInSelect==$subject) ? 'selected': '';
                            echo "<option value=\"$subjectInSelect\" $isSelected>$subjectInSelect</option>";}?>
                            </select>
                            <div class="error"><?=$error['subject'] ?? ''?></div>
                        </div>
                    </div>

                    <!-- ============================boucle pour choix catégories======================================== -->
                    <div class="form-group">
                        <select name="categories" id="categories" class="form-control" required>
                            <option value="">Choix de la catégorie</option>

                            <?php foreach ($arrayCategories as $categoriesInSelect) {
                            $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';

                            echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";}?>
                        </select>
                        <div class="error"><?=$error['categories'] ?? ''?></div>
                    </div>

                    <!-- =================================================================================================== -->
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="textarea1" class="form-label"></label> <textarea
                                class="form-control" id="textarea1" rows="9" placeholder="Votre message" required
                            <?= $comment ?? ''?>></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-warning rounded-pill w-100">Envoyer</button>
                    </div>
                </form>
                <div class="border-bottom border-2 mb-2 mt-2"></div>
            </div>
        </div>
    </div>
</div>
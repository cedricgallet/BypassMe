<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgConnexion.jpg);">
    <div id="formPosition" class="row justify-content-center align-items-center h-100">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-gradient text-center fw-bold fs-5">
                    <h3>Ajouter un commentaire ?</h3>
                </div>
                <div class="card-body">
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
</div>
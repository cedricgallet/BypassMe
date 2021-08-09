<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgForm.jpg);">
    <div class="row h-100">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="card w-50">
                <div class="card-header bg-gradient text-center shadow fw-bold fs-5">
                    <h2>Ajouter un nouvel article ?</h2>
                </div>
                <div class="card-body">
                    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                        <div class="mb-2"><label for="imgArticle">Choisir une image:</label>

                            <input type="file" id="imgArticle" name="imgArticle" accept="image/png, image/jpeg"></div>

                        <!-- =============================boucle choix catégories======================================= -->

                        <select name="categories" id="categories" class="form-control">
                            <option value="">Choix de la catégorie</option>

                            <?php foreach ($arrayCategories as $categoriesInSelect) {
                                $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';
                                echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";
                            }?>

                        </select>
                        <div class="error"><?=$error['categories'] ?? ''?></div>

                        <!-- ================================================================================================= -->

                        <div class="mb-3">
                            <label for="titre" class="col-form-label">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control"
                                placeholder="Titre de l'article"<?=$titre ?? ''?>>
                        </div>

                        <div class="mb-3">
                            <label for="Textarea1" class="col-form-label">Contenu de l' article</label> <textarea
                                class="form-control" id="textarea1" rows="9" placeholder="Tapez votre article"<?=$article ?? ''?>></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-warning rounded-pill w-100">Enregistrer</button>
                    </form>
                    <div class="border-bottom border-2 mb-2 mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    
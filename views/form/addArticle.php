<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgConnexion.jpg);">
    <div id="formPosition" class="row justify-content-center align-items-center h-100">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-gradient text-center text-white fw-bold fs-5">
                    Ajouter un nouvel article ?
                </div>
                <div class="card-body">
                    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                        <div><label for="imgArticle">Choisir une image:</label>

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
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" name="titre" id="titre" class="form-control"
                                placeholder="Titre de l'article"<?=$titre ?? ''?>>
                        </div>

                        <div class="mb-3">
                            <label for="Textarea1" class="form-label">Contenu de l' article</label> <textarea
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
    
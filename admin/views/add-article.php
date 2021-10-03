    <!-- +++++++++++++++++++++++++++++++++++++++Formulaire d'ajout d'article+++++++++++++++++++++++++++++++++++++++ -->
    <div  class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 d-flex justify-content-center align-items-center">

                    <!-- ++++++++++++++++++++Message personnalisé+++++++++++++++++++++++++++++ -->

                    <?php 
                        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) 
                        {
                            if(!array_key_exists($msgCode, $displayMsg))
                            {
                                $msgCode = 0;
                            }
                            echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        }
                    ?>

                    
                <div class="card w-50">
                    <div class="card-header bg-gradient text-center shadow fw-bold fs-5">
                        <h2><?=$title ?? ''?></h2>
                    </div>
                    <div class="card-body">
                        <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                            <div class="mb-2"><label for="imgArticle">Choisir une image:</label>

                                <input type="file" id="imgArticle" name="imgArticle" accept="image/png, image/jpeg"></div>

                            <!-- =============================boucle choix catégories====================== -->

                            <select name="categories" id="categories" class="form-control">
                                <option value="">Choix de la catégorie</option>

                                <?php foreach ($arrayCategories as $categoriesInSelect) {
                                    $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';
                                    echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";
                                }?>

                            </select>
                            <div class="error"><?=$error['categories'] ?? ''?></div>

                            <!-- ==============================Titre=============================== -->

                            <div class="mb-3">
                                <label for="title" class="col-form-label">Titre</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="title de l'article"<?=$title ?? ''?>>
                            </div>
                                <!-- ============================Article============================== -->
                            <div class="mb-3">
                                <label for="article" class="col-form-label">Contenu de l' article</label> <textarea
                                    name ="article "class="form-control" id="article" rows="9" placeholder="Tapez votre article"<?=$article ?? ''?>></textarea>
                            </div>
                            <button type="submit" class="btn btn-outline-warning rounded-pill w-100">Enregistrer</button>
                        </form>
                        <div class="border-bottom border-2 mb-2 mt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
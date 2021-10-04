        <!-- +++++++++++++++++++++++++++++++++++++++Formulaire d'ajout d'article+++++++++++++++++++++++++++++++++++++++ -->
        <div id="addArticleForm"  class="container-fluid h-100 p-0">
                    

            <div class="row h-100">                

                <div class="d-flex align-items-center justify-content-center col-12 h-100">

                    <div class="card bg-transparent w-50 h-100">
                        <div class="fw-bold fs-5 mt-5 mb-5">
                            <h2><?=$title1 ?? ''?></h2>

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
                        </div>

                        <div class="card-body h-100">
                            <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">


                                <!-- =============================boucle choix catégories====================== -->

                                <select name="categories" id="categories" class="text-end form-control card-header">
                                    <option value="">Choix de la catégorie</option>

                                    <?php foreach ($arrayCategories as $categoriesInSelect) {
                                        $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';
                                        echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";
                                    }?>

                                </select>
                                <div class="valid-feedback">Parfait!</div>
                                <div class="invalid-feedback">Merci de choisir une catégorie valide.</div>
                                <!-- ==============================Titre=============================== -->

                                <div class="mb-3 mt-3">
                                    <input type="text" name="title" id="title" class="text-end form-control card-header"
                                        value="titre de l'article">
                                </div>
                                <div class="valid-feedback">Parfait!</div>
                                <div class="invalid-feedback">Merci de choisir un tire valide.</div>

                                    <!-- ============================Article============================== -->
                                <div class="mb-3">
                                    <label for="article" class="col-form-label card-header">Contenu de l' article</label> 
                                    <textarea
                                        name ="article "class="form-control card-header" id="article" rows="9" placeholder="Tapez votre article">
                                    </textarea>
                                </div>
                                <div class="valid-feedback">Parfait!</div>
                                <div class="invalid-feedback">Merci de vérifier les caractéres utilisés.</div>

                                <button type="submit" class="btn btn-warning rounded-pill w-100">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
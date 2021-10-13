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
                            echo '<div class="d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        }
                    ?>
                </div>

                <div class="card-body h-100">
                    <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                        <!-- ===========================Status utilisateur========================== -->

                        <div class="form-group mt-3">
                            <label for="state" class="col-form-label text-info">Désactiver l'article ?</label>

                            <select name="state" class="form-outline" required>
                                <option selected value="<?= htmlentities($state ?? '') ?>">Options</option>

                                <option value="0">Désactiver</option>
                                <option value="1">Activer</option>
                            </select>
                        </div>

                        <!-- =============================Catégories====================== -->

                        <div class="mb-3 mt-3">
                            <input type="text" name="categories" id="categories" class="text-end form-control card-header"
                                value="<?= htmlentities($categories ?? '')?>">
                        </div>
                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['categories'] ?? '')?></div>
                        
                        <!-- ==============================Titre=============================== -->

                        <div class="mb-3 mt-3">
                            <input type="text" name="title" id="title" class="text-end form-control card-header"
                                value="<?= htmlentities($title ?? '')?>">
                        </div>
                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['title'] ?? '')?></div>

                            <!-- ============================Article============================== -->
                        <div class="mb-3">
                            <label for="article" class="col-form-label card-header">Contenu de l' article</label>
                            
                            <textarea
                                value="<?= htmlentities($article ?? '')?>" name ="article" class="form-control card-header" id="article" rows="9" placeholder="Tapez votre article">
                            </textarea>
                        </div>
                        <div class="invalid-feedback-2"><?=htmlentities($errorsArray['article'] ?? '')?></div>

                        <button type="submit" class="btn btn-warning rounded-pill w-100">Enregistrer</button>
                    </form>
                    <div class="d-flex flex-row justify-content-between">
                        <a class="btn btn-success mt-2 rounded-pill" href="/../../admin/controllers/add-article-ctrl.php">Ajouter
                        un article</a>

                        <a class="btn btn-success mt-2 rounded-pill text-end" href="/../../admin/controllers/list-article-ctrl.php">Retour à la liste
                        des articles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
<!-- ===============================FIN INSCRIPTION============================= -->
<script src="/../../assets/js/checkConfirm.js"></script>
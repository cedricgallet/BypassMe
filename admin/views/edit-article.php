<!-- +++++++++++++++++++++++++++++++++++++++Formulaire d'ajout d'article+++++++++++++++++++++++++++++++++++++++ -->
<div id="addArticleForm"  class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-12 d-flex justify-content-end login-wrap p-0 h-100">
            <div class="d-flex flex-column align-items-center justify-content-center col-12 h-100">
                <div class="d-flex">
                    <h2 class=""><?=$title1 ?? ''?></h2>
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

                <div class="col-12 col-lg-6">
                    <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF']). "?id=" . $id?>" method="post">

                        <!-- ===========================Status utilisateur========================== -->

                        <div class="form-outline">
                            <label for="state" class="col-form-label text-info"></label>

                            <?php
                                if ($articleInfo->state == 0) {                    
                            ?>

                                <div class="d-flex">
                                    <div class='card-text text-danger text-start me-1'>Status de l'article > 
                                    </div>

                                    <div class='card-text text-danger text-center'><strong>DÉSACTIVÉ</strong>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="d-flex">
                                    <div class='card-text text-success text-start me-1'>Status de l'article > 
                                    </div>

                                    <div class='card-text text-success text-center'><strong>ACTIVÉ</strong>
                                    </div>
                                </div>
                        
                            <?php } ?>

                        </div>

                        <div class="form-group mt-3">
                            <label for="state" class="col-form-label text-info">Désactiver/Activer l'article ?</label>

                            <select name="state" class="form-outline" required>
                                <option selected value="<?= ($articleInfo->state) ?>">Options</option>

                                <option value="0">Désactiver</option>
                                <option value="1">Activer</option>
                            </select>
                        </div>

                        <!-- =============================Catégories====================== -->

                        <select value="<?= 'CATÉGORIES' .' '. ($articleInfo->categories ?? '');?>"
                                name="categories" 
                                id="categories" 
                                class="bg-transparent text-center form-control card-header">
                                    <option ></option>

                                    <?php foreach ($arrayCategories as $categoriesInSelect) {
                                        $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';
                                        echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";
                                    }?>

                        </select>
                        
                        <!-- ==============================Titre=============================== -->

                        <div class="mb-3 mt-3">
                            <input type="text" 
                                    name="title" 
                                    id="title" 
                                    class="bg-transparent text-center form-control card-header"
                                    value="<?= 'TITRE'.' '.'>'.' '. ($articleInfo->title ?? '');?>">
                        </div>

                            <!-- ============================Article============================== -->
                        <div class="mb-3">
                            <label for="article" class="col-form-label card-header">Contenu de l' article</label>
                            
                            <textarea
                                
                                name ="article" 
                                class="form-control bg-transparent card-header" 
                                id="article" 
                                rows="15"><?= htmlentities($article ?? '');?> 
                            </textarea>
                        </div>

                        <button type="submit" class="card-header btn btn-warning rounded-pill w-100">Mettre à jour</button>
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
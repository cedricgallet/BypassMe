<!-- +++++++++++++++++++++++++++++++++++++++Formulaire d'ajout d'article+++++++++++++++++++++++++++++++++++++++ -->
<div id="addArticleForm"  class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-12 login-wrap p-0 h-100">
            <div class="d-flex flex-column align-items-center justify-content-center col-12 h-100">

                <div class="d-flex ">
                    <h2 class=""><?=$title1 ?? ''?></h2>
                </div>
                        <!-- ********************Affichage d'un message d'erreur personnalisé**************** -->
                        <?php 

                        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                            if(!array_key_exists($msgCode, $displayMsg)){
                                $msgCode = 0;
                            }
                            echo '<div class="fs-3 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        } 

                        ?>

                <div class="col-12 col-lg-6 mt-3">
                    <form class="needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF']). "?id=" . $id?>" method="post">

                        <!-- *******************************Activé/Désactivé l' article***************************** -->

                        <div class="d-flex justify-content-between form-group mt-3">

                            <div>
                                <label for="state" class="col-form-label text-warning">Désactiver/Activer l'article ?</label>

                                <select name="state" class="form-outline" required>
                                    <option selected value="<?= htmlspecialchars($articleInfo->state) ?>">Options</option>

                                    <option value="0">Désactiver</option>
                                    <option value="1">Activer</option>
                                </select>
                            </div>

                            <!-- *******************************Status article***************************** -->

                            <div class="">

                                <?php
                                    if ($articleInfo->state == 0) {                    
                                ?>

                                        <div class='card-text text-danger me-1'>Status de l'article > <strong>DÉSACTIVÉ</strong>
                                        </div>

                                <?php } else { ?>

                                        <div class='card-text text-success me-1'>Status de l'article > <strong>ACTIVÉ</strong>
                                        </div>

                                <?php } ?>

                            </div>
                        </div>

                        <!-- *******************************Catégories******************************* -->

                        <select name="categories" 
                                id="categories" 
                                class="text-info text-center bg-transparent form-control" 
                                value="<?= htmlentities($categories ?? '')?>" required>

                                <option><?= 'Catégories'.' '.'>'.' '. htmlentities($categories ?? '')?></option>

                                <?php foreach ($arrayCategories as $categoriesInSelect) {
                            $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';
                            echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";}?>
                        </select>

                        <div class="invalid-feedback-2"><?= htmlentities($errorsArray['categories'] ?? '')?></div>
                        
                        <!-- *******************************Titre*******************************-->

                        <div class="mb-3 mt-3">
                            <input type="text" 
                                    name="title" 
                                    id="title" 
                                    class="bg-transparent text-center form-control text-info"
                                    value="<?= 'Titre'.' '.'>'.' '. htmlentities($title ?? '');?>">
                        </div>
                        <div class="invalid-feedback-2"><?= htmlentities($errorsArray['title'] ?? '')?></div>

                            <!-- *******************************Article******************************* -->
                        <div class="mb-3">
                            <label for="article" class="col-form-label text-warning">Contenu de l' article</label>
                            
                            <textarea
                                
                                name ="article" 
                                class="form-control bg-transparent text-info" 
                                id="article" 
                                minlength="10" 
                                maxlength="1500"
                                rows="15"><?= htmlentities($article ?? '');?> 
                            </textarea>
                        </div>
                        <div class="invalid-feedback-2"><?= htmlentities($errorsArray['article'] ?? '')?></div>


                        <button type="submit" class="card-header btn btn-warning rounded-pill w-100">Mettre à jour l'article ?</button>
                    </form>
                    
                    <!-- ********************************************************************************************************** -->

                    <div class="d-flex flex-row justify-content-between">
                        <a class="btn btn-success mt-2 rounded-pill" href="/../../admin/controllers/add-article-ctrl.php">Ajouter
                        un article ?</a>

                        <a class="btn btn-success mt-2 rounded-pill text-end" href="/../../admin/controllers/list-article-ctrl.php">Retour à la liste
                        des articles ?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
<!-- ************************************************* -->
<script src="/../../assets/js/checkConfirm.js"></script>
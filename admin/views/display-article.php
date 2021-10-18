<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-6">
            <h2 class="mt-5 mb-5 text-center"><?=$title ?? ''?></h2>

            <div class="card rounded-2">
                <div class="card-header text-center"><strong><?=htmlentities($articleInfo->categories)?></strong></div>
                <div class="card-body">

                    <?php
                        if ($articleInfo->state == 0) {                    
                    ?>

                        <div class="d-flex mb-4">
                            <div class='card-text text-danger me-1'>Status de l'article > 
                            </div>

                            <div class='card-text text-danger'><strong>DÉSACTIVÉ</strong>
                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="d-flex mb-4">
                            <div class='card-text text-success me-1'>Status de l'article > 
                            </div>

                            <div class='card-text text-success'><strong>ACTIVÉ</strong>
                            </div>
                        </div>
                
                    <?php } ?>

                    <p class="card-text"><strong>Titre - </strong>
                        <?=($articleInfo->title)?>
                    </p>

                    <p class="card-text"><strong>Article - </strong>
                        <?=($articleInfo->article)?>
                    </p>

                    <p class="card-text"><strong>Status -</strong>
                        <?=htmlentities($articleInfo->state)?>
                    </p>

                    <p class="card-text"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y', strtotime($articleInfo->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y', strtotime($articleInfo->updated_at)))?>          
                    </p>

                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="/../admin/controllers/edit-article-ctrl.php?id=<?=htmlentities($articleInfo->id)?>"
                                class="border text-info btn btn-success">Modifier l'article ?</a>
                        </div>

                        <div>
                            <a href="/../admin/controllers/list-article-ctrl.php" class="border btn btn-success">Retour à la liste
                                des articles</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
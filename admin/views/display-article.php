<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-6">
            <h2 class="mt-5 mb-5 text-center"><?=$title ?? ''?></h2>

            <div class="card rounded-2">
                <div class="text-center">
                    <div class="d-flex justify-content-start mt-3 ms-3">

                        <!-- **************************Status******************************** -->
                        <?php
                            if ($articleInfo->state == 0) {                    
                        ?>

                                <div class='card-text text-info text-start me-1'>Status du commentaire > <strong class="text-danger">DÉSACTIVÉ</strong>
                                </div>

                        <?php } else { ?>

                                <div class='card-text text-info text-start me-1'>Status du commentaire > <strong class="text-success">ACTIVÉ</strong>
                                </div>
                    
                        <?php } ?>
                        <!-- ************************************************************** -->
                        
                    </div>
                </div>

                <div class="card-body">

                    <p class="card-text text-center card-header"><strong>Catégories > </strong>
                        <?=htmlentities($articleInfo->categories)?>
                    </p>

                    <p class="mt-3 card-text"><strong>Titre - </strong>
                        <?=htmlentities($articleInfo->title)?>
                    </p>

                    <p class="card-text"><strong>Article - </strong>
                        <?=htmlentities($articleInfo->article)?>
                    </p>

                    <p class="card-text"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y', strtotime($articleInfo->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y', strtotime($articleInfo->updated_at)))?>          
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <a href="/../admin/controllers/edit-article-ctrl.php?id=<?=htmlentities($articleInfo->id)?>"
                            class="border text-info btn btn-success">Modifier l'article ?</a>
                    </div>

                    <div>
                        <a href="/../admin/controllers/list-article-ctrl.php" class="border btn btn-success">Retour à la liste
                            des articles ?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
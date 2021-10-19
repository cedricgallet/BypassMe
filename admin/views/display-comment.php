<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-6">
            <h2 class="mt-5 mb-5 text-center"><?=$title ?? ''?></h2>

            <div class="card rounded-2">
                <div class="card-header text-center"><strong><?=htmlentities($commentInfo->categories)?></strong></div>
                <div class="card-body">

                    <?php
                        if ($commentInfo->state == 0) {                    
                    ?>

                        <div class="d-flex mb-4">
                            <div class='card-text text-danger me-1'>Status du commentaire > 
                            </div>

                            <div class='card-text text-danger'><strong>DÉSACTIVÉ</strong>
                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="d-flex mb-4">
                            <div class='card-text text-success me-1'>Status du commentaire > 
                            </div>

                            <div class='card-text text-success'><strong>ACTIVÉ</strong>
                            </div>
                        </div>
                
                    <?php } ?>

                    <p class="card-text"><strong>Titre - </strong>
                        <?=($commentInfo->title)?>
                    </p>

                    <p class="card-text"><strong>Commentaire - </strong>
                        <?=($commentInfo->comment)?>
                    </p>

                    <p class="card-text"><strong>Status -</strong>
                        <?=htmlentities($commentInfo->state)?>
                    </p>

                    <p class="card-text"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y', strtotime($commentInfo->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y', strtotime($commentInfo->updated_at)))?>          
                    </p>

                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="/../admin/controllers/edit-comment-ctrl.php?id=<?=htmlentities($commentInfo->id)?>"
                                class="border text-info btn btn-success">Modifier le commentaire ?</a>
                        </div>

                        <div>
                            <a href="/../admin/controllers/list-comment-ctrl.php" class="border btn btn-success">Retour à la liste
                                des comments</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
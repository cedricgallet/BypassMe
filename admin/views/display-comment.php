<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-4">
            <h2 class="mt-5 mb-5 text-center"><?=$title1 ?? ''?></h2>

            <div class="card rounded-2">
                <div class="text-center">
                    <div class="d-flex justify-content-between mt-3 ms-3">

                        <!-- **************************Status******************************** -->
                        <?php if ($commentInfo->state == 0) { ?>

                        <div class='fs-5 card-text text-warning text-start me-1'><strong>Status du commentaire > </strong> <strong
                                class="text-danger">DÉSACTIVÉ</strong>
                        </div>

                        <?php } else { ?>

                        <div class='fs-5 card-text text-warning text-start me-1'><strong>Status du commentaire > </strong> <strong
                                class="text-success">ACTIVÉ</strong>
                        </div>

                        <?php } ?>
                        <!-- ************************************************************** -->

                        <div class="text-end">
                            <a href="/../../admin/controllers/add-comment-ctrl.php?id=<?=htmlentities($commentInfo->id)?>"><i class="fas fa-plus" title="Ajouter un commentaire"></i></a>
                            <a href="/../../admin/controllers/delete-comment-ctrl.php?id=<?=htmlentities($commentInfo->id)?>" onclick="return confirmDeleteComment();"><i class="me-2 text-danger fas fa-trash-alt" title="supprimer l'utilisateur"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <p class="card-text text-center card-header">Catégories > </Catégories>
                        <?=htmlentities($commentInfo->categories)?>
                    </p>

                    <p class="card-text mt-3"><strong>Commentaire - </strong>
                        <?=htmlentities($commentInfo->comment)?>
                    </p>

                    <p class="card-text"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($commentInfo->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($commentInfo->updated_at)))?>          
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <a href="/../../admin/controllers/edit-comment-ctrl.php?id=<?=htmlentities($commentInfo->id)?>"
                            class="border btn btn-success">Modifier le commentaire</a>
                    </div>

                    <div>
                        <a href="/../../admin/controllers/list-comment-ctrl.php" class="border btn btn-success">Retour à la
                            liste des commentaires</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- *********************************************** -->
<script src="/../../assets/js/checkConfirm.js"></script>
<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-6">
            <h2 class="mt-5 mb-5 text-center"><?=$title1 ?? ''?></h2>

            <div class="card rounded-2">
                <div class="text-center">
                    <div class="d-flex justify-content-between mt-3 ms-3">

                        <!-- **************************Status******************************** -->
                    <?php if ($articleInfo->state == 0){ ?>

                        <div class='card-text text-warning text-start me-1'><strong>Status de l'article > </strong> <strong
                                class="text-danger">DÉSACTIVÉ</strong>
                        </div>

                        <?php } else { ?>

                        <div class='card-text text-warning text-start me-1'><strong>Status de l'article > </strong> <strong
                                class="text-success">ACTIVÉ</strong>
                        </div>

                        <?php } ?>
                    </div>
                </div>
                        <!-- *********************Boutton actions 'crud'*********************************** -->

                <div class=" d-flex justify-content-center text-dark border fs-5 card-header">Actions</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-around mb-3 fs-4">
                            <a href="/../../admin/controllers/edit-article-ctrl.php?id=<?=htmlentities($articleInfo->id)?>"><i class="text-info far fa-edit" title="Modifier l' article"></i></a>
                        
                        <?php if ($articleInfo->state == 0){ ?>

                            <a href="/../admin/controllers/enableContent-ctrl.php?id=<?=htmlentities($articleInfo->id);?>" onclick="return confirmEnableArticle();"><i class="text-success far fa-check-circle" title="Activer l' article"></i></a>
                        
                        <?php } else { ?>

                            <a href="/../admin/controllers/disableContent-ctrl.php?id=<?=htmlentities($articleInfo->id);?>" onclick="return confirmDisableArticle();"><i class="text-danger fa fa-ban" title="Désactiver l' article"></i></a>
                       
                        <?php } ?>

                            <a href="/../../admin/controllers/add-article-ctrl.php?id=<?=htmlentities($articleInfo->id)?>"><i class="text fas fa-plus" title="Ajouter un article"></i></a>
                            <a href="/../../admin/controllers/delete-article-ctrl.php?id=<?=htmlentities($articleInfo->id)?>" onclick="return confirmDeleteArticle();"><i class="me-2 text-danger fas fa-trash-alt" title="supprimer l' article"></i></a>
                    </div>

                    <hr class="text-success">
                    
                    <p class="mt-3 card-text"><strong>Catégories > </strong>
                        <?=htmlentities($articleInfo->categories)?>
                    </p>

                    <hr class="text-success">

                    <p class="mt-3 card-text text-center"><strong>Titre > </strong>
                        <?=htmlentities($articleInfo->title)?>
                    </p>

                    <hr class="text-success">

                    <p class="mt-3 card-text mb-5"><strong>Article > </strong><br>
                        <?=htmlentities($articleInfo->article)?>
                    </p>

                    <hr class="text-info">

                    <p class="card-text m-0"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($articleInfo->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($articleInfo->updated_at)))?>
                    </p>
                </div>

                    <div>
                        <a href="/../../admin/controllers/list-article-ctrl.php" class="border btn btn-success">Retour à la
                            liste des articles</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- *********************************************** -->
<script src="/../../assets/js/checkConfirm.js"></script>
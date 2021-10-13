<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-6">
            <h2 class="mt-5 text-center"><?=$title ?? ''?></h2>

            <div class="card rounded-2">
                <div class="card-header text-center"><strong><?=htmlentities($commentInfo->subject)?></strong></div>
                <div class="card-body">

                    <p class="card-text"><strong>Titre - </strong>
                        <?=htmlentities($commentInfo->categories)?>
                    </p>

                    <p class="card-text"><strong>Commentaire - </strong>
                        <?=htmlentities($commentInfo->comment)?>
                    </p>

                    <p class="card-text"><strong>Status -</strong>
                        <?=htmlentities($commentInfo->state)?>
                    </p>

                    <p class="card-text"><strong>Ajouté le -</strong>
                        <?=htmlentities($commentInfo->created_at)?>

                    </p><p class="card-text"><strong>Ajouté le -</strong>
                        <?=htmlentities($commentInfo->updated_at)?>
                    </p>

                    <a href="/../admin/controllers/edit-comment-ctrl.php?id=<?=htmlentities($commentInfo->id)?>"
                        class="btn btn-primary">Modifier</a>
                    <a href="/../admin/controllers/list-comment-ctrl.php" class="btn btn-primary">Retour à la liste
                        des commentaires</a>
                </div>
            </div>
        </div>
    </div>
</div>
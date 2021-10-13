<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-6">
            <h2 class="mt-5 text-center"><?=$title ?? ''?></h2>

            <div class="card rounded-2">
                <div class="card-header text-center"><strong><?=htmlentities($articleInfo->categories)?></strong></div>
                <div class="card-body">

                    <p class="card-text"><strong>Titre - </strong>
                        <?=htmlentities($articleInfo->title)?>
                    </p>

                    <p class="card-text"><strong>Article - </strong>
                        <?=htmlentities($articleInfo->article)?>
                    </p>

                    <p class="card-text"><strong>Status -</strong>
                        <?=htmlentities($articleInfo->state)?>
                    </p>

                    <p class="card-text"><strong>Ajouté -</strong>
                        <?=htmlentities($articleInfo->created_at)?>
                    </p>

                    </p><p class="card-text"><strong>Ajouté le -</strong>
                        <?=htmlentities($articleInfo->updated_at)?>
                    </p>

                    <a href="/../admin/controllers/edit-article-ctrl.php?id=<?=htmlentities($articleInfo->id)?>"
                        class="btn btn-primary">Modifier</a>
                    <a href="/../admin/controllers/list-article-ctrl.php" class="btn btn-primary">Retour à la liste
                        des articles</a>
                </div>
            </div>
        </div>
    </div>
</div>
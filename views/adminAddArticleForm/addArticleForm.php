<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary bg-gradient text-center text-white fw-bold fs-5">
                    Nouvel Article
                </div>
                <div class="card-body">
                    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="addArticle">
                        <label for="dataList" class="form-label">Catégories</label>
                        <input class="form-control" type="text" list="datalistOptions" id="dataList"
                            placeholder="Choix catégories" 'required>
                        <datalist id="datalistOptions">
                            <option value="Faille-applicative">
                            <option value="Faille-humaine">
                            <option value="Faille-reseaux">
                            <option value="Faille-web">
                        </datalist>
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="titre" placeholder="Titre de l'article" 'required>
                        </div>
                        <div class="mb-3">
                            <label for="Textarea1" class="form-label">contenu de l'article</label>
                            <textarea class="form-control" id="textarea1" rows="3" placeholder="Tapez votre article" 'required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enregistrer</button>
                    </form>
                    <div class="border-bottom border-2 mb-2 mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

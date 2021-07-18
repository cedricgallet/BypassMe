<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgConnexion.jpg);">
    <div id="formPosition" class="row justify-content-center align-items-center h-100">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary bg-gradient text-center text-white fw-bold fs-5">
                    Ajouter un nouvel article ?
                </div>
                <div class="card-body">
                    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                        <label for="dataList" class="form-label">Catégories</label>
                        <input class="form-control" type="text" list="datalistOptions" id="article"
                            placeholder="Choix catégories" minlength="1" maxlength="600" 'required>
                        <datalist id="datalistOptions">
                            <option value="Faille-applicative">
                            <option value="Faille-humaine">
                            <option value="Faille-reseaux">
                            <option value="Faille-web">
                        </datalist>
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="titre" placeholder="Titre de l' article" 'required>
                        </div>
                        <div class="mb-3">
                            <label for="Textarea1" class="form-label">Contenu de l' article</label> <textarea
                            class="form-control" id="textarea1" rows="9" placeholder="Tapez votre article" 'required></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-warning rounded-pill w-100">Enregistrer</button>
                    </form>
                    <div class="border-bottom border-2 mb-2 mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    

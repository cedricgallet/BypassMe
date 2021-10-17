<!-- ==============================FORMULAIRE MAJ============================= -->
<div id="editUserForm" class="container-fluid h-100 p-0">
    <div class="row h-100">
        <div class="col-12 d-flex justify-content-end login-wrap p-0 h-100">
            <div class="d-flex flex-column align-items-center justify-content-center col-12 col-lg-6 h-100">
                <div class="d-flex">
                    <h2 class=""><?=$title ?? ''?></h2>
                </div>

                <!-- Affichage d'un message d'erreur personnalisé -->
                <?php 

                        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                            if(!array_key_exists($msgCode, $displayMsg)){
                                $msgCode = 0;
                            }
                            echo '<div class="d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        } 

                    ?>

            <!-- =============================CHAMP PSEUDO=============================== -->
            <form class="border needs-validation" action="<?=htmlspecialchars($_SERVER['PHP_SELF']) . "?id=" . $id?>"
                    method="post">


                    <div class="form-outline">
                        <label for="pseudo" class="col-form-label text-info">Pseudo*</label>

                        <input type="text" name="pseudo" id="pseudo" class="form-control"
                            title="Le pseudo ne doit pas contenir les caractères suivant: > <"
                            placeholder="Entrez votre pseudo" autocomplete="given-name"
                            value="<?= htmlentities($pseudo ?? '')?>" pattern="<?=REGEX_PSEUDO?>" required>

                    </div>
                    <div class="invalid-feedback-2"><?=htmlentities($errorsArray['pseudo'] ?? '')?></div>


                    <!-- ===========================CHAMP EMAIL============================== -->

                    <div class="form-outline">
                        <label for="email" class="col-form-label text-info">Adresse Email*</label>

                        <input type="email" name="email" class="form-control" id="email"
                            aria-describedby="emailHelp" placeholder="Adresse e-mail" autocomplete="email"
                            value="<?= htmlentities($email ?? '')?>" required>
                    </div>
                    <div class="invalid-feedback-2"><?= htmlentities($errorsArray['email'] ?? '')?></div>

                    <!-- ===========================Status utilisateur========================== -->

                    <div class="form-group mt-3">
                        <label for="state" class="col-form-label text-info">Désactiver l'utilisateur ?</label>

                        <select name="state" class="form-outline" required>
                            <option selected value="<?= htmlentities($state ?? '') ?>">Options</option>

                            <option value="0">Désactiver</option>
                            <option value="1">Activer</option>
                        </select>
                    </div>

                    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

                    <div class="form-outline mt-4 mb-5">
                        <button 
                                id="btnSubmit" 
                                type="submit"
                                class="form-control btn btn-warning submit px-3 rounded-pill">Mettre a jour</button>
                    </div>

                </form>
                <a class="btn btn-success" href="/../../admin/controllers/list-user-ctrl.php">Retour à la liste
                    utilisateur</a>
            </div>
        </div>
    </div>
</div>
<!-- ===============================FIN INSCRIPTION============================= -->
<script src="/../../assets/js/checkConfirm.js"></script>

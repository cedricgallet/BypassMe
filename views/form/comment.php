<?php
session_start(); // Démarrage de la session  
?>

<div id="bgImageConnexion" class="container-fluid h-100" style="background-image: url(/../assets/img/bgForm.jpg);">
    <div class="row h-100">
        <div class="col-12 d-flex justify-content-center align-items-center">
            <div class="login-wrap p-0">
                    <h2 class="text-center">Ajouter un commentaire</h2>


                    <?php 
                        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) 
                        {
                            if(!array_key_exists($msgCode, $displayMsg))
                            {
                                $msgCode = 0;
                            }
                            echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                        }
                    ?>
                
                <!-- +++++++++++++++++++++++++++++++++++++SUBJECT+++++++++++++++++++++++++++++++++++++++++++++++= -->
                <form id="signInForm" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                    <div class="form-group mt-3">
                        <div class="mb-3">

                            <select name="subject" id="subject" class="form-control" required>
                                <option value="">Choix du sujet</option>
                    <!-- ============================boucle pour choix du sujet======================================== -->
                                <?php foreach ($arraySubject as $subjectInSelect) {
                            $isSelected = ($subjectInSelect==$subject) ? 'selected': '';
                            echo "<option value=\"$subjectInSelect\" $isSelected>$subjectInSelect</option>";}?>
                            </select>
                            <div class="error"><?=$error['subject'] ?? ''?></div>
                        </div>
                    </div>

                    <!-- ============================boucle pour choix catégories======================================== -->
                    <div class="form-group">
                        <select name="categories" id="categories" class="form-control" required>
                            <option value="">Choix de la catégorie</option>

                            <?php foreach ($arrayCategories as $categoriesInSelect) {
                            $isSelected = ($categoriesInSelect==$categories) ? 'selected': '';

                            echo "<option value=\"$categoriesInSelect\" $isSelected>$categoriesInSelect</option>";}?>
                        </select>
                        <div class="error"><?=$error['categories'] ?? ''?></div>
                    </div>

                    <!-- ===================================COMMENT=============================================== -->
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="comment" class="col-form-label"></label> <textarea
                                name ="comment" class="form-control" id="comment" rows="9" placeholder="Votre message" required
                            <?= $comment ?? ''?>></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-warning rounded-pill w-100">Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
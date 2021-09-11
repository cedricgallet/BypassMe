<?php
include(dirname(__FILE__).'/../../views/templates/navbar.php');
include(dirname(__FILE__).'/../../utils/config.php');//Gestion erreur
?>

<div id="signInForm" class="container-fluid">
    <div class="row justify-content-center align-items-center h-100">
    <h2 class="d-flex justify-content-center"><?=$title ?? ''?></h2>

        <div class="col-12 col-lg-4">        
            <div class="login-wrap p-0">
                
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

                <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" class="signin-form px-4 py-3">

                    <div class="form-group">
                        <label for="email" class="col-form-label text-warning">Adresse Email*</label>
                        <input type="email" name="email" class="form-control" id="email" class="form-control"
                            placeholder="Adresse e-mail" autocomplete="email"
                            value="<?= htmlentities($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8')?>" 'required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="password" class="col-form-label text-warning">Mot de passe*</label>
                        <input type="password" name="password" class="form-control" id="password" 
                            placeholder="Votre mot de passe" autocomplete="off" minlength="8" maxlength="20" 
                            value="<?= htmlentities($_POST['password'] ?? '',)?>" 'required>
                    </div>

                    <div class="form-group mt-3">
                        <button id="btnSubmit" type="submit" class="form-control btn btn-outline-warning submit px-3 rounded-pill">Connexion</button>
                    </div>

                    <div class="form-group d-md-flex mt-2">
                        <div class="">
                            <a class="text-decoration-none text-warning" href="/../controllers/findPassword-ctrl.php" >Mot de passe oublié?</a>
                        </div>
                    </div>
                    <div class="form-group d-md-flex mt-2">
                        <div class="">
                            <a class="text-decoration-none text-warning" href="/../controllers/register-ctrl.php" >S'inscrire?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
include(dirname(__FILE__).'/../../views/templates/footer.php');
?>



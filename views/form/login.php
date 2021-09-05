<?php
require_once __DIR__.'/../../views/templates/navbar.php';
if (empty(session_id())) 
{
    session_start(); // Démarrage de la session 
}        
?>

<div id="bgImageConnexion" class="container-fluid" style="background-image: url(/../assets/img/bgForm.jpg);height:90%;">
    <div class="row justify-content-center align-items-center h-100">
    <h2 class="d-flex justify-content-center"><?=$title ?? ''?></h2>

        <div class="col-12 col-lg-4">        
            <div class="login-wrap p-0">
                <?php 
                    if(isset($_GET['login_err']))
                    {
                        $err = htmlspecialchars($_GET['login_err']);

                        switch($err)
                        {
                            case 'password':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Le mot de passe est incorrect
                                </div>
                            <?php
                            break;

                            case 'email':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> format de l'email incorrect
                                </div>
                            <?php
                            break;

                            case 'already':
                            ?>
                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Ce compte n'existe pas
                                </div>
                            <?php
                            break;

                            case 'empty':
                            ?>

                                <div class="alert alert-danger">
                                    <strong>Erreur</strong> Tous les champs sont obligatoires
                                </div>
                            <?php 
                            break;
                        }
                    }
                ?> 

                <form action="/../controllers/login-ctrl.php" method="post" class="signin-form px-4 py-3">

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
                        <button type="submit" class="form-control btn btn-outline-warning submit px-3 rounded-pill">Connexion</button>
                    </div>

                    <div class="form-group d-md-flex mt-2">
                        <div class="">
                            <a class="text-decoration-none text-warning" href="/../controllers/findPassword-ctrl.php" >Mot de passe oublié?</a>
                        </div>
                    </div>
                    <div class="form-group d-md-flex mt-2">
                        <div class="">
                            <a class="text-decoration-none text-warning" href="/../controllers/registration-ctrl.php" >S'inscrire?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__.'/../../views/templates/footer.php';
?>



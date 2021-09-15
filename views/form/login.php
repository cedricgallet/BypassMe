<?php
include(dirname(__FILE__).'/../../views/templates/header.php');
include(dirname(__FILE__).'/../../views/templates/navbar.php');
?>
    <div id="signInForm" class="container-fluid h-100">
    
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-4"> 
            <h2 class="d-flex justify-content-center">Connexion</h2>       
                <div class="login-wrap">
                    
                <div class="login-form">
                    
                    <?php 
                        if(isset($_GET['login_err']))
                        {
                            $err = htmlspecialchars($_GET['login_err']);

                            switch($err)
                            {
                                case 'success':
                                ?>
                                    <div class="alert alert-success">
                                        <strong>Succès</strong> inscription réussie!
                                    </div>
                                <?php
                                break;

                                case 'password':
                                ?>
                                    <div class="alert alert-danger">
                                        <strong>Erreur</strong> le mot de passe incorrect
                                    </div>
                                <?php
                                break;

                                case 'email':
                                ?>
                                    <div class="alert alert-danger">
                                        <strong>Erreur</strong> le format de l'email incorrect
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

                    <form action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

                        <div class="form-group">
                            <label for="email" class="col-form-label text-warning">Adresse Email*</label>
                            <input type="email" 
                                    name="email" 
                                    class="form-control" 
                                    id="email" 
                                    placeholder="Adresse e-mail" 
                                    autocomplete="email"
                                    value="<?= htmlentities($_POST['email'] ?? '')?>" 'required>
                        </div>

                        <div class="form-group mt-3">
                            <label for="password" class="col-form-label text-warning">Mot de passe*</label>
                            <input type="password" 
                                    name="password" 
                                    class="form-control" 
                                    id="password" 
                                    placeholder="Votre mot de passe" 
                                    autocomplete="off" 
                                    minlength="8" 
                                    maxlength="20" 
                                    value="<?= htmlentities($_POST['password'] ?? '')?>" 'required>
                        </div>

                        <div class="form-group mt-3">
                            <button id="btnSubmit" 
                                    type="submit" 
                                    class="form-control btn btn-outline-warning submit px-3 rounded-pill">Se connecter</button>
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

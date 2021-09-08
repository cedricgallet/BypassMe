<?php
//require_once __DIR__.'/../../views/templates/navbar.php';
//require_once __DIR__.'/../models/User.php';//models
//require_once __DIR__.'/../../utils/config.php';//Gestion erreur
?>

<!-- ===================================CHANGER AVATAR ================================= -->
<div id="landingSpace" class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <h2 class="d-flex justify-content-center align-items-center">Modifier mon avatar</h2>

        <div class="col-lg-5 p-0">

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

            <form action="layouts/change_avatar.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="avatar" class="text-warning">Images autorisées : png, jpg, jpeg, gif - 20Mo Max</label>
                    <input type="file" 
                            name="avatar_file"
                            accept="image/png, image/jpg, image/jpeg, image/gif"
                            class="text-warning">
                            
                    <button type="submit" class="btn btn-success mt-2">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once __DIR__.'/../../views/templates/footer.php';

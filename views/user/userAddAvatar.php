<!-- ===================================CHANGER AVATAR ================================= -->
    <div id="landingSpace" class="container-fluid h-100">
        <div class="row justify-content-center">
            <h2 class="d-flex justify-content-center align-items-center mt-5">Choisir mon avatar</h2>
            
                <!-- Affichage d'un message d'erreur personnalisé -->
                <?php 
                    if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
                        if(!array_key_exists($msgCode, $displayMsg)){
                            $msgCode = 0;
                        }
                        echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
                    } 

                ?>

                <!-- +++++++++++++++++++++Affichage avatar+++++++++++++++++++++++++ -->
            <div class="d-flex justify-content-center" id= "avatar">
                <img width="150" height="150" src =
                <?php 
                echo (file_exists("/../uploads/users/" . 1 . ".png")) ? "/../uploads/users/" . 1 . ".png" : "/../uploads/users/empty.png";
                ?>
                alt="">
            </div> 
                <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="d-flex justify-content-center col-lg-3 p-0">


                <form method="POST" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
                    <div class="upload-wrapper">
                        <span class="file-name">Images autorisées :<hr> png, jpeg - 2Mo Max</span>
                        <label for="file-upload">Choisir un avatar<input type="file" id="file-upload" name="uploadedFile"></label>
                    </div>

                    <input type="submit" name="uploadBtn" value="Valider">
                </form>
            </div>
        </div>
    </div>
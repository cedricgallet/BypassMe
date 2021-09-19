<!-- ===================================CHANGER AVATAR ================================= -->
    <div id="landingSpace" class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <h2 class="d-flex justify-content-center align-items-center">Choisir mon avatar</h2>
                <!-- +++++++++++++++++++++Affichage avatar+++++++++++++++++++++++++ -->
            <div class="d-flex justify-content-center" id= "avatar">
                <img width="150" height="150" src =
                <?php 
                echo (file_exists("/../uploads/avatars/" . 1 . ".png")) ? "/../uploads/avatars/" . 1 . ".png" : "/../uploads/avatars/empty.png";
                ?>
                alt = "avatar de base du tabeau de bord">
            </div> 
                <!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

            <div class="col-lg-3 p-0">


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
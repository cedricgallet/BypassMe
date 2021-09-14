<!-- ===================================CHANGER AVATAR ================================= -->
<div id="landingSpace" class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <h2 class="d-flex justify-content-center align-items-center">Ajouter un avatar</h2>

        <div class="col-lg-5 p-0">
            <form row=3 action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="avatar" class=" bg-success text-center text-warning">Images autorisées : png - 2Mo Max</label>
                    <input type="file" 
                            name="avatar_file"
                            accept="image/png"
                            class="bg-success text-warning">
                            
                    <button type="submit" class="btn btn-success mt-2">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>


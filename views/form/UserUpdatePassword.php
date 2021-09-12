<!-- ======================================UPDATE MOT DE PASSE USER=================================== -->
<div id="landingSpace" class="container-fluid h-100">
    <div class="row justify-content-center h-100">
        <h2 class="d-flex justify-content-center align-items-center">Modifier mon mot de passe</h2>

        <div class="col-lg-4 p-0">
                
            <form action="/../controllers/landingChange_password-ctrl.php" method="POST">
                <div class="mb-3">
                    <label for='current_password' class="text-warning">Mot de passe actuel*</label>                       
                    <input type="password" 
                            id="current_password" 
                            name="current_password"
                            class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for='new_password' class="text-warning">Nouveau mot de passe*</label>
                    <input type="password" 
                            id="new_password" 
                            name="new_password" 
                            class="form-control"
                            required>
                </div>

                <div class="mb-3">
                    <label for='new_password2' class="text-warning">Confirmer le nouveau mot de passe*</label>
                    <input type="password" 
                            id="new_password2" 
                            name="new_password2"
                            class="form-control" 
                            required>

                    <button type="submit" 
                            class="btn btn-success mt-2">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-4">
            <h2 class="mt-5 mb-5 text-center"><?=$title ?? ''?></h2>

            <div class="card rounded-2">
                <div class="text-center">
                    <div class="d-flex justify-content-start mt-3 ms-3">

                        <!-- **************************Status******************************** -->
                        <?php
                      if ($user->state == 0) {                    
                  ?>

                        <div class='card-text text-info text-start me-1'>Status de l'utilisateur > <strong
                                class="text-danger">DÉSACTIVÉ</strong>
                        </div>

                        <?php } else { ?>

                        <div class='card-text text-info text-start me-1'>Status de l'utilisateur > <strong
                                class="text-success">ACTIVÉ</strong>
                        </div>

                        <?php } ?>
                        <!-- ************************************************************** -->

                    </div>
                </div>

                <div class="card-body">

                    <p class="card-text text-center card-header"><strong>Pseudo > </strong>
                        <?=htmlentities($user->pseudo)?>
                    </p>

                    <p class="mt-3 card-text"><strong>Email - </strong>
                        <?=htmlentities($user->email)?>
                    </p>

                    <p class="card-text"><strong>Ip - </strong>
                        <?=htmlentities($user->ip)?>
                    </p>

                    <p class="card-text"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($user->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($user->updated_at)))?>
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <a href="/../../admin/controllers/edit-user-ctrl.php?id=<?=htmlentities($user->id)?>"
                            class="border text-info btn btn-success">Modifier l'utilisateur</a>
                    </div>

                    <div>
                        <a href="/../../admin/controllers/list-user-ctrl.php" class="border btn btn-success">Retour à la
                            liste des utilisateurs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
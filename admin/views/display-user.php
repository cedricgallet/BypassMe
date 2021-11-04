<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center">

        <!-- ******************Affichage d'un message d'erreur personnalisé******************* -->
        <?php 

        if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
            if(!array_key_exists($msgCode, $displayMsg)){
                $msgCode = 0;
            }
            echo '<div class="fs-4 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
        } 
        ?>
        <!-- ********************************************************************************* -->
        
        <div class="col-12 col-lg-6">
            <h2 class="mt-5 mb-5 text-center"><?=$title ?? ''?></h2>

            <div class="card rounded-2">
                <div class="text-center">
                    <div class="d-flex justify-content-between mt-3 ms-3">

                        <!-- **************************Status******************************** -->
                    <?php if ($user->state == 0){ ?>

                        <div class='card-text text-warning text-start me-1'><strong>Status du compte > </strong> <strong
                                class="text-danger">DÉSACTIVÉ</strong>
                        </div>

                        <?php } else { ?>

                        <div class='card-text text-warning text-start me-1'><strong>Status du compte > </strong> <strong
                                class="text-success">ACTIVÉ</strong>
                        </div>

                        <?php } ?>
                        <!-- ************************************************************** -->
                    </div>
                </div>

                <div class=" d-flex justify-content-center text-dark border fs-5 card-header">Actions</div>

                <div class="card-body">

                    <div class="d-flex justify-content-around mb-3 fs-4">
                        <a href="/../../admin/controllers/edit-user-ctrl.php?id=<?=htmlentities($user->id)?>"><i class="text-info far fa-edit" title="Modifier l'utilisateur"></i></a>
                        
                        <?php if ($user->state == 0){ ?>

                            <a href="/../admin/controllers/enableContent-ctrl.php?id=<?=htmlentities($user->id);?>" onclick="return confirmEnableUser();"><i class="text-success far fa-check-circle" title="Activer l'utilisateur"></i></a>
                        
                        <?php } else { ?>

                            <a href="/../admin/controllers/disableContent-ctrl.php?id=<?=htmlentities($user->id);?>" onclick="return confirmDisableUser();"><i class="text-danger fa fa-ban" title="Désactiver l'utilisateur"></i></a>
                       
                        <?php } ?>

                            <a href="/../../controllers/signUp-ctrl.php?id=<?=htmlentities($user->id)?>"><i class="text fas fa-plus" title="Ajouter un utilisateur"></i></a>
                            <a href="/../../admin/controllers/delete-user-ctrl.php?id=<?=htmlentities($user->id)?>" onclick="return confirmDeleteUser();"><i class="me-2 text-danger fas fa-trash-alt" title="supprimer l'utilisateur"></i></a>
                    </div>

                    <p class="card-text text-center card-header">
                        <?='Profil de'.' '.htmlentities($user->pseudo)?>
                    </p>

                    <p class="mt-3 card-text mt-3"><strong>Email - </strong>
                        <?=htmlentities($user->email)?>
                    </p>

                    <p class="mt-3 card-text"><strong>Mot de passe - </strong>
                        <?=htmlentities($user->password)?>
                    </p>

                    <p class="mt-3 card-text"><strong>Token - </strong>
                        <?=htmlentities($user->confirmation_token)?>
                    </p>

                    <p class="card-text mb-5"><strong>Ip - </strong>
                        <?=htmlentities($user->ip)?>
                    </p>

                    <hr class="tex-dark">

                    <p class="card-text m-0"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($user->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($user->updated_at)))?>
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <a href="/../../admin/controllers/list-user-ctrl.php" class="border btn btn-success">Retour à la
                            liste des utilisateurs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- *********************************************** -->
<script src="/../../assets/js/checkConfirm.js"></script>
<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row justify-content-center h-100">

        <div class="col-12 col-lg-6">
            <h2 class="mt-5 mb-5 text-center"><?=$title ?? ''?></h2>

            <div class="card rounded-2">
                <div class="text-center">
                    <div class="d-flex justify-content-between mt-3 ms-3">

                        <!-- **************************Status******************************** -->
                    <?php if ($getMessageUser->state == 0){ ?>

                        <div class='card-text text-warning text-start me-1'><strong>Status du message > </strong> <strong
                                class="text-danger">DÉSACTIVÉ</strong>
                        </div>

                        <?php } else { ?>

                        <div class='card-text text-warning text-start me-1'><strong>Status du message > </strong> <strong
                                class="text-success">ACTIVÉ</strong>
                        </div>

                        <?php } ?>
                        <!-- ************************************************************** -->
                    </div>
                </div>

                <div class=" d-flex justify-content-center text-dark border fs-5 card-header">Actions</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-around mb-3 fs-4">
                            <a href="/../../admin/controllers/edit-message-ctrl.php?id=<?=htmlentities($getMessageUser->id)?>"><i class="text-info far fa-edit" title="Modifier un message"></i></a>
                        
                        <?php if ($getMessageUser->state == 0){ ?>

                            <a href="/../admin/controllers/enableContent-ctrl.php?id=<?=htmlentities($getMessageUser->id);?>" onclick="return confirmEnableMessage();"><i class="text-success far fa-check-circle" title="Activer un message"></i></a>
                        
                        <?php } else { ?>

                            <a href="/../admin/controllers/disableContent-ctrl.php?id=<?=htmlentities($getMessageUser->id);?>" onclick="return confirmDisableMessage();"><i class="text-danger fa fa-ban" title="Désactiver un message"></i></a>
                       
                        <?php } ?>

                            <a href="/../../user/controllers/add-message-ctrl.php?id=<?=htmlentities($getMessageUser->id)?>"><i class="text fas fa-plus" title="Ajouter un message"></i></a>
                            <a href="/../../admin/controllers/delete-Message-ctrl.php?id=<?=htmlentities($getMessageUser->id)?>" onclick="return confirmDeleteMessage();"><i class="me-2 text-danger fas fa-trash-alt" title="supprimer un message"></i></a>
                    </div>

                    <p class="card-text text-center card-header">
                        <?='Message de'.' '.htmlentities($user->pseudo)?>
                    </p>

                    <p class="mt-5 card-text text-center"><strong>Sujet > </strong>
                        <?=htmlentities($getMessageUser->subject)?>
                    </p>

                    <hr class="text-success">

                    <p class="mt-3 card-text mb-5"><strong>Message > </strong><br>
                        <?=htmlentities($getMessageUser->message)?>
                    </p>

                    <hr class="text-dark">

                    <p class="mt-3 card-text m-0"><strong>Email > </strong>
                        <?=htmlentities($user->email)?>
                    </p>
                    
                    <p class="card-text m-0"><strong>Ajouté le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($getMessageUser->created_at)))?>
                    </p>

                    <p class="card-text"><strong>Dernière modification le </strong>
                        <?=htmlentities(date('d-m-Y à H:m', strtotime($getMessageUser->updated_at)))?>
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <a href="/../../admin/controllers/list-user-ctrl.php" class="border btn btn-success">Retour à la
                            liste des messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- *********************************************** -->
<script src="/../../assets/js/checkConfirm.js"></script>
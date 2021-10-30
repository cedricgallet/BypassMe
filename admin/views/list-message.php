<div id="bgGestionAdmin" class="container-fluid h-100">
    <div class="row">

        <!-- ********************************Affichage d'un message d'erreur personnalisé************************** -->
        <?php 
            if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) 
            {
                if(!array_key_exists($msgCode, $displayMsg)){
                    $msgCode = 0;
                }
                echo '<div class="fs-4 text-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
            } ?>
        <!-- ***************************************************************************************************** -->

        <h2 class="fs-1 mt-5 text-center"><?=$title1 ?? ''?></h2>

        <div class="col-12 d-flex">

            <div class="col-12 d-flex justify-content-around">
                <a href="/../../admin/controllers/list-message-ctrl.php" class="fsizeLink mt-3 text-warning"><?=$title4 ?? ''?></a>
                <a href="/../../admin/controllers/list-user-ctrl.php" class="fsizeLink mt-3 text-dark"><?=$title3 ?? ''?></a>
                <a href="/../../admin/controllers/list-article-ctrl.php" class="fsizeLink mt-3 text-warning"><?=$title2 ?? ''?></a>
                <a href="/../../admin/controllers/list-comment-ctrl.php" class="fsizeLink mt-3 text-dark"><?=$title5 ?? ''?></a>
            </div>
        </div>

        <div class="col-12 pe-4 ps-4">
            <table class="table table-hover table-responsive table-bordered">
                <caption>
                    <tr class="fs-4 text-info">
                        <th scope="col">#User</th>
                        <th scope="col">Envoyé par</th>
                        <th scope="col">#FKey</th>
                        <th scope="col">Sujet</th>
                        <th scope="col">Message</th>
                        <th scope="col">Ajouté le</th>
                        <th scope="col">Mis a jour le</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </caption>
                
                <tbody>
                    <?php 
                    $i=0;
                    foreach($getAllMessage as $AllMessage) 
                    {
                        $i++;
                        ?>
                        <tr class="text-white fs-4"><th scope="row"><?=htmlentities($AllMessage->id_message)?></th>
                        <td><?=htmlentities($AllMessage->email)?></td>
                        <td><?=htmlentities($AllMessage->id_user)?></td>
                        <td><?=htmlentities($AllMessage->subject)?></td>
                        <td><?=htmlentities($AllMessage->message)?></td>
                        <td ><?=htmlentities(date('d-m-Y à H:i:s', strtotime($AllMessage->created_at)))?></td>    
                        <td><?=htmlentities(date('d-m-Y à H:i:s', strtotime($AllMessage->updated_at)))?></td>

                        <?php
                            if($AllMessage->state == 0){
                            ?>

                                <td class='text-danger bg-dark'>Désactivé</td>

                            <?php } else { ?>
                            

                                <td class='text-success bg-dark'>Activé</td>

                        <?php } ?>

                        <td>
                        <a href="/../../admin/controllers/display-message-ctrl.php?id=<?=htmlentities($AllMessage->id)?>"><i class="text-info far fa-edit"></i></a>
                        <a href="/../../admin/controllers/delete-message-ctrl.php?id=<?=htmlentities($AllMessage->id)?>" onclick="return confirmDeleteMessage();"><i class="me-2 text-danger fas fa-trash-alt"></i></a>
                        <a href="/../controllers/add-message-ctrl.php?id=<?=htmlentities($AllMessage->id)?>"><i class=" text-success fas fa-plus"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- ************************************************* -->
<script src="/../../assets/js/checkConfirm.js"></script>
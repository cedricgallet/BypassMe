<div id="bgGestionAdmin" class="container-fluid h-100">
  <div class="row">

      <!-- *****************************Affichage d'un message d'erreur personnalisé******************************** -->
      <?php 
      if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
          if(!array_key_exists($msgCode, $displayMsg)){
              $msgCode = 0;
          }
          echo '<div class="fs-4 d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
      } ?>
      <!-- *********************************************************************************************************** -->

    <h2 class="fs-1 mt-5 mb-5 text-center"><?=$title1 ?? ''?></h2>

      <!-- *************************Lien acces listes**************************** -->
    <div class="col-12 d-flex mb-5">
        <div class="col-12 d-flex justify-content-around">
            <a href="/../../admin/controllers/list-user-ctrl.php" class="fsizeLink mt-3 text-warning"><img class="img-fluid" style="height:70px; width:70px;" src="/../../assets/img/liste-user.png" alt="logo-utilisateur" title="Liste des utilisateurs"></a>
            <a href="/../../admin/controllers/list-message-ctrl.php" class="fsizeLink mt-3 text-warning"><img class="img-fluid" style="height:70px; width:70px;" src="/../../assets/img/liste-message.jpg" alt="logo d'un message" title="Liste des messages"></a>
            <a href="/../../admin/controllers/list-article-ctrl.php" class="fsizeLink mt-3 text-warning"><img class="img-fluid" style="height:70px; width:70px;" src="/../../assets/img/Liste-article.jpg" alt="logo d'un article" title="Liste des articles"></a>
            <a href="/../../admin/controllers/list-comment-ctrl.php" class="fsizeLink mt-3 text-warning"><img class="img-fluid" style="height:70px; width:70px;" src="/../../assets/img/Liste-comment.jpg" alt="logo d'un commentaire" title="Liste des commentaires"></a>
        </div>
    </div>

    <div class="col-12 mt-4 pe-4 ps-4">
      <table class="table table-hover table-responsive table-bordered">
        <caption>
          <tr class="fs-4 card-header">
            <th scope="col">#</th>
            <th scope="col-3">Envoyé par</th>
            <th scope="col">Sujet</th>
            <th scope="col">Message</th>
            <th scope="col">Ajouté le</th>
            <th scope="col">Mis a jour le</th>
            <th scope="col">Status</th>
          </tr>
        </caption>

        <tbody>

          <?php 
          $i=0;
          foreach($getAllMessage as $getMessage) {
              $i++;
              ?>
              
              <tr class="text-white fs-4"><th scope="row"><?=htmlentities($getMessage->id)?></th>
                <td><a class="text-info" href="/../../admin/controllers/display-message-ctrl.php?id=<?=htmlentities($getMessage->id)?>"><?=htmlentities($getMessage->email)?></td></a>
                <td><a class="text-info" href="/../../admin/controllers/display-message-ctrl.php?id=<?=htmlentities($getMessage->id)?>"><?=htmlentities($getMessage->subject)?></td></a>
                <td><a class="text-info" href="/../../admin/controllers/display-message-ctrl.php?id=<?=htmlentities($getMessage->id)?>"><?=htmlentities($getMessage->message)?></td></a>
                <td><?=htmlentities(date('d-m-Y à H:i', strtotime($getMessage->created_at)))?></td></a>    
                <td><?=htmlentities(date('d-m-Y à H:i', strtotime($getMessage->updated_at)))?></td></a>

                 <?php if($getMessage->state == 0){ ?>
                  
                    <td class='bg-dark'><a href="/../../admin/controllers/enableContent-ctrl.php?id=<?=htmlentities($getMessage->id)?>" class='text-danger' title="Activer le message">Désactivé</a></td>
                  
                  <?php } else { ?>

                    <td class='bg-dark'><a href="/../../admin/controllers/disableContent-ctrl.php?id=<?=htmlentities($getMessage->id)?>" class='text-success' title="Désactiver le message">Activé</a></td>

                  <?php } ?>

              </tr>

          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- *********************************************** -->
<script src="/../../assets/js/checkConfirm.js"></script>
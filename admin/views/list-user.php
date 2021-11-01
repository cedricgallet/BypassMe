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

    <!-- **************************Recherche*********************** -->
    <div class="col-12 mb-5">
      <form class="text-center" action="" method="GET">
        <input type="text" name="s" id="s" value="<?=$s?>">
        <input type="submit" value="Rechercher">
      </form>
    </div>
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
          <tr class="fs-4 text-warning">
            <th scope="col">#</th>
            <th scope="col-3">Pseudo</th>
            <th scope="col">Email</th>
            <th scope="col">Ajouté le</th>
            <th scope="col">Mis a jour le</th>
            <th scope="col">Ip</th>
            <th scope="col">Status</th>
          </tr>
        </caption>

        <tbody>

          <?php 
          $i=0;
          foreach($allUsers as $user) {
              $i++;
              ?>
              
              <tr class="text-white fs-4"><th scope="row"><?=htmlentities($user->id)?></th>
                <td><a class="text-info" title="modifier le profil" href="/../../admin/controllers/display-user-ctrl.php?id=<?=htmlentities($user->id)?>"><?=htmlentities($user->pseudo)?></td></a>
                <td><a class="text-info" title="modifier le profil" href="/../../admin/controllers/display-user-ctrl.php?id=<?=htmlentities($user->id)?>"><?=htmlentities($user->email)?></td></a>
                <td ><?=htmlentities(date('d-m-Y à H:i', strtotime($user->created_at)))?></td>    
                <td><?=htmlentities(date('d-m-Y à H:i', strtotime($user->updated_at)))?></td>
                <td><?=htmlentities($user->ip)?></td>

                <?php
                if($user->state == 0){
                  ?>

                <td class='text-danger bg-dark'>Désactivé</td>

                  <?php
                  } else {
                  ?>

                <td class='text-success bg-dark'>Activé</td>

                <?php } ?>
              </tr>
          <?php } ?>
        </tbody>

        <!-- *****************Pagination*********************** -->
        <nav aria-label="...">
          <ul class="pagination pagination-sm">
            

              <?php
              for($i=1;$i<=$nbPages;$i++){
                if($i==$currentPage){ ?>    
                  <li class=" page-item active" aria-current="page">
                    <span class="ms-4 page-link text-info">
                      <?=$i?> 
                      <span class="visually-hidden">(current)</span>
                    </span>
                  </li>
            <?php } else { ?>
              <li class="page-item"><a class="ms-4 page-link text-info" href="?currentPage=<?=$i?>&s=<?=$s?>"><?=$i?></a></li>
            <?php } 
            }?>
          </ul>
        </nav>

      </table>
    </div>
  </div>
</div>
<!-- *********************************************** -->
<script src="/../../assets/js/checkConfirm.js"></script>
<div id="bgGestionAdmin" class="container-fluid h-100 p-0">
  <div class="row h-100">

        <!-- Affichage d'un message d'erreur personnalisé -->
      <?php 
      if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
          if(!array_key_exists($msgCode, $displayMsg)){
              $msgCode = 0;
          }
          echo '<div class="d-flex justify-content-center align-items-center alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
      } ?>
      <!-- -------------------------------------------- -->

    <h2 class="fs-1 mt-5 text-center"><?=$title1 ?? ''?></h2>

    <div class="col-12">
      <!-- +++++++++++++++++++++Recherche+++++++++++++++++ -->
      <form class="text-center" action="" method="GET">
        <input type="text" name="s" id="s" value="<?=$s?>">
        <input type="submit" value="Rechercher">
      </form>
    </div>


    <div class="col-12 d-flex justify-content-around">
      <a href="/../../admin/controllers/list-user-ctrl.php"><h2 class="mt-3"><?=$title2 ?? ''?></h2></a>
      <a href="/../../admin/controllers/list-article-ctrl.php"><h2 class="mt-3"><?=$title3 ?? ''?></h2></a>
      <a href="/../../admin/controllers/list-comment-ctrl.php"><h2 class="mt-3"><?=$title4 ?? ''?></h2></a>
    </div>

    <div class="col-12 mt-4 pe-4 ps-4">

      <table class="table table-hover table-responsive table-bordered">
        <caption>
          <tr class="fs-3">
            <th scope="col">#</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Email</th>
            <th scope="col">Ip</th>
            <th scope="col">Status</th>
            <th scope="col">Ajouté le</th>
            <th scope="col">Mis a jour le</th>
            <th scope="col">Actions</th>
          </tr>
        </caption>
        <tbody>

          <?php 
          $i=0;
          foreach($allUsers as $user) {
              $i++;
              ?>
              <tr class="text-white fs-3">
                <th scope="row"><?=htmlentities($user->id)?></th>
                <td><?=htmlentities($user->pseudo)?></td>
                <td><?=htmlentities($user->email)?></td>
                <td><?=htmlentities($user->ip)?></td>
                <td><?=htmlentities($user->state)?></td>
                <td ><?=htmlentities(date('d-m-Y', strtotime($user->created_at)))?></td>    
                <td><?=htmlentities(date('d-m-Y', strtotime($user->updated_at)))?></td>

                <td>
                <a href="/../../admin/controllers/display-user-ctrl.php?id=<?=htmlentities($user->id)?>"><i class="text-info far fa-edit"></i></a>
                <a href="/../../admin/controllers/delete-user-ctrl.php?id=<?=htmlentities($user->id)?>" onclick="return confirmDeleteUser();"><i class=" text-danger fas fa-trash-alt"></i></a>
                </td>
              </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>

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
    </div>
  </div>
</div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<script src="/../../assets/js/checkConfirm.js"></script>
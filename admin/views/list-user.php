
<div id="bgGestionAdmin" class="container-fluid h-100 p-0">
  
  <!-- Affichage d'un message d'erreur personnalisé -->
  <?php 
  if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
      if(!array_key_exists($msgCode, $displayMsg)){
          $msgCode = 0;
      }
      echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
  } ?>
  <!-- -------------------------------------------- -->

  <div class="row">
    <h2 class="mt-5 text-center"><?=$title1 ?? ''?></h2>

    <div class="col-12">

      <form class="text-center" action="" method="GET">
        <input type="text" name="s" id="s" value="<?=$s?>">
        <input type="submit" value="Rechercher">
      </form>


      <div class=""><h2 class="p-4"><?=$title2 ?? ''?></h2><div>

      <div class="col-12 p-4">

        <table class="table table-hover table-bordered">
          <caption>
            <tr class="fs-4">
              <th scope="col">#</th>
              <th scope="col">Pseudo</th>
              <th scope="col">Email</th>
              <th scope="col">Ip</th>
              <th scope="col">Status</th>
              <th scope="col">Ajouté le</th>
              <th scope="col">Mis a jour le</th>
              <th scope="col">Désactivé le</th>
              <th scope="col">Actions</th>
            </tr>
          </caption>
          <tbody>

            <?php 
            $i=0;
            foreach($allUsers as $user) {
                $i++;
                ?>
                <tr class="text-white fs-4">
                  <th scope="row"><?=htmlentities($user->id)?></th>
                  <td><?=htmlentities($user->pseudo)?></td>
                  <td><?=htmlentities($user->email)?></td>
                  <td><?=htmlentities($user->ip)?></td>
                  <td><?=htmlentities($user->state)?></td>
                  <td ><?=htmlentities(date('d-m-Y', strtotime($user->created_at)))?></td>    
                  <td><?=htmlentities(date('d-m-Y', strtotime($user->updated_at)))?></td>
                  <td><?=htmlentities(date('d-m-Y', strtotime($user->deleted_at)))?></td>

                  <td>
                  <a href="/../../admin/controllers/display-user-ctrl.php?id=<?=htmlentities($user->id)?>"><i class="text-info far fa-edit"></i></a>
                  <a href="/../../admin/controllers/delete-user-ctrl.php?id=<?=htmlentities($user->id)?>"><i class=" text-danger fas fa-trash-alt"></i></a>
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
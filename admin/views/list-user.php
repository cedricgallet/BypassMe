<!-- Affichage d'un message d'erreur personnalisé -->
<?php 
if(!empty($msgCode) || $msgCode = trim(filter_input(INPUT_GET, 'msgCode', FILTER_SANITIZE_STRING))) {
    if(!array_key_exists($msgCode, $displayMsg)){
        $msgCode = 0;
    }
    echo '<div class="alert '.$displayMsg[$msgCode]['type'].'">'.$displayMsg[$msgCode]['msg'].'</div>';
} ?>
<!-- -------------------------------------------- -->

<div class="container-fluid h-100">
  <div class="row">
  <h2 class="mt-5 text-center"><?=$title1 ?? ''?></h2>

    <div class="col-12">
      <form class="text-center" action="" method="GET">

        <input type="text" name="s" id="s" value="<?=$s?>">
        <input type="submit" value="Rechercher">

      </form>
      <div class=""><h2 class="mt-5"><?=$title2 ?? ''?></h2><div>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Ip</th>
            <th scope="col">Confirmation_token</th>
            <th scope="col">Ajouté</th>
            <th scope="col">Mis a jour</th>
            <th scope="col">Supprimé</th>
          </tr>
        </thead>
        <tbody>

          <?php 
          $i=0;
          foreach($allUsers as $user) {
              $i++;
              ?>
              <tr>
                <th scope="row"><?=htmlentities($user->id)?></th>
                <td><?=htmlentities($user->pseudo)?></td>
                <td><?=htmlentities($user->email)?></td>
                <td><?=htmlentities($user->password)?></td>
                <td><?=htmlentities($user->ip)?></td>
                <td><?=htmlentities($user->confirmation_token)?></td>
                <td><?=htmlentities($user->created_at)?></td>
                <td><?=htmlentities($user->updated_at)?></td>
                <td><?=htmlentities($user->deleted_at)?></td>

                <td>
                <a href="/../admin/controllers/display-user-ctrl.php?id=<?=htmlentities($user->id)?>"><i class="text-success far fa-edit"></i></a>
                <a href="/../admin/controllers/delete-user-ctrl.php?id=<?=htmlentities($user->id)?>"><i class=" text-danger fas fa-trash-alt"></i></a>
                </td>
              </tr>
          <?php } ?>

        </tbody>
      </table>

      <nav aria-label="...">
        <ul class="pagination pagination-sm">
          

            <?php
            for($i=1;$i<=$nbPages;$i++){
              if($i==$currentPage){ ?>    
                <li class="page-item active" aria-current="page">
                  <span class="page-link">
                    <?=$i?> 
                    <span class="visually-hidden">(current)</span>
                  </span>
                </li>
          <?php } else { ?>
            <li class="page-item"><a class="page-link" href="?currentPage=<?=$i?>&s=<?=$s?>"><?=$i?></a></li>
          <?php } 
          }?>
        </ul>
      </nav>
    </div>
  </div>
</div>
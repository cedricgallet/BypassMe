<div id="bgGestionAdmin" class="container-fluid h-100">
  <div class="row justify-content-center h-100">

    <div class="col-12 col-lg-4">
    <h2 class="mt-5 mb-5 text-center"><?=$title ?? ''?></h2>

      <div class="card rounded-2">
        <div class="card-header text-center"><strong><?=htmlentities($user->pseudo)?></strong></div>
          <div class="card-body">

            <?php
                if ($user->state == 0) {                    
            ?>

                <div class="d-flex mb-4">
                    <div class='card-text text-danger text-start me-1'>Status de l'utilisateur > 
                    </div>

                    <div class='card-text text-danger text-center'><strong>DÉSACTIVÉ</strong>
                    </div>
                </div>

            <?php } else { ?>

                <div class="d-flex mb-4">
                    <div class='card-text text-success text-start me-1'>Status de l'utilisateur > 
                    </div>

                    <div class='card-text text-success text-center'><strong>ACTIVÉ</strong>
                    </div>
                </div>
        
            <?php } ?>

            <p class="card-text"><strong>Email - </strong>
                <?=htmlentities($user->email)?>
            </p>

            <p class="card-text"><strong>Ip - </strong>
                <?=htmlentities($user->ip)?>
            </p>

            <p class="card-text"><strong>Ajouté le </strong>
              <?=htmlentities(date('d-m-Y', strtotime($user->created_at)))?>
            </p>

            <p class="card-text"><strong>Dernière modification le </strong>
              <?=htmlentities(date('d-m-Y', strtotime($user->updated_at)))?>          
            </p>

            <div class="d-flex justify-content-between">
              <div>
                  <a href="/../admin/controllers/edit-comment-ctrl.php?id=<?=htmlentities($user->id)?>"
                      class="border text-info btn btn-success">Modifier l'utilisateur</a>
              </div>
              <div>
                  <a href="/../admin/controllers/list-comment-ctrl.php" class="border btn btn-success">Retour à la liste
                      des utilisateurs</a>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



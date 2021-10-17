<div id="bgGestionAdmin" class="container-fluid h-100">
  <div class="row justify-content-center h-100">

    <div class="col-12 col-lg-3">
    <h2 class="mt-5 text-center"><?=$title ?? ''?></h2>

      <div class="card rounded-2">
        <div class="card-header text-center"><strong><?=htmlentities($user->pseudo)?></strong></div>
        <div class="card-body">

          <p class="card-text"><strong>Email - </strong>
              <?=htmlentities($user->email)?>
          </p>

          <p class="card-text"><strong>Ip - </strong>
              <?=htmlentities($user->ip)?>
          </p>

          <p class="card-text"><strong>Mot de passe -</strong>
              <?=htmlentities($user->password)?>
          </p>

          <p class="card-text"><strong>Token -</strong>
              <?=htmlentities($user->confirmation_token)?>
          </p>

          <p class="card-text"><strong>Ajouté -</strong>
              <?=htmlentities($user->created_at)?>
          </p> 

          </p><p class="card-text"><strong>Ajouté le -</strong>
              <?=htmlentities($user->updated_at)?>
          </p>

          <a href="/../admin/controllers/edit-user-ctrl.php?id=<?=htmlentities($user->id)?>" class="btn btn-primary">Modifier</a>
          <a href="/../admin/controllers/list-user-ctrl.php" class="btn btn-primary">Retour à la liste utilisateur</a>
        </div>
      </div>
    </div>
  </div>
</div>



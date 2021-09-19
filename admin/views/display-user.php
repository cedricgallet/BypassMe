<div class="card">
  <div class="card-header"><?=htmlentities($user->pseudo)?></div>
  <div class="card-body">
    <h5 class="card-title"><?=htmlentities($user->email)?></h5>

    <p class="card-text">
        <?=htmlentities($user->ip)?>
    </p>

    <p class="card-text">
        <?=htmlentities($user->password)?>
    </p>

    <p class="card-text">
        <?=htmlentities($user->confirmation_token)?>
    </p>

    <p class="card-text">
        <?=htmlentities($user->created_at)?>
    </p> 

    <a href="/controllers/edit-userCtrl.php?id=<?=htmlentities($user->id)?>" class="btn btn-primary">Modifier</a>
  </div>
</div>

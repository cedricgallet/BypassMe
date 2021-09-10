<?php
require_once(dirname(__FILE__).'/../models/User.php');

$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));
var_dump($id);
//On récupère les valeurs des proriètés de l'objet appointment/On instancie
$delete = new User();

//On invoque la méthode
$delete->deleteUser($id);


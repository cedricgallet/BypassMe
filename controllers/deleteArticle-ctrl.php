<?php
require_once(dirname(__FILE__).'/../models/Article.php');

$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//var_dump($id);

//On invoque la méthode
$delete = Article::deleteArticle($id);


<?php
session_start(); // Démarrage de la session  
require_once dirname(__FILE__).'/../models/Article.php';

if (!isset($_SESSION['user'])) 
{
    header('location:/../index.php');
}

$id = intval(trim(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT)));

//var_dump($id);

//On invoque la méthode
$delArticle = Article::deleteArticle($id);

if($delArticle) {
    header('location:/../views/landing.php?msgCode=31');
}


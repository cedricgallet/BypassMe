<?php
session_start();
require_once dirname(__FILE__) . '/../../models/User.php';//Models
require_once(dirname(__FILE__).'/../../config/config.php');//Constante + gestion erreur


$title1 = 'Gestion membres';
$title5 = 'Liste des commentaires';
$title2 = 'Liste des membres';
$title3 = 'Liste des articles';
$title4 = 'Liste des messages';

// *****************************************SECURITE ACCES PAGE******************************************
if (!isset($_SESSION['user'])) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
}

//On check si le mdp par défault est le meme que le mdp en cours
$passDefault =  password_verify(DEFAULT_PASS, $_SESSION['user']->password);
if($_SESSION['user']->email != DEFAULT_EMAIL && $passDefault != DEFAULT_PASS) {
    header('Location: /../../controllers/signIn-ctrl.php?msgCode=30'); 
    die;
        
}
// *******************************************************************************************************

// Récupération de la valeur recherchée et on nettoie
$s = trim(filter_input(INPUT_GET, 's', FILTER_SANITIZE_STRING));

// On définit le nombre d'éléments par page grâce à une constante déclarée dans config.php
$limit = NB_ELEMENTS_BY_PAGE;

// Compte le nombre d'éléments au total selon la recherche
$countItems = User::count($s);

// Calcule le nombre de pages à afficher dans la pagination
$nbPages = ceil($countItems / $limit);

// A recuperer depuis paramètre d'url. Si aucune valeur, alors vaut 1
$currentPage = intval(trim(filter_input(INPUT_GET, 'currentPage', FILTER_SANITIZE_NUMBER_INT)));

if($currentPage <= 0 || $currentPage > $nbPages){
    $currentPage = 1;
}

//Définit à partir de quel enregistrement positionner le curseur (l'offset) dans la requête
$offset = $limit*($currentPage-1);

// Appel à la méthode statique permettant de récupérer les utilisateurs selon la recherche et la pagination
$allUsers = User::getAll($s,$limit,$offset);

/* *************VUES **************************/
require_once dirname(__FILE__) .'/../../views/templates/header.php';
require_once dirname(__FILE__) .'/../../admin/views/list-user.php';


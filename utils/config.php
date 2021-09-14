<?php

define('DSN','mysql:host=localhost;dbname=LookThis;charset=utf8');
define('ROOT','cedric');
define('PASSWORD','//');

define('NB_ELEMENTS_BY_PAGE', 5);

$displayMsg = array(
    
    '0' => ['type' => 'alert-danger', 'msg' => 'Une erreur inconnue s\'est produite'],

    '1' => ['type' => 'alert-success', 'msg' => 'L\'utilisateur a bien été ajouté'],
    '2' => ['type' => 'alert-success', 'msg' => 'L\'utilisateur a bien été mis à jour'],
    '3' => ['type' => 'alert-danger', 'msg' => 'L\'utilisateur n\'a pas été trouvé'],
    '4' => ['type' => 'alert-danger', 'msg' => 'L\'utilisateur n\'a pas été enregistré en base de données'],
    '5' => ['type' => 'alert-danger', 'msg' => 'L\'utilisateur n\'a pas été mis à jour'],

    '6' => ['type' => 'alert-success', 'msg' => 'Le commentaire a bien été mis à jour'],
    '7' => ['type' => 'alert-danger', 'msg' => 'Le commentaire n\'a pas été mis à jour'],
    '8' => ['type' => 'alert-danger', 'msg' => 'Le commentaire n\'a pas été trouvé'],
    '9' => ['type' => 'alert-success', 'msg' => 'Le commentaire a bien été supprimé'],

    '10' => ['type' => 'alert-success', 'msg' => 'L\'utilisateur a bien été supprimé'],

    
    '11' => ['type' => 'alert-success', 'msg' => 'Le commentaire a bien été ajouté'],


    '12' => ['type' => 'alert-success', 'msg' => 'Inscription réussite !! 1ère Connexion'],
    

    '13' => ['type' => 'alert-danger', 'msg' => 'Le compte existe déjà'],
    '14' => ['type' => 'alert-danger', 'msg' => 'Les mots de passe sont différents'],
    '15' => ['type' => 'alert-danger', 'msg' => 'Le format du pseudo est incorrect'],
    '16' => ['type' => 'alert-danger', 'msg' => 'Le format de l\'email est incorrect'], 
    '17' => ['type' => 'alert-danger', 'msg' => 'Les emails sont dfférents'],
    '18' => ['type' => 'alert-danger', 'msg' => 'Tous les champs sont obligatoires'],
    '19' => ['type' => 'alert-danger', 'msg' => 'Le compte n\'existe pas'],
    '20' => ['type' => 'alert-danger', 'msg' => 'Le mot de passe est incorrect'],


    '21' => ['type' => 'alert-success', 'msg' => 'L\'article a bien été ajouté'],
    '22' => ['type' => 'alert-success', 'msg' => 'L\'article a bien été mis à jour'],
    '23' => ['type' => 'alert-danger', 'msg' => 'L\'article n\'a pas été trouvé'],
    '24' => ['type' => 'alert-danger', 'msg' => 'L\'article n\'a pas été enregistré en base de données'],
    '25' => ['type' => 'alert-danger', 'msg' => 'L\'article n\'a pas été mis à jour'],
    '26' => ['type' => 'alert-success', 'msg' => 'L\'article a bien été ajouté'],

    '27' => ['type' => 'alert-danger', 'msg' => 'Le format de la catégorie est incorrect'],
    '28' => ['type' => 'alert-danger', 'msg' => 'Le format du titre est incorrect'],
    '29' => ['type' => 'alert-danger', 'msg' => 'Le format de l\'article est un incorrect'],
    

    '30' => ['type' => 'alert-danger', 'msg' => 'Vous n\'avez pas accès a cette page'],


    '31' => ['type' => 'alert-danger', 'msg' => 'L\'article a bien été supprimé'],

    '32' => ['type' => 'alert-danger', 'msg' => 'Le format du sujet est incorrect'],
    '33' => ['type' => 'alert-danger', 'msg' => 'Le format de la catégorie est incorrect'],
    '34' => ['type' => 'alert-danger', 'msg' => 'Le format du commentaire est un incorrect'],


    '35' => ['type' => 'alert-success', 'msg' => 'L\'avatar a bien été ajouté'],
    '36' => ['type' => 'alert-success', 'msg' => 'L\'avatar a bien été mis à jour'],


);
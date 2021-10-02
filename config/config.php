<?php

define('DSN', 'mysql:host=localhost;dbname=LookThis');
define('LOGIN', 'cedric');
define('PASSWORD', 'Omnivore1#');
define('NB_ELEMENTS_BY_PAGE', 5);

$displayMsg = array(
    
    '0' => ['type' => 'alert-danger', 'msg' => 'Une erreur inconnue s\'est produite'],

    '1' => ['type' => 'alert-success', 'msg' => 'L\'utilisateur a bien été ajouté'],
    '2' => ['type' => 'alert-success', 'msg' => 'L\'utilisateur a bien été mis à jour'],
    '3' => ['type' => 'alert-danger', 'msg' => 'L\'utilisateur n\'a pas été trouvé'],
    '4' => ['type' => 'alert-danger', 'msg' => 'L\'utilisateur n\'a pas été enregistré en base de données'],
    '5' => ['type' => 'alert-danger', 'msg' => 'L\'utilisateur n\'a pas été mis à jour'],
    '10' => ['type' => 'alert-success', 'msg' => 'L\'utilisateur a bien été supprimé'],

    '6' => ['type' => 'alert-success', 'msg' => 'Le commentaire a bien été mis à jour'],
    '7' => ['type' => 'alert-danger', 'msg' => 'Le commentaire n\'a pas été mis à jour'],
    '8' => ['type' => 'alert-danger', 'msg' => 'Le commentaire n\'a pas été trouvé'],
    '9' => ['type' => 'alert-success', 'msg' => 'Le commentaire a bien été supprimé'],
    '11' => ['type' => 'alert-success', 'msg' => 'Le commentaire a bien été ajouté'],
    '31' => ['type' => 'alert-danger', 'msg' => 'Le commentaire n\'existe pas'],

    '32' => ['type' => 'alert-danger', 'msg' => 'Le format du sujet est incorrect'],
    '33' => ['type' => 'alert-danger', 'msg' => 'Le format de la catégorie est incorrect'],
    '34' => ['type' => 'alert-danger', 'msg' => 'Le format du commentaire est un incorrect'],


    '21' => ['type' => 'alert-success', 'msg' => 'L\'article a bien été ajouté'],
    '22' => ['type' => 'alert-success', 'msg' => 'L\'article a bien été mis à jour'],
    '23' => ['type' => 'alert-danger', 'msg' => 'L\'article n\'a pas été trouvé'],
    '24' => ['type' => 'alert-danger', 'msg' => 'L\'article n\'a pas été enregistré en base de données'],
    '25' => ['type' => 'alert-danger', 'msg' => 'L\'article n\'a pas été mis à jour'],
    '26' => ['type' => 'alert-success', 'msg' => 'L\'article a bien été ajouté'],
    '31' => ['type' => 'alert-danger', 'msg' => 'L\'article a bien été supprimé'],
    
    '27' => ['type' => 'alert-danger', 'msg' => 'Le format de la catégorie est incorrect'],
    '28' => ['type' => 'alert-danger', 'msg' => 'Le format du titre est incorrect'],
    '29' => ['type' => 'alert-danger', 'msg' => 'Le format de l\'article est un incorrect'],
    

    '12' => ['type' => 'alert-success', 'msg' => 'Inscription réussite !!'],

    
    '13' => ['type' => 'alert-danger', 'msg' => 'Ce compte existe déjà'],
    '19' => ['type' => 'alert-danger', 'msg' => 'Ce compte n\'existe pas'],
    '15' => ['type' => 'alert-danger', 'msg' => 'Le format du pseudo est incorrect'],
    '17' => ['type' => 'alert-danger', 'msg' => 'Les emails sont dfférents'],
    '16' => ['type' => 'alert-danger', 'msg' => 'Le format de l\'email est incorrect'], 
    '14' => ['type' => 'alert-danger', 'msg' => 'Les mots de passe sont différents'],
    '20' => ['type' => 'alert-danger', 'msg' => 'Le mot de passe est incorrect'],
    '18' => ['type' => 'alert-danger', 'msg' => 'Tous les champs sont obligatoires'],

    '30' => ['type' => 'alert-danger', 'msg' => 'Vous devez être connecté pour accèder a cette page'],

    '35' => ['type' => 'alert-success', 'msg' => 'Votre mot de passe a été mis a jour'],
    '36' => ['type' => 'alert-success', 'msg' => 'Votre avatar a été mis a jour'],

);
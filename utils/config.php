<?php

define('DSN','mysql:host=localhost;dbname=LookThis;charset=utf8');
define('ROOT','cedric');
define('PASSWORD','//');

$messageCode = [
    1   => ['type' => 'alert-success', 'msg' => 'L\'utilisateur à bien été ajouté.'],
    2   => ['type' => 'alert-danger', 'msg' => 'Pseudo ou mot de passe faux.'],
    3   => ['type' => 'alert-danger', 'msg' => 'L\'email existe déjà.'],
    4   => ['type' => 'alert-danger', 'msg' => 'Execution impossible.'],
    5   => ['type' => 'alert-danger', 'msg' => 'Utilisateur non trouvé.'],
    6   => ['type' => 'alert-danger', 'msg' => 'Mail déja utilisé.'],
];

$reg_err = [
    7   => ['type' => 'alert-success', 'msg' => 'L\'utilisateur à bien été ajouté.'],
    8   => ['type' => 'alert-danger', 'msg' => 'Pseudo ou mot de passe faux.'],
    9   => ['type' => 'alert-danger', 'msg' => 'L\'email existe déjà.'],
    10   => ['type' => 'alert-danger', 'msg' => 'Execution impossible.'],
    11   => ['type' => 'alert-danger', 'msg' => 'Utilisateur non trouvé.'],
    12  => ['type' => 'alert-danger', 'msg' => 'Mail déja utilisé.'],
];

$login_err = [
    13  => ['type' => 'alert-success', 'msg' => 'Le compte à bien été ajouté.'],
    14   => ['type' => 'alert-danger', 'msg' => 'Pseudo ou mot de passe faux.'],
    15   => ['type' => 'alert-danger', 'msg' => 'L\'email existe déjà.'],
    16   => ['type' => 'alert-danger', 'msg' => 'Execution impossible.'],
    17   => ['type' => 'alert-danger', 'msg' => 'Utilisateur non trouvé.'],
    18   => ['type' => 'alert-danger', 'msg' => 'Mail déja utilisé.'],
];
<?php 
    /*
        Attention ! le host => l'adresse de la base de données et non du site !!
    
        Pour ceux qui doivent spécifier le port ex : 
        $bdd = new PDO("mysql:host=HOST;dbname=DB_NAME;charset=utf8;port=3306", "LOGIN", "PASS");
        
         */
    try 
    {
        $bdd = new PDO("mysql:host=localhost;dbname=LookThis;charset=utf8", "cedric", "//");
    }
    catch(PDOException $e)
    {
        die('Erreur connexion à la base de donnée : '.$e);
    }

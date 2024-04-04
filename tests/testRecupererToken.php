<?php

//on insère le fichier qui contient les fonctions
require_once ("../include/class.pdogsb.inc.php");
require_once ("../include/fct.inc.php");
//appel de la fonction qui permet de se connecter à la base de données
$pdo= PdoGsb::getPdoGsb();

// var_dump($pdo->recupererToken('arthur.duval18@gmail.com'));
$expiration = $pdo->getDateTokenBdd('2a203357e24345f9e55e79f3548ac225');

$expirationdiff = getDateToken($expiration["expiration_token"]);
// echo $expirationdiff;
echo $expiration["expiration_token"];

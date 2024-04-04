<?php

if ($pdo->ajouteDeconnexionInitiale($_SESSION["id"])) {
    session_destroy();
    include 'vues/v_connexion.php';
    $lesfichiers = glob("/var/www/html/ATM/gsbextranetb3/portabilite/*.json");
    foreach($lesfichiers as $fichier) {
        if(is_file($fichier)) {
            unlink($fichier);
        }
    }
}







?>
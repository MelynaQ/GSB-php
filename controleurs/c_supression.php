<?php     
    $lesfichiers = glob("/var/www/html/ATM/gsbextranetb3/portabilite/*.json");
    foreach($lesfichiers as $fichier) {
        if(is_file($fichier)) {
            if (unlink($fichier)) {
                include "vues/v_ok.php";
            };
        }
    }
     
?>   
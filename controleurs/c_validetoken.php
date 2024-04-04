<?php

if(isset($_GET['token'])){
    $token = $_GET['token'];
	$expiration = $pdo->getDateTokenBdd($token);
    $dejaverif = $pdo->getVerifMail($token);
    if($expiration > 0 || $dejaverif!=0){
        include("/var/www/html/ATM/gsbextranetb3/vues/v_invalidetoken.php");
    }
    else {
        $pdo->aVerifieMail($token);
        include("/var/www/html/ATM/gsbextranetb3/vues/v_valide.php");
    }
    
}


?>
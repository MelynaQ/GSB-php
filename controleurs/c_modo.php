<?php 

if ($_SESSION["role"] == "Moderateur") {
    if(!isset($_GET['action'])){
        $_GET['action'] = 'activer';
    }
    $action = $_GET['action'];
    switch($action){
        case 'voirCommentairesAdmin' : {

            include 'vues/v_avisVisio.php';
            break;
        }
    }
}
?>
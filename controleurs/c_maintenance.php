<?php 

if ($_SESSION["role"] == "Administrateur") {
    if(!isset($_GET['action'])){
        $_GET['action'] = 'activer';
    }
    $action = $_GET['action'];
    switch($action){
        case 'activer': 
            include('vues/v_admin.php');
            if ($maintenance["active"]!=1) {
                $pdo->Maintenance(1);
                echo '<script>alert("Vous venez de mettre le site en maintenance")</script>'; 
            } else {
                echo '<script>alert("Le site est déjà en maintenance")</script>';
            }
            break;
        case 'desactiver':
            $pdo->Maintenance(0);
            include('vues/v_admin.php');
            echo '<script>alert("Vous venez d\'enlever le site en maintenance")</script>'; 
            break;
    }
}
?>
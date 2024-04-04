<?php 

if(!isset($_GET['action'])){
    $_GET['action'] = 'demandeValidation';
}

$action = $_GET['action'];
if($_SESSION["role"] == "Validateur") {
    switch($action) {
        case 'demandeValidation': 
            include('vues/v_validateur.php');
            break;
        case 'AccepteMedecin': 
            $id = $_GET['id'];
          
                $pdo->validerUser($id);
                echo "Utilisateur validé avec succès";
           
           
            
            break;
        case 'liste' :
            include('vues/v_listeavalider.php');
            break;
            case 'listecommentaires' :
                include('vues/v_listeCommentaires.php');
                break;
    
    
    }
}

?>
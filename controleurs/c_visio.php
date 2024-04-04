<?php
if(!isset($_GET['action'])){
	$_GET['action'] = 'listeViso';
    
}
$action = $_GET['action'];
switch($action){
	
	case 'listeViso':{
            include_once 'vues/v_visioList.php';
      
        break;
    };
    case'creerVisio': {
        include_once 'vues/v_creerVisio.php';
        break;
    }

    case 'validerCreation':{
        
        $nom = $_POST["nomvisio"];
        $date =$_POST["date"];
        $obj = $_POST["objectif"];
        $update = $pdo->creerVisio($nom,$obj,$date);

        if($update) {
            echo '<script language="javascript">
                alert("La visio a bien été créer");
            </script>';
            include_once 'vues/v_visioList.php';
        }

        break;
    }

    case 'modifVisio':{
        $id =$_POST["id"];
        $nouveaunom = $_POST["nom"];
        $nouvelledate =$_POST["datevisio"];
        $nouveauobj = $_POST["objectif"];
        $update = $pdo->updateVisio($id,$nouveaunom,$nouvelledate, $nouveauobj);

        if($update) {
            echo '<script language="javascript">
                alert("La visio'. $id.' a bien été mise à jour");
            </script>';
            include_once 'vues/v_visioList.php';
        }

        break;
    }

    case 'deleteVisio':{
        $id =$_GET["id"];
        $delete = $pdo->deleteVisio($id);

        if($delete) {
            echo '<script language="javascript">
                alert("La visio'. $id.' a bien été supprimée");
            </script>';
            include_once 'vues/v_visioList.php';
        }

        break;
    }
    case 'lesVisioPasse':{
        include_once "vues/v_visioPasse.php";

        break;
    }
    case 'voirAvis':{
        include_once "vues/v_avisVisio.php";

        break;
    }
    case 'LaisserAvis':{
        include_once "vues/v_formdonneAvis.php";

        break;
    }
    case 'validerdonnerAvis': {
        $idVisio = $_GET["id"];
        $idMed = $_SESSION['id'];
        $avis = $_POST["avis"];
        $note = $_POST["selectechelle"];
        $pdo->donnerAvis($idVisio,$idMed,$avis,$note);
        break;
    }
    case 'visiosaVenir': {
        include 'vues/v_visioVenir.php';
        
        break;
    }
    case 'inscrire': {
        $idVisio = $_GET["id"];
        $idMed = $_SESSION["id"];
        if($pdo->incriptionVisio($idVisio,$idMed)) {
            echo '<script language="javascript">
                alert("Vous vous êtes bien inscrit à la visio");
            </script>';
            include 'vues/v_visioVenir.php';
        } else {
            echo '<script language="javascript">
                alert("Vous êtes déjà inscrit à la visio");
            </script>';
        };
        
        break;
    }
    case 'voirCommentairesAdmin' : {

        include 'vues/v_avisVisio.php';
        break;
    }
    case 'validerUnAvis' : {

        $pdo->validerAvis($_GET['id']);
        include 'vues/v_avisVisio.php';
        break;
    }
    


}
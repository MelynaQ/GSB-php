<?php
if(!isset($_GET['action'])){
	$_GET['action'] = 'voirLesProduits';
    
}
$action = $_GET['action'];
switch($action){
	
	case 'voirLesProduits':{
          include_once 'vues/v_produit.php';
        break;
    };
    case 'ajouterProduits':{
        if($_SESSION["role"] == "ChefdeProduit") {
            include_once 'vues/v_ajouterProduit.php';
        } else {
            include_once 'vues/v_sommaire.php';
        }
        break;
    };
    case 'attenteProduits':{
        if($_SESSION["role"] == "ChefdeProduit") {
            include_once 'vues/v_attenteProduit.php';
        } else {
            include_once 'vues/v_sommaire.php';
        }
        break;
    };
    case 'ajouterLeProduit':{
        
        $nom = $_POST["nomproduit"];
        $descriptio = $_POST["desc"];
        $effets = $_POST["effetsproduit"];
        $objectifs = $_POST["objectifs"];
    
        if(isset($_FILES['image'])){
            $tmpName = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            move_uploaded_file($tmpName, '/var/www/html/ATM/gsbextranetb3/images/'.$name);
        }
        $pdo->creerProduit($nom,$descriptio,$effets,$name,$objectifs);
        
        break;
    };
    case 'validerProduit':{
        
        $id = $_GET['id'];
        $pdo->validerProduit($id);
        include_once 'vues/v_chefproduit.php';
        break;
    };
    case 'refuserProduit':{
        
        $id = $_GET['id'];
        $pdo->refuserProduit($id);
        include_once 'vues/v_chefproduit.php';

        break;
        
    };
    case 'voirLesProduitsChef':{
        
       
        include_once 'vues/v_listeProduitChef.php';
        break;
        
        
    };
    case 'modifierProduit':{
        
       
        include_once 'vues/v_modifierProduit.php';
        break;
        
        
    };
    case 'validerModif': {
        
     
        if(isset($_FILES['image'])){
            $tmpName = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $size = $_FILES['image']['size'];
            $error = $_FILES['image']['error'];
            move_uploaded_file($tmpName, '/var/www/html/ATM/gsbextranetb3/images/'.$name);
        }

        echo $id = $_POST["idproduit"];
        $nouveaunom = $_POST["nomproduit"];
        $nouvelledesc = $_POST["desc"];
        $nouveaueffets = $_POST["effetsproduit"];
        $nouvelobjectif = $_POST["objectifs"];
    
        $produitUpdate = $pdo->updateProduit($id,$nouveaunom,$nouveaueffets, $nouvelobjectif,$nouvelledesc,$name);
        include_once 'vues/v_modifierProduit.php';
        break;
    }
};





?>

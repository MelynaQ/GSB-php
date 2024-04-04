
<?php
require_once("include/fct.inc.php");
require_once ("include/class.pdogsb.inc.php");
require_once ("include/modelEmail.php");




session_start();



date_default_timezone_set('Europe/Paris');



$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();



	if(!isset($_GET['uc'])){
		$_GET['uc'] = 'connexion';
   }
   else {
	   if($_GET['uc']=="connexion" && !estConnecte()){
		   $_GET['uc'] = 'connexion';
	   }       
   }
   
   $uc = $_GET['uc'];
   switch($uc){
	   case 'connexion':{
		   include("controleurs/c_connexion.php");break;
	   }
		case 'creation':{
		   include("controleurs/c_creation.php");break;
	   }
	   case 'validetoken':{
		   include("controleurs/c_validetoken.php");break;
	   }
   
	   case 'gestionRole': {
		   include("controleurs/c_roles.php");break;
	   }
	   case 'maintenance': {
		   include("controleurs/c_maintenance.php");break;
	   }
	   case 'deconnection' : {
		include 'controleurs/c_deconnexion.php';break;
	   }
	   case 'validateur' : {
		include 'controleurs/c_validateur.php';break;
	   }
	   case 'portabilite' : {
		include("controleurs/c_droits.php");break;
	   }
	   case 'produit':{
		include("controleurs/c_produit.php");break;
		}
		case 'visio':{
			include("controleurs/c_visio.php");break;
	}

   }
	   include("vues/v_footer.php");





?>








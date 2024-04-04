<?php

/** 
 * Classe d'accÃ¨s aux donnÃ©es. 
 
 * Utilise les services de la classe PDO
 * pour l'application GSB
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 
 * @package default
 * @author Cheri Bibi
 * @version    1.0
 * @link       http://www.php.net/manual/fr/book.pdo.php
 */

class PdoGsb{   		
      	private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=gsbphp';   		
      	private static $user='gsbextranet' ;    		
      	private static $mdp='Melyna1823' ;	
	public static $monPdo;
	private static $monPdoGsb=null;
		
/**
 * Constructeur privÃ©, crÃ©e l'instance de PDO qui sera sollicitÃ©e
 * pour toutes les mÃ©thodes de la classe
 */				
	private function __construct(){
          
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
/**
 * Fonction statique qui crÃ©e l'unique instance de la classe
 
 * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
 * @return l'unique objet de la classe PdoGsb
 */
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}
/**
 * vÃ©rifie si le login et le mot de passe sont corrects
 * renvoie true si les 2 sont corrects
 * @param type $lePDO
 * @param type $login
 * @param type $pwd
 * @return bool
 * @throws Exception
 */
function checkUser($login,$pwd):bool {
    //AJOUTER TEST SUR TOKEN POUR ACTIVATION DU COMPTE
    $user=false;
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT motDePasse FROM medecin WHERE mail= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
        if (is_array($unUser)){
           if (password_verify($pwd, $unUser['motDePasse']))
                $user=true;
        }
    }
    else
        throw new Exception("erreur dans la requÃªte");
return $user;   
}


	
/**
 * Verifie si le medecin existe
 * renvoie un tableau associatif si l'utilisateur est présent
 * @param type $lePDO
 * @param type $login
 */
function donneLeMedecinByMail($login) {
    
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail,roleMedecin,mailverifie, droitConnexion,roleMedecin FROM medecin WHERE mail= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$login,PDO::PARAM_STR);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
    return $unUser;   
}

function donneLeMedecinByID($id) {
    
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail,roleMedecin,mailverifie, droitConnexion,roleMedecin FROM medecin WHERE id= :login");
    $bvc1=$monObjPdoStatement->bindValue(':login',$id);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
    return $unUser;   
}
function donnerValidateur() {
    $pdo = PdoGsb::$monPdo;
    $monObjPdoStatement=$pdo->prepare("SELECT id, nom, prenom,mail,roleMedecin,mailverifie, droitConnexion FROM medecin WHERE roleMedecin= :roleId");
    $bvc1=$monObjPdoStatement->bindValue(':roleId',4);
    if ($monObjPdoStatement->execute()) {
        $unValidateur=$monObjPdoStatement->fetch();
       
    }
    else
        throw new Exception("erreur dans la requÃªte");
    return $unValidateur;   
}
function validerUser($id) {
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE medecin SET droitConnexion = :aledroit WHERE id = :id");
    $bv1 = $pdoStatement->bindValue(':aledroit', 1);
    $bv2= $pdoStatement->bindValue(':id', $id);
    $execution = $pdoStatement->execute();
    return $execution;
}




public function tailleChampsMail(){
    

    
     $pdoStatement = PdoGsb::$monPdo->prepare("SELECT CHARACTER_MAXIMUM_LENGTH FROM INFORMATION_SCHEMA.COLUMNS
WHERE table_name = 'medecin' AND COLUMN_NAME = 'mail'");
    $execution = $pdoStatement->execute();
$leResultat = $pdoStatement->fetch();
      
      return $leResultat[0];
    
       
       
}
public function getDateTokenBdd($token) {
    $requetepdo = PdoGsb::$monPdo->prepare("SELECT expiration_token FROM medecin WHERE token = :letoken");
    $requetepdo->bindValue(':letoken', $token);
    $requetepdo->execute();
    $ladate = $requetepdo->fetch();
    if ($ladate !== false && isset($ladate['expiration_token'])) {
        $timestampBDD = strtotime($ladate['expiration_token']);
        $timestampActuel = time();
        $difference = $timestampActuel - $timestampBDD;
        $differenceEnHeures = $difference / 3600;
        return $differenceEnHeures;
    } else {
        return "Date non trouvée"; 
    }
}
public function getVerifMail($token) {  
    $requetepdo = PdoGsb::$monPdo->prepare("SELECT mailverifie FROM medecin WHERE token = :letoken");
    $requetepdo->bindValue(':letoken', $token);
    $requetepdo->execute();
    $valeur = $requetepdo->fetch();
    return $valeur[0];

}
public function aVerifieMail($token) {  
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE medecin SET mailverifie = :averifie WHERE token = :letoken");
    $bv1 = $pdoStatement->bindValue(':averifie', 1);
    $bv2= $pdoStatement->bindValue(':letoken', $token);
    $execution = $pdoStatement->execute();
    return $execution;
}


public function creeMedecin($email, $mdp, $nom, $prenom, $tel, $RPPS, $dateNaissance, $dateDiplome)
{

    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO medecin(id, mail, motDePasse, nom, prenom, telephone, RPPS, datenaissance, dateDiplome,mailverifie) 
            VALUES (null, :leMail, :leMdp, :leNom, :lePrenom, :leTel, :leRPPS, :ladateNaissance, :ladateDiplome, :mailverif)");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $bv2 = $pdoStatement->bindValue(':leMdp', $mdp);
    $bv5 = $pdoStatement->bindValue(':leNom', $nom);
    $bv6 = $pdoStatement->bindValue(':lePrenom', $prenom);
    $bv7 = $pdoStatement->bindValue(':leTel', $tel);
    $bv8 = $pdoStatement->bindValue(':leRPPS', $RPPS);
    $bv9 = $pdoStatement->bindValue(':ladateNaissance', $dateNaissance);
    $bv10 = $pdoStatement->bindValue(':ladateDiplome', $dateDiplome);
    $bv11 = $pdoStatement->bindValue(':mailverif', 0);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
public function creeAuthLigne($email)
{
    $idMed = $this->donneLeMedecinByMail($email);
    $expirationTime = date('Y-m-d H:i:s', strtotime('+300 seconds'));
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO auth_codes(idMedecin,code, expiration_time)"
            . "VALUES (:leid,:code ,:expTime)");

    $bv1 = $pdoStatement->bindValue(':leid', $idMed["id"]);
    $bv2 = $pdoStatement->bindValue(':expTime', $expirationTime);
    $bv3 = $pdoStatement->bindValue(':code',generateCode());
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function updateAuthCode($mail) {
    $code= strtolower(generateCode());
    $idMed = $this->donneLeMedecinByMail($mail);
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE auth_codes SET code = :lecode WHERE idMedecin = :leid");
    $bv1 = $pdoStatement->bindValue(':lecode', $code);
    $bv3 = $pdoStatement->bindValue(':leid', $idMed["id"]);
    $execution = $pdoStatement->execute();
    return $execution;
}
public function recupererAuthCode($mail) {
    $idMed = $this->donneLeMedecinByMail($mail);
    $monObjPdoStatement=PdoGsb::$monPdo->prepare("SELECT code, expiration_time FROM auth_codes WHERE idMedecin= :leid");
    $bvc1=$monObjPdoStatement->bindValue(':leid',$idMed["id"]);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
    }
    else {
     throw new Exception("erreur");
           
    }
    return $unUser;
}

public function insererToken($mail, $token) {
   
    $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE medecin SET token = :token ,expiration_token = :expiration WHERE mail = :mail");
    $bv1 = $pdoStatement->bindValue(':token', $token);
    $bv2 = $pdoStatement->bindValue(':expiration', $expiration);
    $bv3 = $pdoStatement->bindValue(':mail', $mail);
    $execution = $pdoStatement->execute();
    return $execution;
}


public function recupererToken($mail) {

    $monObjPdoStatement=PdoGsb::$monPdo->prepare("SELECT token,expiration_token FROM medecin WHERE mail= :lemail");
    $bvc1=$monObjPdoStatement->bindValue(':lemail',$mail);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
    }
    else {
     throw new Exception("erreur");
           
    }
    return $unUser;
}

public function testMail($email){
    $pdo = PdoGsb::$monPdo;
    $pdoStatement = $pdo->prepare("SELECT count(*) as nbMail FROM medecin WHERE mail = :leMail");
    $bv1 = $pdoStatement->bindValue(':leMail', $email);
    $execution = $pdoStatement->execute();
    $resultatRequete = $pdoStatement->fetch();
    if ($resultatRequete['nbMail']==0)
        $mailTrouve = false;
    else
        $mailTrouve=true;
    
    return $mailTrouve;
}




function connexionInitiale($mail){
     $pdo = PdoGsb::$monPdo;
    $medecin= $this->donneLeMedecinByMail($mail);
    $id = $medecin['id'];
    $this->ajouteConnexionInitiale($id);
    
}

function deconnectionInitiale($id){
    $pdo = PdoGsb::$monPdo;
    $this->ajouteDeconnexionInitiale($id);
   
}
function ajouteConnexionInitiale($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO historiqueconnexion "
            . "VALUES (:leMedecin, now(), null)");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function ajouteDeconnexionInitiale($id){
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE historiqueconnexion SET dateFinLog = now() WHERE idMedecin = :leMedecin AND dateFinLog IS NULL ");
    $bv1 = $pdoStatement->bindValue(':leMedecin', $id);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function donneinfosmedecin($id){
  
       $pdo = PdoGsb::$monPdo;
           $monObjPdoStatement=$pdo->prepare("SELECT id,nom,prenom,mail,dateNaissance,telephone FROM medecin WHERE id= :lId");
    $bvc1=$monObjPdoStatement->bindValue(':lId',$id,PDO::PARAM_INT);
    if ($monObjPdoStatement->execute()) {
        $unUser=$monObjPdoStatement->fetch();
   
    }
    else
        throw new Exception("erreur");
           
    return $unUser;
    
}
function Maintenance($status){
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE maintenance SET active = :active WHERE idMaintenance = :id");
    $bv1 = $pdoStatement->bindValue(':active', $status);
    $bv2 = $pdoStatement->bindValue(':id', 1);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function checkMaintenance(){
  
    $pdo = PdoGsb::$monPdo;
        $monObjPdoStatement=$pdo->prepare("SELECT active FROM maintenance WHERE idMaintenance= :lId");
 $bvc1=$monObjPdoStatement->bindValue(':lId',1);
 if ($monObjPdoStatement->execute()) {
     $lamaintenance=$monObjPdoStatement->fetch();

 }
 else {
     throw new Exception("erreur");
 }
 return $lamaintenance;

}
function produit(){
    $pdo = PdoGsb::$monPdo;
    $sql = "SELECT * FROM produit";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}
function creerProduit($nom,$descriptio,$effets,$img_name,$objectif){
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO produit(nom,objectif, information,effetIndesirable,img_name,estValide) "
            . "VALUES (:nom, :obj, :info,:effet,:img,:valide)");
    $bv1 = $pdoStatement->bindValue(':nom', $nom);
    $bv2= $pdoStatement->bindValue(':obj', $objectif);
    $bv3 = $pdoStatement->bindValue(':info', $descriptio);
    $bv4 = $pdoStatement->bindValue(':effet', $effets);
    $bv5 = $pdoStatement->bindValue(':img', $img_name);
    $bv6 = $pdoStatement->bindValue(':valide', 0);
    $execution = $pdoStatement->execute();
    return $execution;
    
}
function produitValides(){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("SELECT * FROM produit WHERE estValide = :valeur");
    $bv1 = $sql->bindValue(':valeur', 1);
    $sql->execute();
    return $sql->fetchAll();
}
function produitnonValides(){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("SELECT * FROM produit WHERE estValide = :valeur");
    $bv1 = $sql->bindValue(':valeur', 0);
    $sql->execute();
    return $sql->fetchAll();
}

function validerProduit($id){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("UPDATE produit SET estValide = :estValide WHERE id = :id");
    $bv1 = $sql->bindValue(':id', $id);
    $bv2 = $sql->bindValue(':estValide', 1);
    $sql->execute();
    return $sql->fetchAll();
}

function refuserProduit($id){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("DELETE FROM produit WHERE id = :id");
    $bv1 = $sql->bindValue(':id', $id);
    $sql->execute();
    return $sql->fetchAll();
}
function updateProduit($id,$nouveaunom,$nouveaueffets, $nouvelobjectif,$nouvelledesc,$nouvelleimg) {
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE produit SET nom=:nvnom, objectif=:nvobjectif, information=:nvinfo, effetIndesirable=:nveffets, img_name=:nvimg, estValide = :estValide WHERE id = :id");
    $bv1 = $pdoStatement->bindValue(':nvnom', $nouveaunom);
    $bv2 = $pdoStatement->bindValue(':id', $id);
    $bv3 = $pdoStatement->bindValue(':nvobjectif', $nouvelobjectif);
    $bv4 = $pdoStatement->bindValue(':nvinfo', $nouvelledesc);
    $bv5 = $pdoStatement->bindValue(':nveffets', $nouveaueffets);
    $bv6 = $pdoStatement->bindValue(':nvimg', $nouvelleimg);
    $bv7 = $pdoStatement->bindValue(':estValide', 0);
    $execution = $pdoStatement->execute();
    return $execution;
}
function getVisio(){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("SELECT * FROM visioconference");
    $sql->execute();
    return $sql->fetchAll();
}
function updateVisio($id,$nouveaunom,$nouvelledate, $nouveauobj) {
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE visioconference SET nomVisio=:nvnom, objectif=:nvobjectif, dateVisio=:nvdate WHERE id = :id");
    $bv1 = $pdoStatement->bindValue(':nvnom', $nouveaunom);
    $bv2 = $pdoStatement->bindValue(':id', $id);
    $bv3 = $pdoStatement->bindValue(':nvobjectif', $nouveauobj);
    $bv4 = $pdoStatement->bindValue(':nvdate', $nouvelledate);
    $execution = $pdoStatement->execute();
    return $execution;
}

function deleteVisio($id){
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("DELETE  FROM visioconference WHERE id = :id");
    $bv1 = $sql->bindValue(':id', $id);
    $exe = $sql->execute();
    return $exe;
}
function creerVisio($nom,$objectif,$date){
    $rand = rand(1,2000);
    $url = "index.php?uc=visio&action=visioconference$rand";
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO visioconference(nomVisio,objectif, dateVisio,url) "
            . "VALUES (:nom, :obj,:date,:url)");
    $bv1 = $pdoStatement->bindValue(':nom', $nom);
    $bv2= $pdoStatement->bindValue(':obj', $objectif);
    $bv3 = $pdoStatement->bindValue(':date', $date);
    $bv4 = $pdoStatement->bindValue(':url', $url);
    $execution = $pdoStatement->execute();
    if ($execution) {
        $idVisio = PdoGsb::$monPdo->lastInsertId();
        $this->creerAvisLigne($idVisio);
    }
    
    return $execution;
    
}
function creerAvisLigne($id) { 
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO avisviso(avis,idVisio) "
    . "VALUES (:avis,:id)");
    $bv1 = $pdoStatement->bindValue(':avis', "Aucun avis");
    $bv1 = $pdoStatement->bindValue(':id', $id);
    $execution = $pdoStatement->execute();
    return $execution;
}
function getAvis() {
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("SELECT * FROM avisviso WHERE estValide = :val");

    $bv4 = $sql->bindValue(':val',1);
    if ($sql->execute()) {
        $retour= $sql->fetchAll();
   
    }
    else{        
        throw new Exception("erreur");
    }
    return $retour;
}
function validerAvis($id) {
    $pdoStatement = PdoGsb::$monPdo->prepare("UPDATE avisviso SET estValide=:valide WHERE id = :id");
    $bv1 = $pdoStatement->bindValue(':valide', 1);
    $bv2 = $pdoStatement->bindValue(':id', $id);
    $execution = $pdoStatement->execute();
    return $execution;
}
function getAvisNonValide() {
    $pdo = PdoGsb::$monPdo;
    $sql = $pdo->prepare("SELECT * FROM avisviso WHERE estValide = :val");

    $bv4 = $sql->bindValue(':val',0);
    if ($sql->execute()) {
        $retour= $sql->fetchAll();
   
    }
    else{        
        throw new Exception("erreur");
    }
    return $retour;
}

function getVisioPasse() {
    $pdo = PdoGsb::$monPdo;
    $todayDate = date("Y-m-d");
    $sql = $pdo->prepare("SELECT * FROM visioconference WHERE dateVisio < :todayDate");
    $sql->bindParam(":todayDate", $todayDate);
    $sql->execute();
    return $sql->fetchAll();
}

function donnerAvis($idVisio,$idMed,$avis,$note) {
    
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO avisviso(avis,idVisio,estValide,note,idMed) "
    . "VALUES (:avis,:id,:valide,:note,:idMed)");
    $bv1 = $pdoStatement->bindValue(':avis', $avis);
    $bv2 = $pdoStatement->bindValue(':id', $idVisio);
    $bv3 = $pdoStatement->bindValue(':valide', 0);
    $bv4 = $pdoStatement->bindValue(':note', $note);
    $bv4 = $pdoStatement->bindValue(':idMed', $idMed);
    $execution = $pdoStatement->execute();
    return $execution;
    
}

function getuneVisioPasse($id) {
    $pdo = PdoGsb::$monPdo;
    $avis = 'Aucun avis';
    $sql = $pdo->prepare("SELECT avis FROM avisviso WHERE idVisio =:id and avis = :avis");
    $bv1 =$sql->bindParam(":id", $id);
    $bv2 =$sql->bindParam(":avis", $avis);
    $sql->execute();
    $retour =$sql->fetch();
    return $retour;
}
function getVisioVenir() {
    $pdo = PdoGsb::$monPdo;
    $todayDate = date("Y-m-d");
    $sql = $pdo->prepare("SELECT * FROM visioconference WHERE dateVisio > :todayDate");
    $sql->bindParam(":todayDate", $todayDate);
    $sql->execute();
    return $sql->fetchAll();
}

function incriptionVisio($idVisio,$idMed) {
    $todayDate = date("Y-m-d");
    $pdoStatement = PdoGsb::$monPdo->prepare("INSERT INTO medecinvisio(idMedecin,idVisio,dateInscription) "
    . "VALUES (:idMed,:idVisio,:date)");
    $bv1 = $pdoStatement->bindValue(':idMed', $idMed);
    $bv2 = $pdoStatement->bindValue(':idVisio', $idVisio);
    $bv3 = $pdoStatement->bindValue(':date', $todayDate);
    $execution = $pdoStatement->execute();
    return $execution;
}
function getVisioInscritePasse($idMed) {
    $pdo = PdoGsb::$monPdo;
    $todayDate = date("Y-m-d");
    $sql = $pdo->prepare("SELECT * FROM visioconference INNER JOIN medecinvisio ON medecinvisio.idVisio = visioconference.id WHERE medecinvisio.idMedecin = :id AND dateVisio < :ladate");
    $sql->bindParam(":id", $idMed);
    $sql->bindParam(":ladate", $todayDate);
    $sql->execute();
    return $sql->fetchAll();
}



}

?>
<?php
if (!$_SESSION['id'])
    header('Location: ../index.php');
else {
?>

  <body background="assets/img/laboratoire.jpg">
  <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Galaxy Swiss Bourdin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class ="nav-link" href="index.php?uc=etatFrais&action=selectionnerMois">M'inscrire à une visio</a>
        </li>
        <li class="nav-item">
          <a class ="nav-link" href="index.php?uc=portabilite&action=consulter">Droit a la portabilite</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Action visioconférences
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?uc=visio&action=listeViso">Visio</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Action produits
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?uc=produit&action=ajouterProduits">Créer un produit</a></li>
            <li><a class="dropdown-item" href="index.php?uc=produit&action=attenteProduits">Produits en attente</a></li>
            <li><a class="dropdown-item" href="index.php?uc=produit&action=voirLesProduitsChef">Liste des produits</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		  <li><a><?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?></a></li>
		  <li><a href="index.php?uc=gestionRole&action=<?php echo $_SESSION['role']?>"> <?php echo $_SESSION["role"]?></a></li>

       <li><a href="index.php?uc=deconnection&action=deconnecter">Se deconnecter</a></li>
     </ul>
    </div>
  </div>
</nav>



	
	<div class="page-content">
    	<div class="row">

<?php };?>

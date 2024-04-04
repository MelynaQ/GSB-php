<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Galaxy Swiss Bourdin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class ="nav-link" href="index.php?uc=visio&action=visiosaVenir">M'inscrire à une visio</a>
        </li>
        <li class="nav-item">
          <a class ="nav-link" href="index.php?uc=portabilite&action=consulter">Droit a la portabilite</a>
        </li>
        <li class="nav-item">
          <a class ="nav-link" href="index.php?uc=produit&action=voirLesProduits">Consulter les produits</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Visioconférences
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?uc=visio&action=lesVisioPasse">Visio passées</a></li>
            <li><a class="dropdown-item" href="index.php?uc=visio&action=visiosaVenir">Visio à venir</a></li>
            <?php
            if($_SESSION["role"] == 'Medecin') {

              echo '<li><a class="dropdown-item" href="index.php?uc=visio&action=voirAvis">Avis visio</a></li>';

            } else {
              echo '<li><a class="dropdown-item" href="index.php?uc=visio&action=voirCommentairesAdmin">Commentaires à valider</a></li>';

            }
            
            ?>
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
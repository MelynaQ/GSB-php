<!DOCTYPE html>
<html lang="en">
<head>
    <title>GSB -extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
</head>

<body background="assets/img/laboratoire.jpg">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Galaxy Swiss Bourdin</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        
       
        <li class="active"><a href="index.php?uc=maintenance&action=activer">Mettre en maintenance</a></li> 
        <li class="active"><a href="index.php?uc=maintenance&action=desactiver">Enlever la maintenance</a></li>
        <li class="active"><a href="index.php?uc=maintenance&action=voirOperations">Gérer les opérations</a></li> 
        <li class="active"><a href="index.php?uc=visio&action=voirCommentairesAdmin">Commentaires à valider</a></li>
         
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<li><a><?php echo $_SESSION['prenom']."  ".$_SESSION['nom']?></a></li>
		<li><a href="index.php?uc=gestionRole&action=admin"> <?php echo $_SESSION["role"]?></a></li>
    <li><a href="index.php?uc=deconnection&action=deconnecter">Se deconnecter</a></li>
     </ul>
    </div>
  </div>
</nav>



	
	<div class="page-content">
    	<div class="row">

</body>
</html>
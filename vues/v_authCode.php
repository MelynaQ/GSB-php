<html>
<head>
    <title>GSB - Authentification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
</head>
<body background="assets/img/laboratoire.jpg">
<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<div class="box">
					<div class="content-wrap">
						<legend>Entrez le code reçu par mail</legend>
							<form method="post" action="index.php?uc=connexion&action=valideAuthCode">
                            <div class="row mb-4">
                                <div class="col-md-3 col-md-0 col-2 ps-0 ps-md-2">
                                    <input maxlength="1" id ="num1" name="num1" type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa">
                                </div>
                                <div class="col-lg-3 col-md-2 col-2 ps-0 ps-md-2">
                                    <input maxlength="1" id="num2" name="num2" type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa">
                                </div>
                                <div class="col-lg-3 col-md-2 col-2 ps-0 ps-md-2">
                                    <input maxlength="1" id="num3" name="num3" type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa">
                                </div>
                                <div class="col-lg-3 col-md-2 col-2 pe-0 pe-md-2">
                                    <input  maxlength="1" id="num4" name="num4" type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa">
                                </div>
                                <div class="col-lg-3 col-md-2 col-2 pe-0 pe-md-2">
                                    <input maxlength="1" id="num5" name="num5" type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa">
                                </div>
                                <div class="col-lg-3 col-md-2 col-2 pe-0 pe-md-2">
                                    <input maxlength="1" id="num6" name="num6" type="text" class="form-control text-lg text-center" placeholder="_" aria-label="2fa">
                                </div>
                            </div>
                            <br>
							<input type="submit" class="btn btn-primary signup" value="Valider le code">
							</form>
                            <a href="">Renvoyer le code</a>
                        <br/>           
                    </div>	
                                     
                                    
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<script>
    document.getElementById("num1").addEventListener("input", function() {
            // Si la valeur du champ 1 est entrée, passez au champ 2
        if (this.value.trim() !== "") {
            document.getElementById("num2").focus();
        }
    });
    document.getElementById("num2").addEventListener("input", function() {
            // Si la valeur du champ 1 est entrée, passez au champ 2
        if (this.value.trim() !== "") {
            document.getElementById("num3").focus();
        }
    });
    document.getElementById("num3").addEventListener("input", function() {
            // Si la valeur du champ 1 est entrée, passez au champ 2
        if (this.value.trim() !== "") {
            document.getElementById("num4").focus();
        }
    });
    document.getElementById("num4").addEventListener("input", function() {
            // Si la valeur du champ 1 est entrée, passez au champ 2
        if (this.value.trim() !== "") {
            document.getElementById("num5").focus();
        }
    });
    document.getElementById("num5").addEventListener("input", function() {
            // Si la valeur du champ 1 est entrée, passez au champ 2
        if (this.value.trim() !== "") {
            document.getElementById("num6").focus();
        }
    });



</script>
<?php
if(!isset($_GET['action'])){
	$_GET['action'] = 'demandeCreation';
    
}
$action = $_GET['action'];
switch($action){
	
	case 'demandeCreation':{
		include("vues/v_creation.php");
		break;
	}
	case 'valideCreation':{
		
    $datenaissance = strip_tags($_POST['datenaissance']);
    $nom = strip_tags($_POST['nom']);
    $prenom = strip_tags($_POST['prenom']);
    $tel = strip_tags($_POST['numerodetelephone']);
    $RPPS = strip_tags($_POST['RPPS']);
    $dateDiplome = strip_tags($_POST['Datedediplome']);
		$leLogin = strip_tags($_POST['login']);
    $lePassword = strip_tags($_POST['mdp']);
       
        if(!isset($_POST['acceptepolitquecheckbox'])) {
            $politiqueOk = false;
            echo "Vous avez pas accepté la politique";
        }
        else {
            $politiqueOk = true;

        }
        
        
        if ($leLogin == strip_tags($_POST['login']))
        {
             $loginOk = true;
             $passwordOk=true;
        }
        else{
            echo 'tentative d\'injection javascript - login refusé';
             $loginOk = false;
             $passwordOk=false;
        }
        //test récup données
        //echo $leLogin.' '.$lePassword;
        $rempli=false;
        if ($loginOk && $passwordOk){
        //obliger l'utilisateur à saisir login/mdp
        $rempli=true; 
        if (empty($leLogin)==true) {
            echo 'Le login n\'a pas été saisi<br/>';
            $rempli=false;
        }
        if (empty($lePassword)==true){
            echo 'Le mot de passe n\'a pas été saisi<br/>';
            $rempli=false; 
        }
        
        
        //si le login et le mdp contiennent quelque chose
        // on continue les vérifications
        if ($rempli){
            //supprimer les espaces avant/après saisie
            $leLogin = trim($leLogin);
            $lePassword = trim($lePassword);

            

            //vérification de la taille du champs
            
            $nbCarMaxLogin = $pdo->tailleChampsMail();
            if(strlen($leLogin)>$nbCarMaxLogin){
                 echo 'Le login ne peut contenir plus de '.$nbCarMaxLogin.'<br/>';
                $loginOk=false;
                
            }
            
            //vérification du format du login
           if (!filter_var($leLogin, FILTER_VALIDATE_EMAIL)) {
                echo 'le mail n\'a pas un format correct<br/>';
                $loginOk=false;
            }
            
          
            $patternPassword='#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W){12,}#';
            if (preg_match($patternPassword, $lePassword)==false){
                echo 'Le mot de passe doit contenir au moins 12 caractères, une majuscule,'
                . ' une minuscule et un caractère spécial<br/>';
                $passwordOk=false;
            }
            
            // 
            $testmail = $pdo->testMail($leLogin);
            if( $testmail== true) {
                echo 'Vous êtes déjà inscrit';
                $dejainscrit = true;
                $loginOk = false;
            } else {
                
                $dejainscrit =false;
            }
            
                 
        }
        }
       
     

        if($rempli && $loginOk && $passwordOk && $politiqueOk && !$dejainscrit){
                $passwordHash = password_hash($lePassword, PASSWORD_DEFAULT); 
                echo 'tout est ok, nous allons pouvoir créer votre compte...<br/>';
                $executionOK = $pdo->creeMedecin($leLogin,$passwordHash,$nom,$prenom,$tel,$RPPS,$datenaissance,$dateDiplome);       

                if ($executionOK==true){
                    echo "c'est bon, votre compte a bien été créé ;-)";
                    $pdo->connexionInitiale($leLogin);
                    $token = genrerToken();
                    $pdo->creeAuthLigne($leLogin);
                    $pdo->insererToken($leLogin,$token);
                    $emailModel = new EmailModel();
                    $result = $emailModel->sendEmail($leLogin, "Verifiez votre adresse mail", '<!doctype html>
                    <html>
                      <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <title>Simple Transactional Email</title>
                        <style>
                          /* -------------------------------------
                              GLOBAL RESETS
                          ------------------------------------- */
                          
                          /*All the styling goes here*/
                          
                          img {
                            border: none;
                            -ms-interpolation-mode: bicubic;
                            max-width: 100%; 
                          }
                    
                          body {
                            background-color: #f6f6f6;
                            font-family: sans-serif;
                            -webkit-font-smoothing: antialiased;
                            font-size: 14px;
                            line-height: 1.4;
                            margin: 0;
                            padding: 0;
                            -ms-text-size-adjust: 100%;
                            -webkit-text-size-adjust: 100%; 
                          }
                    
                          table {
                            border-collapse: separate;
                            mso-table-lspace: 0pt;
                            mso-table-rspace: 0pt;
                            width: 100%; }
                            table td {
                              font-family: sans-serif;
                              font-size: 14px;
                              vertical-align: top; 
                          }
                    
                          /* -------------------------------------
                              BODY & CONTAINER
                          ------------------------------------- */
                    
                          .body {
                            background-color: #f6f6f6;
                            width: 100%; 
                          }
                    
                          /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                          .container {
                            display: block;
                            margin: 0 auto !important;
                            /* makes it centered */
                            max-width: 580px;
                            padding: 10px;
                            width: 580px; 
                          }
                    
                          /* This should also be a block element, so that it will fill 100% of the .container */
                          .content {
                            box-sizing: border-box;
                            display: block;
                            margin: 0 auto;
                            max-width: 580px;
                            padding: 10px; 
                          }
                    
                          /* -------------------------------------
                              HEADER, FOOTER, MAIN
                          ------------------------------------- */
                          .main {
                            background: #ffffff;
                            border-radius: 3px;
                            width: 100%; 
                          }
                    
                          .wrapper {
                            box-sizing: border-box;
                            padding: 20px; 
                          }
                    
                          .content-block {
                            padding-bottom: 10px;
                            padding-top: 10px;
                          }
                    
                          .footer {
                            clear: both;
                            margin-top: 10px;
                            text-align: center;
                            width: 100%; 
                          }
                            .footer td,
                            .footer p,
                            .footer span,
                            .footer a {
                              color: #999999;
                              font-size: 12px;
                              text-align: center; 
                          }
                    
                          /* -------------------------------------
                              TYPOGRAPHY
                          ------------------------------------- */
                          h1,
                          h2,
                          h3,
                          h4 {
                            color: #000000;
                            font-family: sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            margin: 0;
                            margin-bottom: 30px; 
                          }
                    
                          h1 {
                            font-size: 35px;
                            font-weight: 300;
                            text-align: center;
                            text-transform: capitalize; 
                          }
                    
                          p,
                          ul,
                          ol {
                            font-family: sans-serif;
                            font-size: 14px;
                            font-weight: normal;
                            margin: 0;
                            margin-bottom: 15px; 
                          }
                            p li,
                            ul li,
                            ol li {
                              list-style-position: inside;
                              margin-left: 5px; 
                          }
                    
                          a {
                            color: #3498db;
                            text-decoration: underline; 
                          }
                    
                          /* -------------------------------------
                              BUTTONS
                          ------------------------------------- */
                          .btn {
                            box-sizing: border-box;
                            width: 100%; }
                            .btn > tbody > tr > td {
                              padding-bottom: 15px; }
                            .btn table {
                              width: auto; 
                          }
                            .btn table td {
                              background-color: #ffffff;
                              border-radius: 5px;
                              text-align: center; 
                          }
                            .btn a {
                              background-color: #ffffff;
                              border: solid 1px #3498db;
                              border-radius: 5px;
                              box-sizing: border-box;
                              color: #3498db;
                              cursor: pointer;
                              display: inline-block;
                              font-size: 14px;
                              font-weight: bold;
                              margin: 0;
                              padding: 12px 25px;
                              text-decoration: none;
                              text-transform: capitalize; 
                          }
                    
                          .btn-primary table td {
                            background-color: #3498db; 
                          }
                    
                          .btn-primary a {
                            background-color: #3498db;
                            border-color: #3498db;
                            color: #ffffff; 
                          }
                    
                          /* -------------------------------------
                              OTHER STYLES THAT MIGHT BE USEFUL
                          ------------------------------------- */
                          .last {
                            margin-bottom: 0; 
                          }
                    
                          .first {
                            margin-top: 0; 
                          }
                    
                          .align-center {
                            text-align: center; 
                          }
                    
                          .align-right {
                            text-align: right; 
                          }
                    
                          .align-left {
                            text-align: left; 
                          }
                    
                          .clear {
                            clear: both; 
                          }
                    
                          .mt0 {
                            margin-top: 0; 
                          }
                    
                          .mb0 {
                            margin-bottom: 0; 
                          }
                    
                          .preheader {
                            color: transparent;
                            display: none;
                            height: 0;
                            max-height: 0;
                            max-width: 0;
                            opacity: 0;
                            overflow: hidden;
                            mso-hide: all;
                            visibility: hidden;
                            width: 0; 
                          }
                    
                          .powered-by a {
                            text-decoration: none; 
                          }
                    
                          hr {
                            border: 0;
                            border-bottom: 1px solid #f6f6f6;
                            margin: 20px 0; 
                          }
                    
                          /* -------------------------------------
                              RESPONSIVE AND MOBILE FRIENDLY STYLES
                          ------------------------------------- */
                          @media only screen and (max-width: 620px) {
                            table.body h1 {
                              font-size: 28px !important;
                              margin-bottom: 10px !important; 
                            }
                            table.body p,
                            table.body ul,
                            table.body ol,
                            table.body td,
                            table.body span,
                            table.body a {
                              font-size: 16px !important; 
                            }
                            table.body .wrapper,
                            table.body .article {
                              padding: 10px !important; 
                            }
                            table.body .content {
                              padding: 0 !important; 
                            }
                            table.body .container {
                              padding: 0 !important;
                              width: 100% !important; 
                            }
                            table.body .main {
                              border-left-width: 0 !important;
                              border-radius: 0 !important;
                              border-right-width: 0 !important; 
                            }
                            table.body .btn table {
                              width: 100% !important; 
                            }
                            table.body .btn a {
                              width: 100% !important; 
                            }
                            table.body .img-responsive {
                              height: auto !important;
                              max-width: 100% !important;
                              width: auto !important; 
                            }
                          }
                    
                          /* -------------------------------------
                              PRESERVE THESE STYLES IN THE HEAD
                          ------------------------------------- */
                          @media all {
                            .ExternalClass {
                              width: 100%; 
                            }
                            .ExternalClass,
                            .ExternalClass p,
                            .ExternalClass span,
                            .ExternalClass font,
                            .ExternalClass td,
                            .ExternalClass div {
                              line-height: 100%; 
                            }
                            .apple-link a {
                              color: inherit !important;
                              font-family: inherit !important;
                              font-size: inherit !important;
                              font-weight: inherit !important;
                              line-height: inherit !important;
                              text-decoration: none !important; 
                            }
                            #MessageViewBody a {
                              color: inherit;
                              text-decoration: none;
                              font-size: inherit;
                              font-family: inherit;
                              font-weight: inherit;
                              line-height: inherit;
                            }
                            .btn-primary table td:hover {
                              background-color: #34495e !important; 
                            }
                            .btn-primary a:hover {
                              background-color: #34495e !important;
                              border-color: #34495e !important; 
                            } 
                          }
                    
                        </style>
                      </head>
                      <body>
                        <span class="preheader">Validez votre adresse e-mail.</span>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                          <tr>
                            <td>&nbsp;</td>
                            <td class="container">
                              <div class="content">
                    
                                <!-- START CENTERED WHITE CONTAINER -->
                                <table role="presentation" class="main">
                    
                                  <!-- START MAIN CONTENT AREA -->
                                  <tr>
                                    <td class="wrapper">
                                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td>
                                            <p>Bonjour,</p>
                                            <p>Vous venez de créer un compte sur notre site GSB</p>
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                              <tbody>
                                                <tr>
                                                  <td align="left">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                      <tbody>
                                                        <tr>
                                                          <td> <a href="http://s5-4257.nuage-peda.fr/ATM/gsbextranetb3/index.php?uc=validetoken&token='.$token.'" target="_blank">Cliquez ici pour valider votre e-mail</a> </td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                    
                                <!-- END MAIN CONTENT AREA -->
                                </table>
                                <!-- END CENTERED WHITE CONTAINER -->
                    
                                <!-- START FOOTER -->
                                <div class="footer">
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td class="content-block">
                                        <span class="apple-link">Grand Swiss Bourdin</span>
                                .
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <!-- END FOOTER -->
                    
                              </div>
                            </td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </body>
                    </html>');
                    $dataValidateur = $pdo->donnerValidateur();
                    if($dataValidateur) {

                      $mailValidateur = $dataValidateur["mail"];
                    }
                    $emailEnvoiValidateur = new EmailModel();
                    $validation = $emailEnvoiValidateur->sendEmail($mailValidateur, "Un nouveau medecin souhaite etre valide", '<!doctype html>
                    <html>
                      <head>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <title>Simple Transactional Email</title>
                        <style>
                          /* -------------------------------------
                              GLOBAL RESETS
                          ------------------------------------- */
                          
                          /*All the styling goes here*/
                          
                          img {
                            border: none;
                            -ms-interpolation-mode: bicubic;
                            max-width: 100%; 
                          }
                    
                          body {
                            background-color: #f6f6f6;
                            font-family: sans-serif;
                            -webkit-font-smoothing: antialiased;
                            font-size: 14px;
                            line-height: 1.4;
                            margin: 0;
                            padding: 0;
                            -ms-text-size-adjust: 100%;
                            -webkit-text-size-adjust: 100%; 
                          }
                    
                          table {
                            border-collapse: separate;
                            mso-table-lspace: 0pt;
                            mso-table-rspace: 0pt;
                            width: 100%; }
                            table td {
                              font-family: sans-serif;
                              font-size: 14px;
                              vertical-align: top; 
                          }
                    
                          /* -------------------------------------
                              BODY & CONTAINER
                          ------------------------------------- */
                    
                          .body {
                            background-color: #f6f6f6;
                            width: 100%; 
                          }
                    
                          /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                          .container {
                            display: block;
                            margin: 0 auto !important;
                            /* makes it centered */
                            max-width: 580px;
                            padding: 10px;
                            width: 580px; 
                          }
                    
                          /* This should also be a block element, so that it will fill 100% of the .container */
                          .content {
                            box-sizing: border-box;
                            display: block;
                            margin: 0 auto;
                            max-width: 580px;
                            padding: 10px; 
                          }
                    
                          /* -------------------------------------
                              HEADER, FOOTER, MAIN
                          ------------------------------------- */
                          .main {
                            background: #ffffff;
                            border-radius: 3px;
                            width: 100%; 
                          }
                    
                          .wrapper {
                            box-sizing: border-box;
                            padding: 20px; 
                          }
                    
                          .content-block {
                            padding-bottom: 10px;
                            padding-top: 10px;
                          }
                    
                          .footer {
                            clear: both;
                            margin-top: 10px;
                            text-align: center;
                            width: 100%; 
                          }
                            .footer td,
                            .footer p,
                            .footer span,
                            .footer a {
                              color: #999999;
                              font-size: 12px;
                              text-align: center; 
                          }
                    
                          /* -------------------------------------
                              TYPOGRAPHY
                          ------------------------------------- */
                          h1,
                          h2,
                          h3,
                          h4 {
                            color: #000000;
                            font-family: sans-serif;
                            font-weight: 400;
                            line-height: 1.4;
                            margin: 0;
                            margin-bottom: 30px; 
                          }
                    
                          h1 {
                            font-size: 35px;
                            font-weight: 300;
                            text-align: center;
                            text-transform: capitalize; 
                          }
                    
                          p,
                          ul,
                          ol {
                            font-family: sans-serif;
                            font-size: 14px;
                            font-weight: normal;
                            margin: 0;
                            margin-bottom: 15px; 
                          }
                            p li,
                            ul li,
                            ol li {
                              list-style-position: inside;
                              margin-left: 5px; 
                          }
                    
                          a {
                            color: #3498db;
                            text-decoration: underline; 
                          }
                    
                          /* -------------------------------------
                              BUTTONS
                          ------------------------------------- */
                          .btn {
                            box-sizing: border-box;
                            width: 100%; }
                            .btn > tbody > tr > td {
                              padding-bottom: 15px; }
                            .btn table {
                              width: auto; 
                          }
                            .btn table td {
                              background-color: #ffffff;
                              border-radius: 5px;
                              text-align: center; 
                          }
                            .btn a {
                              background-color: #ffffff;
                              border: solid 1px #3498db;
                              border-radius: 5px;
                              box-sizing: border-box;
                              color: #3498db;
                              cursor: pointer;
                              display: inline-block;
                              font-size: 14px;
                              font-weight: bold;
                              margin: 0;
                              padding: 12px 25px;
                              text-decoration: none;
                              text-transform: capitalize; 
                          }
                    
                          .btn-primary table td {
                            background-color: #3498db; 
                          }
                    
                          .btn-primary a {
                            background-color: #3498db;
                            border-color: #3498db;
                            color: #ffffff; 
                          }
                    
                          /* -------------------------------------
                              OTHER STYLES THAT MIGHT BE USEFUL
                          ------------------------------------- */
                          .last {
                            margin-bottom: 0; 
                          }
                    
                          .first {
                            margin-top: 0; 
                          }
                    
                          .align-center {
                            text-align: center; 
                          }
                    
                          .align-right {
                            text-align: right; 
                          }
                    
                          .align-left {
                            text-align: left; 
                          }
                    
                          .clear {
                            clear: both; 
                          }
                    
                          .mt0 {
                            margin-top: 0; 
                          }
                    
                          .mb0 {
                            margin-bottom: 0; 
                          }
                    
                          .preheader {
                            color: transparent;
                            display: none;
                            height: 0;
                            max-height: 0;
                            max-width: 0;
                            opacity: 0;
                            overflow: hidden;
                            mso-hide: all;
                            visibility: hidden;
                            width: 0; 
                          }
                    
                          .powered-by a {
                            text-decoration: none; 
                          }
                    
                          hr {
                            border: 0;
                            border-bottom: 1px solid #f6f6f6;
                            margin: 20px 0; 
                          }
                    
                          /* -------------------------------------
                              RESPONSIVE AND MOBILE FRIENDLY STYLES
                          ------------------------------------- */
                          @media only screen and (max-width: 620px) {
                            table.body h1 {
                              font-size: 28px !important;
                              margin-bottom: 10px !important; 
                            }
                            table.body p,
                            table.body ul,
                            table.body ol,
                            table.body td,
                            table.body span,
                            table.body a {
                              font-size: 16px !important; 
                            }
                            table.body .wrapper,
                            table.body .article {
                              padding: 10px !important; 
                            }
                            table.body .content {
                              padding: 0 !important; 
                            }
                            table.body .container {
                              padding: 0 !important;
                              width: 100% !important; 
                            }
                            table.body .main {
                              border-left-width: 0 !important;
                              border-radius: 0 !important;
                              border-right-width: 0 !important; 
                            }
                            table.body .btn table {
                              width: 100% !important; 
                            }
                            table.body .btn a {
                              width: 100% !important; 
                            }
                            table.body .img-responsive {
                              height: auto !important;
                              max-width: 100% !important;
                              width: auto !important; 
                            }
                          }
                    
                          /* -------------------------------------
                              PRESERVE THESE STYLES IN THE HEAD
                          ------------------------------------- */
                          @media all {
                            .ExternalClass {
                              width: 100%; 
                            }
                            .ExternalClass,
                            .ExternalClass p,
                            .ExternalClass span,
                            .ExternalClass font,
                            .ExternalClass td,
                            .ExternalClass div {
                              line-height: 100%; 
                            }
                            .apple-link a {
                              color: inherit !important;
                              font-family: inherit !important;
                              font-size: inherit !important;
                              font-weight: inherit !important;
                              line-height: inherit !important;
                              text-decoration: none !important; 
                            }
                            #MessageViewBody a {
                              color: inherit;
                              text-decoration: none;
                              font-size: inherit;
                              font-family: inherit;
                              font-weight: inherit;
                              line-height: inherit;
                            }
                            .btn-primary table td:hover {
                              background-color: #34495e !important; 
                            }
                            .btn-primary a:hover {
                              background-color: #34495e !important;
                              border-color: #34495e !important; 
                            } 
                          }
                    
                        </style>
                      </head>
                      <body>
                        <span class="preheader">Nouvel utilisateur a valider.</span>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                          <tr>
                            <td>&nbsp;</td>
                            <td class="container">
                              <div class="content">
                    
                                <!-- START CENTERED WHITE CONTAINER -->
                                <table role="presentation" class="main">
                    
                                  <!-- START MAIN CONTENT AREA -->
                                  <tr>
                                    <td class="wrapper">
                                      <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                          <td >
                                            <p>Bonjour,</p>
                                            <p>Un medecin souhaite être validé.</p>
                                            <p>Nom : '.strip_tags($_POST['nom']).'</p>
                                            <p>Prenom : '.strip_tags($_POST['prenom']). '</p> 
                                            <p>Mail : ' .strip_tags($_POST['login']) . '</p>
                                            <p>RPPS : '.strip_tags($RPPS).'</p><br> 
                                    
                                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                              <tbody>
                                                <tr>
                                                  <td align="left">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                      <tbody>
                                                        <tr>
                                                          <td> <a href="http://s5-4257.nuage-peda.fr/ATM/gsbextranetb3/index.php?uc=validateur&action=demandeValidation" target="_blank">Valider l\'utilisateur</a> </td>
                                                        </tr>
                                                      </tbody>
                                                    </table>
                                                  </td>
                                                </tr>
                                              </tbody>
                                            </table>
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                    
                                <!-- END MAIN CONTENT AREA -->
                                </table>
                                <!-- END CENTERED WHITE CONTAINER -->
                    
                                <!-- START FOOTER -->
                                <div class="footer">
                                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                      <td class="content-block">
                                        <span class="apple-link">Grand Swiss Bourdin</span>
                                .
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                                <!-- END FOOTER -->
                    
                              </div>
                            </td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </body>
                    </html>');
                    if( $result) {
                        echo "Un mail de vérification à été envoyé à votre adresse e-mail.";
                    }
                }   
                else
                     echo "ce login existe déjà, veuillez en choisir un autre";
            }

			
        
        break;	
}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>
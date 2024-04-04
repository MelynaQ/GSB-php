<?php include("v_navChef.php");

?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<body>
<div class="container w-100 mx-auto">
    <?php
        if($_SESSION["role"]== "ChefdeProduit") {
            echo '<div class ="text-center"><a  href ="index.php?uc=visio&action=creerVisio" class="btn btn-primary mb-4">+ Créer une visio</a></div>';
        }
    
    ?>
<div class="row">
	<div class="col-lg-max">
		<div class="main-box clearfix">
			<div class="table-responsive">
				<table class="table user-list">
					<thead>
						<tr>
							<th><span>Numero visio</span></th>
                            <th><span>Nom visio</span></th>
							<th><span>Date</span></th>
							<th class="text-center"><span>Objectif</span></th>
							<th><span>Lien</span></th>
                            <?php  if($_SESSION["role"] =="ChefdeProduit") { echo '<th>&nbsp;</th>';}?>
                            
						</tr>
					</thead>
					<tbody>
                        <?php
                            $visios = $pdo->getVisio();
                            foreach ($visios as $lesvisios) {
                                if($_SESSION["role"] !="ChefdeProduit") {

                                    echo '<tr >
                                    <td>
                                       '.$lesvisios['id'].'
                                    </td>
                                    <td>
                                       '.$lesvisios['nomVisio'].'
                                    </td>
                                    <td>
                                        '.$lesvisios['dateVisio'].' 
                                    </td>
                                    <td class="text-center">
                                        <p>'.$lesvisios['objectif'].' </p>
                                    </td>
                                    <td>
                                        <a href="#">'.$lesvisios['url'].'</a>
                                    </td>
                                    <td>

                                        <input type="text" class="form-control" name="nom" value ='.$lesvisios['nomVisio'].'></input> 
                                    </td>
                                    
						        </tr>';
                                } else {
                                    
                                    echo '<form action="index.php?uc=visio&action=modifVisio" method="post"><tr>
                                    <td style="width: 10%;">
                                       <a>'.$lesvisios['id'].'</a>
                                       <input type="hidden" name="id" value="'.$lesvisios['id'].'">
            
                                    </td>
                                    <td style="width: 10%;">
                                    <input type="text" class="form-control" name="nom" value ='.$lesvisios['nomVisio'].'></input> 
                                    
                                    </td>
                                    <td style="width: 10%;">
                                    <input type="date" class="form-control" name="datevisio" value ='.$lesvisios['dateVisio'].'></input> 
                                    
                                    </td>
                                    <td class="text-center" style="width: 10%;">
                                        <textarea class="form-control" name="objectif" rows="3">'.$lesvisios['objectif'].'</textarea>
                                    </td>
                                    <td style="width: 10%;">
                                        <a href="#" name="url">'.$lesvisios['url'].'</a>
                                    </td>
                                    <td style="width: 10%;">';
                                    if ($pdo->getAvis($lesvisios['id'])) {
                                        echo '<p>' . $avis["avis"] . '</p>';
                                    } else {
                                        echo '<p>aucun avis</p>';
                                    }
                                    echo '</td>';
                                    echo '<td style="width: 10%;">
                                     
                                        <button type="submit" class="btn btn-success mb-4 table-link">
                                        <i class="fa fa-check"></i>
                                        Valider la modification
                                        </button>
                                        <a href="index.php?uc=visio&action=deleteVisio&id='. $lesvisios['id'] .'" class="btn btn-danger mb-4 table-link">
                                        <i class="fa fa-trash"></i>
                                            Supprimer
                                        </a>
                                
                                    </td>
                                    
						        </tr></form>';



                                }
                                
                


                            };
                        
                        ?>
						
							

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
</body>
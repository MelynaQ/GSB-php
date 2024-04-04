<?php 
    include 'v_sommaire.php';
?>



<body>


<div class="row mx-auto">
	<div class="col-lg-max">
		<div class="main-box clearfix">
			<div class="table-responsive text-center">
                <h1 >Visios à venir</h1>
				<table class="table user-list">
					<thead>
						<tr>
							<th><span>Numero visio</span></th>
                            <th><span>Nom visio</span></th>
							<th><span>Date</span></th>
							<th class="text-center"><span>Objectif</span></th>
							<th><span>Lien</span></th>
                            <th>&nbsp;</th>
                     
                            <?php  if($_SESSION["role"] =="ChefdeProduit") { echo '<th>&nbsp;</th>';}?>
						</tr>
					</thead>
					<tbody>
                        <?php
                            
                           $visios = $pdo->getVisioVenir();
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
                                    </td>';
                                   
                                    if($_SESSION['role'] == 'Medecin') {
                                        echo '<td>
                                            <a href="index.php?uc=visio&action=inscrire&id='. $lesvisios['id'] .'" class="btn btn-primary mb-4 table-link">
                                        
                                                Inscription
                                            </a>
                                     
                                        </td>';


                                    }
                                    
                                    
						        '</tr>';
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
</body>
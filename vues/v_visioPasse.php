<?php
    include "v_sommaire.php";

?>

<body>


<div class="row mx-auto">
	<div class="col-lg-max">
		<div class="main-box clearfix">
			<div class="table-responsive text-center">
                <h1 >Visios passées</h1>
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

                            $visiospasses = $pdo->getVisioInscritePasse($_SESSION["id"]);
                            foreach ($visiospasses as $lesvisios) {
                                if($_SESSION["role"] !="ChefdeProduit") {
                                    $visiosid = $pdo->getuneVisioPasse($lesvisios['id']);
                                    
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
                                        <a href="index.php?uc=visio&action=LaisserAvis&id='. $lesvisios['id'] .'" class="btn btn-danger mb-4 table-link">
                                        <i class="fa fa-trash"></i>
                                            Laisser un avis
                                        </a>
                                     
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
                                    </td>';
                            
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
</body>
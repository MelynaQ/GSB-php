<?php
    include 'v_sommaire.php';

?>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<body>
    <section class="p-4 p-md-5 text-center text-lg-start shadow-1-strong rounded ">
    <div class="row d-flex justify-content-center">
        <?php 
        $lesavis = $pdo->getAvis();
        $lesavisnonvalide = $pdo->getAvisNonValide();
        if($_SESSION['role'] != 'Moderateur') {
            foreach($lesavis as $unAvis) {
            
                $lemed = $pdo->donneLeMedecinByID($unAvis["idMed"]);
                ?>
                <div class="col-md-5 mb-3">
                    <div class="card">
                        <div class="card-body m-3">
                            <div class="row">
                                <div class="col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-lg-0">
                                    <img src="assets/img/medecin.jpg" class="rounded-circle img-fluid shadow-1" alt="woman avatar" width="200" height="200" />
                                </div>
                                <div class="col-lg-8">
                                <p class="fw-bold lead mb-2"><strong><?php echo $lemed["nom"] . ' ' . $lemed["prenom"]?></strong></p>

                                    <div class="text-right"> 
                                        <?php
                                        
                                            switch($unAvis["note"]) { 
                                                case '0' : {
                                                    echo'
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '1':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '2':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '3':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '4':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '5':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>';
                                                    break;
                                                }
                                            }

                                                
                                        ?>
                                        
                                    </div>
                                    <p class="text-muted fw-light mb-4">
                                        <?php echo $unAvis["avis"];?>
                                    </p>
                                    <?php echo 'Visio numéro : ' .$unAvis["idVisio"];?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            }
            } else {
                foreach($lesavisnonvalide as $nonvalide) {
                    $lemed = $pdo->donneLeMedecinByID($nonvalide["idMed"]);
                ?>
                
                <div class="col-md-5 mb-3">
                    <div class="card">
                        <div class="card-body m-3">
                            <div class="row">
                                <div class="col-lg-4 d-flex justify-content-center align-items-center mb-4 mb-lg-0">
                                    <img src="assets/img/medecin.jpg" class="rounded-circle img-fluid shadow-1" alt="woman avatar" width="200" height="200" />
                                </div>
                                
                                <div class="col-lg-8">
                                <?php echo '<p class="text-right mt-0">Visio numéro : ' .$nonvalide["idVisio"].'</p>';?>
                                <p class="fw-bold"><strong><?php echo $lemed["nom"] . ' ' . $lemed["prenom"]?></strong></p>

                                    <div class="text-right mt-0"> 
                                        
                                        <?php
                                        
                                            switch($nonvalide["note"]) { 
                                                case '0' : {
                                                    echo'
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '1':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '2':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '3':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star-o"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '4':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star-o"></span>';
                                                    break;
                                                }
                                                case '5':{
                                                    echo'
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>
                                                    <span class ="fa fa-star"></span>';
                                                    break;
                                                }
                                            }

                                                
                                        ?>
                                        
                                    </div>
                                    
                                    <p class="text-muted fw-light mb-4">
                                        <?php echo $nonvalide["avis"];?>
                                    </p>
                                    
                                    <div class="text-center mx-auto mt-5">
                                    <a href='index.php?uc=visio&action=validerUnAvis&id=<?php echo $nonvalide['id']?>' class="btn btn-primary" >Valider l'avis</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

                                        }

            }
        
        
        ?>
        
    </div>
</section>


</body>
<?php include("v_navChef.php");

?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
<body class="align-items-center">
    <div class="w-25 mx-auto bg-white h-70 rounded">
        <h1 class="text-center">Ajouter un produit</h1>
        <form method="post" action="index.php?uc=produit&action=ajouterLeProduit" enctype="multipart/form-data" >

            <div class="form-outline mb-4 p-3">
                <label class="form-label"  for="form4Example1">Nom du produit</label>
              <input type="text" name="nomproduit" class="form-control" />
            </div>


            <div class="form-outline mb-4 p-3">
                <label class="form-label" for="form4Example2">Effets indésirables</label>
              <input type="text" name="effetsproduit"  class="form-control" />
              
            </div>

            <div class="form-outline mb-4 p-3">
                <label class="form-label" for="form4Example2">Objectif du produit</label>
              <input type="text" name="objectifs"  class="form-control" />
              
            </div>
            <div class="form-outline mb-4 p-3">
                <label class="form-label" for="form4Example3">Description du produit</label>
              <textarea class="form-control" name="desc" id="form4Example3" rows="4"></textarea>
              
            </div>

            
            <label class="form-label" for="customFile">Image</label>
            <input type="file" name="image" class="form-control mb-4 p-3" id="customFile" />
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Créer mon produit</button>
        
        </form>
    </div>
 
</div>
</body>



<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php
if (!$_SESSION['id'])
    header('Location: ../index.php');
else {
  include "v_navChef.php";
}
?>

<body class="align-items-center">
    <div class="w-25 mx-auto bg-white rounded mb-5 overflow-auto" style="max-height:600px">
        <h1 class="text-center">Modifier le produit</h1>
        <form method="post" action="index.php?uc=produit&action=validerModif" enctype="multipart/form-data" >

            <div class="form-outline mb-2 p-3">
                <label for="disabledTextInput" class="form-label">Id du produit :</label>
                <input type="text" class="form-control"  placeholder=<?php if(isset($_GET["id"])){echo $_GET["id"];}?> disabled>
                <input type="hidden" name="idproduit" value="<?php if(isset($_GET["id"])){echo $_GET["id"];}?>">
            
            </div>

            <div class="form-outline mb-2 p-3">
                <label class="form-label"  for="form4Example1">Nom du produit</label>
              <input type="text" name="nomproduit" class="form-control" placeholder="Nouveau nom"/>
            </div>


            <div class="form-outline mb-2 p-3"">
                <label class="form-label" for="form4Example2">Effets indésirables</label>
              <input type="text" name="effetsproduit"  class="form-control" />
              
            </div>

            <div class="form-outline mb-2 p-3"">
                <label class="form-label" for="form4Example2">Objectif du produit</label>
              <input type="text" name="objectifs"  class="form-control" />
              
            </div>
            <div class="form-outline mb-2 p-3"">
                <label class="form-label" for="form4Example3">Description du produit</label>
              <textarea class="form-control" name="desc" id="form4Example3" rows="4"></textarea>
              
            </div>

            
            <label class="form-label" for="customFile">Image</label>
            <input type="file" name="image" class="form-control mb-4 p-3" id="customFile" />
            <!-- Submit button -->
            <div class ="text-center"><button type="submit" class="btn btn-primary mb-4">Modifier</button></div>
            
        
        </form>
    </div>
 
</div>
</body>

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
        <h1 class="text-center">Creer une visio</h1>
        <form method="post" action="index.php?uc=visio&action=validerCreation">

    

            <div class="form-outline mb-2 p-3">
                <label class="form-label"  for="form4Example1">Nom de la visio</label>
              <input type="text" name="nomvisio" class="form-control" placeholder="Nouveau nom"/>
            </div>


            <div class="form-outline mb-2 p-3"">
                <label class="form-label" for="form4Example2">Objectif</label>
              <input type="text" name="objectif"  class="form-control" />
              
            </div>

            <div class="form-outline mb-2 p-3"">
                <label class="form-label" for="form4Example2">Date de la visio</label>
              <input type="date" name="date"  class="form-control" />
              
            </div>
        
            <!-- Submit button -->
            <div class ="text-center"><button type="submit" class="btn btn-primary mb-4">Creer ma visio</button></div>
            
        
        </form>
    </div>
 
</div>
</body>
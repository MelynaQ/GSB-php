<?php

    include "v_sommaire.php";
    $id = $_GET["id"];
?>

<div class="w-25 mx-auto bg-white rounded mb-5 overflow-auto" style="max-height:600px">
        <h1 class="text-center">Donner votre avis</h1>
        <form method="post" action='index.php?uc=visio&action=validerdonnerAvis&id=<?php echo $id ?>'>

    
           

            <div class="form-outline mb-2 p-3"">
                <label class="form-label" for="form4Example2">Votre avis</label>
              <input type="text" name="avis"  class="form-control" />
              
            </div>

            <div class="form-group  mb-2 p-3">
                <label for="exampleFormControlSelect1">Sur une échelle de 1 à 5 comment était votre ressenti ?</label>
                <select class="form-control" id="exampleFormControlSelect1" name ="selectechelle">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        
            <!-- Submit button -->
            <div class ="text-center"><button type="submit" class="btn btn-primary mb-4">Valider mon avis</button></div>
         

        
        </form>
    </div>
 
</div>

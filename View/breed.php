
        <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
<section>
    <div class="row">
        <div class="col-5">
            <div id ="breed-mother" >
                <select name="selectMother" form="breed-form" onchange="updateDisplayGriffF()" id="selectMother"> 
                    <?php foreach($femaleList as $griff){ ?>
                    <option value="<?php echo $griff->getId(); ?>"> <?php echo $griff->getName(); ?></option>
                    <?php } ?>
                </select>
                <div id="breed-phenotype" >
                    <?php foreach ($femaleList as $mPheno){ 
                        $phenotype = Breeder::punnet($mPheno->getGenome());
                    ?>
                    <div id="<?php echo $mPheno->getId(); ?>" style="display: none;" name="toggleableF">
                    <table class="breed-pheno-table" style="float: right;">
                        <tr>
                            <td>Color</td><td><?php echo $phenotype[0]; ?></td> <td>Skin</td><td><?php echo $phenotype[7]; ?></td>
                        </tr>
                        <tr>
                            <td>Eyes</td><td><?php echo $phenotype[1]; ?></td> <td>Build</td><td><?php echo $phenotype[8]; ?></td>
                        </tr>
                        <tr>
                            <td>Ears</td><td><?php echo $phenotype[2]; ?></td> <td>Beak</td><td><?php echo $phenotype[9]; ?></td>
                        </tr>
                        <tr>
                            <td>Coat</td><td><?php echo $phenotype[3]; ?></td> <td>Feet</td><td><?php echo $phenotype[10]; ?></td>
                        </tr>
                        <tr>
                            <td>Pattern</td><td><?php echo $phenotype[4]; ?></td> <td>Tail</td><td><?php echo $phenotype[6]; ?></td>
                        </tr>
                        <tr>
                            <td>Markings</td><td><?php echo $phenotype[5]; ?></td> 
                        </tr>
                      
                    </table>
                      <div class="griffimage" style="float: left;">
                             <img src="./Model/griffin_images/g_<?php echo $mPheno->getId();?>.png">
                        </div>   
                </div>
                    <?php } ?>
            </div>   
        </div>
        </div>
        <div class="col-1"> </div>
    
        <div class="col-5">
            <div id ="breed-father">
                 <select name="selectFather" onchange="updateDisplayGriffM()" form="breed-form" required id="selectFather"> 
                    <?php foreach($maleList as $griff){ ?>
                    <option value="<?php echo $griff->getId(); ?>"> <?php echo $griff->getName(); ?></option>
                    <?php } ?>
                </select>
                <div id="breed-phenotype">
                  <?php foreach ($maleList as $fPheno){ 
                        $phenotype = Breeder::punnet($fPheno->getGenome());
                    ?>
                    <div id="<?php echo $fPheno->getId(); ?>" style="display: none;" class="toggleableM">
                    <table class="breed-pheno-table" style="float: left;">
                        <tr>
                            <td>Color</td><td><?php echo $phenotype[0]; ?></td> <td>Skin</td><td><?php echo $phenotype[7]; ?></td>
                        </tr>
                        <tr>
                            <td>Eyes</td><td><?php echo $phenotype[1]; ?></td> <td>Build</td><td><?php echo $phenotype[8]; ?></td>
                        </tr>
                        <tr>
                            <td>Ears</td><td><?php echo $phenotype[2]; ?></td> <td>Beak</td><td><?php echo $phenotype[9]; ?></td>
                        </tr>
                        <tr>
                            <td>Coat</td><td><?php echo $phenotype[3]; ?></td> <td>Feet</td><td><?php echo $phenotype[10]; ?></td>
                        </tr>
                        <tr>
                            <td>Pattern</td><td><?php echo $phenotype[4]; ?></td> <td>Tail</td><td><?php echo $phenotype[6]; ?></td> 
                        </tr>
                        <tr>
                            <td>Markings</td><td><?php echo $phenotype[5]; ?></td> 
                        </tr>
                    </table>
                        <div class="griffimage" style="float: right;">
                             <img src="./Model/griffin_images/g_<?php echo $fPheno->getId();?>.png">
                        </div>    
                </div>
                  <?php } ?>
            </div>   
        </div>
    </div>
        </div>
    <div class='row'>
        <div class="col-4"></div>
        <div class="col-4">
            <form id="breed-form" method="POST" action="./index.php">
                <input type="hidden" name="action" value="breed">
                <input type="submit" value="breed" class="btn btn-primary">
            </form>    
            
        </div>
        <div class="col-4"></div>
    </div>
</section>

<!-- Update data based on selected Pet -->
<script>
    var lastgriffinF = '';
    var lastgriffinM = '';
    function updateDisplayGriffF(){
        
        var griffin = document.getElementById("selectMother").value;
        document.getElementById(griffin).style.display = "block";
        if(lastgriffinF !== ''){
            document.getElementById(lastgriffinF).style.display="none";
        }
        lastgriffinF=griffin;
    }
    
     function updateDisplayGriffM(){
        var griffin = document.getElementById("selectFather").value;
        document.getElementById(griffin).style.display = "block";
        if(lastgriffinM !== ''){
            document.getElementById(lastgriffinM).style.display="none";
        }
        lastgriffinM=griffin;
    }
    </script>
    </body>
</html>

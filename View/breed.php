
        <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
<section>
    <div class="row">
        <div class="col-5">
            <div id ="breed-mother" onchange="updateDisplayGriff(this.value)">
                <select name="selectMother" form="breedForm" required> 
                    <?php foreach($femaleList as $griff){ ?>
                    <option value="<?php echo $griff->getId(); ?>"> <?php echo $griff->getName(); ?></option>
                    <?php } ?>
                </select>
                <div id="breed-image"></div>
                <div id="breed-phenotype">
                    <?php foreach ($femaleList as $mPheno){ 
                        $phenotype = Breeder::punnet($mPheno->getGenome());
                    }?>
                    <div id="<?php echo $mPheno->getId(); ?>" style="display: none;">
                    <table class="breed-pheno-table">
                        <tr>
                            <td>Color</td><td><?php echo $phenotype[0]; ?></td> <td>Skin</td><td><?php echo $phenotype[7]; ?></td>
                        </tr>
                        <tr>
                            <td>Eyes</td><td><td><?php echo $phenotype[1]; ?></td> <td>Build</td><td><?php echo $phenotype[8]; ?></td>
                        </tr>
                        <tr>
                            <td>Ears</td><td><?php echo $phenotype[2]; ?></td> <td>Beak</td><td><?php echo $phenotype[9]; ?></td>
                        </tr>
                        <tr>
                            <td>Coat</td><td><?php echo $phenotype[3]; ?></td> <td>Feet</td><td><?php echo $phenotype[10]; ?></td>
                        </tr>
                        <tr>
                            <td>Pattern</td><td><?php echo $phenotype[4]; ?></td> <td>Health</td><td><?php echo $phenotype[11]; ?></td>
                        </tr>
                        <tr>
                            <td>Markings</td><td><?php echo $phenotype[5]; ?></td> <td>Mutations</td><td><?php echo $phenotype[12]; ?></td>
                        </tr>
                        <tr>
                            <td>Tail</td><td><?php echo $phenotype[6]; ?></td>
                        </tr>
                    </table>
                        
                </div>
            </div>   
        </div>
        
        <div class="col-1"> </div>
    
        <div class="col-5">
            <div id ="breed-father">
                 <select name="selectFather" onchange="updateDisplayGriff(this.value)" form="breedForm" required> 
                    <?php foreach($maleList as $griff){ ?>
                    <option value="<?php echo $griff->getId(); ?>"> <?php echo $griff->getName(); ?></option>
                    <?php } ?>
                </select>
                <div id="breed-image"></div>
                <div id="breed-phenotype">
                  <?php foreach ($maleList as $fPheno){ 
                        $phenotype = Breeder::punnet($fPheno->getGenome());
                    }?>
                    <div id="<?php echo $fPheno->getId(); ?>" style="display: none;" class="toggleable">
                    <table class="breed-pheno-table">
                        <tr>
                            <td>Color</td><td><?php echo $phenotype[0]; ?></td> <td>Skin</td><td><?php echo $phenotype[7]; ?></td>
                        </tr>
                        <tr>
                            <td>Eyes</td><td><td><?php echo $phenotype[1]; ?></td> <td>Build</td><td><?php echo $phenotype[8]; ?></td>
                        </tr>
                        <tr>
                            <td>Ears</td><td><?php echo $phenotype[2]; ?></td> <td>Beak</td><td><?php echo $phenotype[9]; ?></td>
                        </tr>
                        <tr>
                            <td>Coat</td><td><?php echo $phenotype[3]; ?></td> <td>Feet</td><td><?php echo $phenotype[10]; ?></td>
                        </tr>
                        <tr>
                            <td>Pattern</td><td><?php echo $phenotype[4]; ?></td> <td>Health</td><td><?php echo $phenotype[11]; ?></td>
                        </tr>
                        <tr>
                            <td>Markings</td><td><?php echo $phenotype[5]; ?></td> <td>Mutations</td><td><?php echo $phenotype[12]; ?></td>
                        </tr>
                        <tr>
                            <td>Tail</td><td><?php echo $phenotype[6]; ?></td>
                        </tr>
                    </table>
                        
                </div>
            </div>   
        </div>
    </div>
    <div class='row'>
        <div class="col-4"></div>
        <div class="col-4">
            <form id="breed-form" method="get" action="./index.php">
                <input type="hidden" name="action" value="breed">
                <input type="submit" value="breed" class="btn">
            </form>    
            
        </div>
        <div class="col-4"></div>
    </div>
</section>

<!-- Update data based on selected Pet -->
<script>

    function updateDisplayGriff(griff){
        document.getElementsByClassName("toggleable").style.display = block;
        document.getElementById(griff).style.display = block;
    }
    </script>
    </body>
</html>

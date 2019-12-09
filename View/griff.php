  <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
       <section>
           <div class="barnlist float-left">
               <?php foreach($barn as $item){
                   ?>
               <div class="card">
                   <a href="index.php?action=griffin&pid=<?php echo $item->getId(); ?>"><?php echo $item->getName(); ?></a>
                   <img src="./Model/griffin_images/<?php echo $item->getImagePath(); ?>" style="height: 100px; width: 100px;">
               </div>
               <?php } 
               ?>
           </div>
           <div class="griffDisplay">
               <h2 class="griffName"><?php echo $griff->getName();?> <img src="./images/<?php if($griff->getSex() === "F"){echo "female";} else {echo "male";}?>.png"><input type="image" src="./images/pencilicon.png" onclick="showDiv('rename-popup')"></h2>
               
               <div class="griffStats">
                   <div class="griffAtrributes page-stats m-1">
                       <div>
                       Strength: <?php echo $griff->getStr(); ?><br/>
                       Agility: <?php echo $griff->getAgi(); ?><br/>
                       Speed: <?php echo $griff->getSpd(); ?><br/>
                       Endurance: <?php echo $griff->getCon(); ?><br/>
                       Intelligence: <?php echo $griff->getInt(); ?>
                       </div>
                       <div>
                       Age: <?php $ageDays=(time()-strtotime($griff->getAge()))/86400;
                               if($ageDays <= 1 ){
                                   $age = '1 Day';
                               } else if ($ageDays > 1 && $ageDays <= 6){
                                   $age = round($ageDays, 0, PHP_ROUND_HALF_DOWN) . ' Days';
                               } else if($ageDays > 6 && $ageDays <= 14){
                                   $age = '1 Week';
                               }
                               else if ($ageDays >14 & $ageDays <=30){
                                   $age = round(($ageDays/7), 0, PHP_ROUND_HALF_DOWN) . ' Weeks';
                               }
                               else if($ageDays > 30 && $ageDays <=60){
                                   $age = '1 Month';
                               }
                               else if($ageDays > 60 && $ageDays <=365){
                                   $age = round(($ageDays/30), 0, PHP_ROUND_HALF_DOWN) . ' Months';
                               }
                               else if($ageDays > 365 && $ageDays <=730){
                                   $age = '1 Year';
                               }else {
                                   $age = round(($ageDays/365), 0, PHP_ROUND_HALF_DOWN) . ' Years';
                               }
                               echo $age;
                               ?>
                       
                       Breeding Countdown:<br/>
                       Height: <?php echo $griff->getHeight(); ?> cm<br/>
                       Weight: <?php echo $griff->getWeight(); ?> kg
                       </div>
                   </div>
                   
                   <div class="griff-pheno page-stats m-1">
                       
                       <?php $phenotype = Breeder::punnet($griff->getGenome()); ?>
                       <table class="table table-sm">
                           <tr>
                            <td>Color:</td><td><?php echo $phenotype[0]; ?></td> <td>Skin:</td><td><?php echo $phenotype[7]; ?></td>
                        </tr>
                        <tr>
                            <td>Eyes:</td><td><?php echo $phenotype[1]; ?></td> <td>Build:</td><td><?php echo $phenotype[8]; ?></td>
                        </tr>
                        <tr>
                            <td>Ears:</td><td><?php echo $phenotype[2]; ?></td> <td>Beak:</td><td><?php echo $phenotype[9]; ?></td>
                        </tr>
                        <tr>
                            <td>Coat:</td><td><?php echo $phenotype[3]; ?></td> <td>Feet:</td><td><?php echo $phenotype[10]; ?></td>
                        </tr>
                        <tr>
                            <td>Pattern:</td><td><?php echo $phenotype[4]; ?></td> <td>Tail:</td><td><?php echo $phenotype[6]; ?></td> 
                        </tr>
                        <tr>
                            <td>Markings:</td><td><?php echo $phenotype[5]; ?></td> 
                        </tr>
                       </table>
                   </div>
                   
                       <div class="page-stats m-1">
                        <div id="stats_tame">
                           <span class="font-weight-bold">Tameness</span> <br/>
                           <?php echo $griff->getTameness() . '/' . $griff->getMaxTameness(); ?>
                           <?php if($logintoken){?>
                           <p>
                               <input type="submit" class="btn btn-primary" value="Train" form="trainForm">
                           </p><?php } ?>
                        </div>
                       <div id="stats_hunger" >
                           <span class="font-weight-bold">Hunger</span><br/>
                            <?php echo $griff->getTameness();?>/10
                            <?php if($logintoken) {?>
                             <p>
                               <input type="submit" class="btn btn-primary" value="Feed" form="feedForm">
                           </p>
                            <?php }?>
                       </div>
                       <div id="stats_health" >
                           <span class="font-weight-bold">Health</span><br/>
                            <?php echo $griff->getHealth() . '/' . $griff->getMaxHealth(); ?>
                           <?php if($logintoken){ ?>
                            <p>
                               <input type="submit" class="btn btn-primary" value="Medicate" form="medicineForm">
                           </p>
                           <?php } ?>
                       </div>
                           <div id="stats_energy">
                                <span class="font-weight-bold">Energy</span><br/>
                            <?php echo $griff->getEnergy()?>/10
                           </div>
                   </div>

                        <div class="col-12 page-stats">
                          <input form="pedigree" type="submit" name="Pedigree" value="Pedigree" class="btn btn-primary">
                          <?php if($logintoken){ ?>
                          <input form="breed" type="submit" name="Breed" value="Breed" class="btn btn-primary">
                          <input form="pasture" type="submit" name="Pasture" value="Pasture" class="btn btn-primary">
                          <?php } ?>
                       </div>
                   </div>
               </div>
               <div class="griff-image">
                   <img src="./Model/griffin_images/g_<?php echo $griff->getId();?>.png">
               </div>
           </div>
           <form id="feedForm" method="POST" action="./index.php">
               <input type="hidden" name="action" value="feed">
               <input type="hidden" name="griffID" value="<?php echo $griff->getId();?>">
           </form>
           <form id="medicineForm" method="POST" action="./index.php">
               <input type="hidden" name="action" value="medicine">
               <input type="hidden" name="griffID" value="<?php echo $griff->getId();?>">
           </form> 
           <form id="trainForm" method="POST" action="./index.php">
               <input type="hidden" name="action" value="train">
               <input type="hidden" name="griffID" value="<?php echo $griff->getId();?>">
           </form> 
           <form id="pedigree" method="POST" action="./index.php">
                <input type="hidden" name="action" value="pedigree">
                 <input type="hidden" name="griffin" value="<?php echo $griff->getId(); ?>"> 
             </form>
                            
            <form id="breed" method="POST" action="./index.php">
                <input type="hidden" name="action" value="breeder">
                <input type="hidden" name="griffID" value="<?php echo $griff->getId(); ?>">    
            </form>
                            
            <form id="pasture" method="post" action="./index.php">
                <input type="hidden" name="action" value="pasture">
                <input type="hidden" name="griffID" value="<?php echo $griff->getId(); ?>">
            </form>
           
           <div style="display: none;" id="rename-popup">
               <h5>Rename Griffin</h5>
               <form id="rename" method="POST" action="./index.php">
                   <input type="hidden" name="action" value="rename">
                   <input type="hidden" name="griffID" value="<?php echo $griff->getId(); ?>">
                   <label>New Name: </label><input type="text" name="newName">
                   <input type="submit" value="Rename" name="Rename">
               </form>
               <button class="btn btn-danger" value="Close" onclick="hideDiv('rename-popup')">Close</button>
           </div>
           
           <script>
           function showDiv(id){
               document.getElementById(id).style.display = "block";
           }
           function hideDiv(id){
               document.getElementById(id).style.display = "none";
           }
           </script>
    </body>
</html>

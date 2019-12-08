  <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
       <section>
           <div class="griffDisplay">
               <h2 class="griffName"><?php echo $griff->getName();?> <img src="./images/<?php if($griff->getSex() === "F"){echo "female";} else {echo "male";}?>.png"></h2>
               <div class="griffImage">
                   <!--DISPLAY IMAGE HERE-->
               </div>
               <div class="griffStats">
                   <div class="griffAtrributes">
                       Strength: <?php echo $griff->getStr(); ?><br/>
                       Agility: <?php echo $griff->getAgi(); ?><br/>
                       Speed: <?php echo $griff->getSpd(); ?><br/>
                       Endurance: <?php echo $griff->getCon(); ?><br/>
                       Intelligence: <?php echo $griff->getInt(); ?>
                   </div>
                   <div class="row">
                       <div class="col-3" id="stats_tame"> 
                           Tameness <br/>
                           <?php echo $griff->getTameness() . '/' . $griff->getMaxTameness(); ?>
                       </div>
                       <div class="col-3" id="stats_hunger">
                           Hunger<br/>
                            <?php echo $griff->getTameness();?>/10
                       </div>
                       <div class="col-3" id="stats_health">
                           Health<br/>
                            <?php echo $griff->getHealth() . '/' . $griff->getMaxHealth(); ?>
                       </div>
                       <div class="col-3" id="stats_energy">
                           Energy<br/>
                            <?php echo $griff->getEnergy()?>/10
                       </div>
                   </div>
               </div>
           </div>
           <form id="feedForm" method="POST" action="./index.php">
               <input type="hidden" name="action" value="feed">
               <input type="hidden" name="griff" value="<?php echo $griff->getId();?>">
           </form>
           <form id="medicineForm" method="POST" action="./index.php">
               <input type="hidden" name="action" value="medicine">
               <input type="hidden" name="griff" value="<?php echo $griff->getId();?>">
           </form> 
           <form id="trainForm" method="POST" action="./index.php">
               <input type="hidden" name="action" value="train">
               <input type="hidden" name="griff" value="<?php echo $griff->getId();?>">
           </form> 
    </body>
</html>

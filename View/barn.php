
        <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
       <section>   
     <?php foreach($griffinsList as $griff){
            ?>
            <div class="card-deck" style="display: inline-block;">
              <div class="card barnGriffDisplay">
                  <div class="card-img">
                      <img src="./Model/griffin_images/g_<?php echo $griff->getId(); ?>.png" style="height: 175px; width: 175px;">
                  </div>
                <div class="card-body"
                     <p><a href="index.php?action=griffin&pid=<?php echo $griff->getId(); ?>"><?php echo $griff->getName(); ?></a> <img src="./images/<?php if($griff->getSex() === "F"){echo "female";} else {echo "male";}?>.png" height="10px" width="10px"></p>
                     <p>Energy: <?php echo $griff->getEnergy(); ?>/10<br/>
                     Health: <?php echo $griff->getHealth(); ?>/<?php echo $griff->getMaxHealth(); ?><br/>
                     Hunger: <?php echo $griff->getHunger(); ?>/10<br/>
                     Tameness: <?php echo $griff->getTameness(); ?>/<?php echo $griff->getMaxTameness(); ?></p>
                </div>
                  <div class="card-footer">
                     <form id="breed" method="post" action="./index.php">
                    <input type="hidden" name="action" value="breeder">
                    <input type="hidden" name="griffID" value="<?php echo $griff->getId(); ?>">
                    <input type="submit" name="Breed" value="Breed">
                     </form>
                    <form id="pasture" method="post" action="./index.php">
                    <input type="hidden" name="action" value="pasture">
                    <input type="hidden" name="griffID" value="<?php echo $griff->getId(); ?>">
                    <input type="submit" name="Pasture" value="Pasture">
                     </form>
                   
                  </div>
              </div>
            </div> 
     <?php } ?>
        </section>
    </body>
</html>


        <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
       <section>   
     <?php foreach($griffinsList as $griff){
            ?>
            <div class="card-deck" style="display: inline-block;">
              <div class="card barnGriffDisplay">
                  <div class="card-img"></div>
                <div class="card-body"
                     <p><a href="index.php?action=griffin&pid=<?php echo $griff->getId(); ?>"><?php echo $griff->getName(); ?></a> <img src="./images/<?php if($griff->getSex() === "F"){echo "female";} else {echo "male";}?>.png" height="10px" width="10px"></p>
                     <p>Energy: <?php echo $griff->getEnergy(); ?>/10<br/>
                     Health: <?php echo $griff->getHealth(); ?>/<?php echo $griff->getMaxHealth(); ?><br/>
                     Hunger: <?php echo $griff->getHunger(); ?>/10<br/>
                     Tameness: <?php echo $griff->getTameness(); ?>/<?php echo $griff->getMaxTameness(); ?></p>
                </div>
              </div>
            </div>
                <?php }
                       ?>
        </section>
    </body>
</html>

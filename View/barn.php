
        <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
       <section>   
     <?php foreach($griffinsList as $griff){
            ?>
            <div class="card-deck" style="display: inline-block;">
              <div class="card barnGriffDisplay">
                <div class="card-body"
                <ul>
                <li>Name: <?php echo $griff->getName();?></li>
                <li>Age: <?php echo $griff->getAge();?> </li>
                <li>Phenotype: <?php echo implode(Breeder::punnet($griff->getGenome()));?></li>
                <li>EncodeDump: <?php echo var_dump(DAMethods::genome_encode($griff->getGenome())); ?></li>
                </ul>
                </div>
              </div>
            </div>
                <?php }
                       ?>
        </section>
    </body>
</html>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       
        
        foreach($griffinsList as $griff){
            ?><div>
                <ul>
                <li>Name: <?php echo $griff->getName();?></li>
                <li>Age: <?php echo $griff->getAge();?> </li>
                <li>Phenotype: <?php echo var_dump($griff->getGenome());?></li></ul>
            </div>
        <?php }
        ?>
    </body>
</html>

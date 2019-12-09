<?php require_once('./View/nav.php'); ?>
<section>
    <h3>Sample Griffin Maker</h3>
    <form id="griff-maker" method="POST" action="./index.php">
        <label>Name:</label> <input type="text" name="griffname" id='griffname'><br>
        <label>Sex:</label> <input type="text" name="sex" id='sex'><br/>
        <label>MotherID:</label> <input type="text" name="mother" id='mother'><br/>
        <label>FatherID:</label> <input type="text" name="father" id='father'><br/>
        <h5>Genome</h5>
        <label>Color - Mother: </label> <select name="colorM">
            <?php foreach($color as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Color - Father: </label> <select name="colorF">
            <?php foreach($color as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Eyes - Mother: </label> <select name="eyesM">
            <?php foreach($eyes as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Eyes - Father: </label> <select name="eyesF">
            <?php foreach($eyes as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select><br/>
        <label>Ears - Mother: </label> <select name="earsM">
            <?php foreach($ears as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Ears - Father: </label> <select name="earsF">
            <?php foreach($ears as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Coat - Mother: </label> <select name="coatM">
            <?php foreach($coat as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Coat - Father: </label> <select name="coatF">
            <?php foreach($coat as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select><br/>
        <label>Pattern - Mother: </label> <select name="patternM">
            <?php foreach($pattern as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Pattern - Father: </label> <select name="patternF">
            <?php foreach($pattern as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Markings - Mother: </label> <select name="markingsM">
            <?php foreach($markings as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Markings - Father: </label> <select name="markingsF">
            <?php foreach($markings as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select><br/>
        <label>Tail - Mother: </label> <select name="tailM">
            <?php foreach($tail as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Tail - Father: </label> <select name="tailF">
            <?php foreach($tail as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Skin - Mother: </label> <select name="skinM">
            <?php foreach($skin as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Skin - Father: </label> <select name="skinF">
            <?php foreach($skin as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select><br/>
        <label>Build - Mother: </label> <select name="buildM">
            <?php foreach($build as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Build - Father: </label> <select name="buildF">
            <?php foreach($build as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Beak - Mother: </label> <select name="beakM">
            <?php foreach($beak as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Beak - Father: </label> <select name="beakF">
            <?php foreach($beak as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select><br/>
        <label>Feet - Mother: </label> <select name="feetM">
            <?php foreach($feet as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select>
        <label>Feet - Father: </label> <select name="feetF">
            <?php foreach($feet as $gene){?>
            <option value="<?php echo $gene->getCode();?>"><?php echo $gene->getName();?></option>
            <?php } ?>
        </select><br/>
        <label>Str: </label> <input type="text" name="str" id='str'><br/>
        <label>Agi: </label> <input type="text" name="agi" id='agi'><br/>
        <label>Int: </label> <input type="text" name="intl" id='intl'><br/>
        <label>Spd: </label> <input type='text' name="spd" id='spd'><br/>
        <label>Con: </label> <input type='text' name='con' id='con'><br/>
        <label>Height: </label> <input type='text' name='height' id='height'><br/>
        <label>Weight: </label> <input type='text' name='weight' id='weight'><br/>
        
        <input type='hidden' name="action" value="make">
        <input type="submit" name="make" value="Make">
    </form>
    <button onclick="randomize()">Randomize</button>
</section>
<script>
    var names=['Arcturus', 'Apple', 'August', 'Artemis', 'Anthracite', 'Bartimaeus', 'Beryl', 'Belladonna', 'Bo', 'Brekenridge', 'Chalcedony', 'Calcifer', 'Careless', 'Constantine', 'Deluge', 'Damatius', 'Destiny', 'Dragon', 'Dorset', 'Enceladus', 'Etherium', 'Ending', 'Eternal', 'Erebor', 'Falas', 'Ferro', 'Fortune', 'Forget', 'Foxglove', 'Generous', 'Gorgeous', 'Galadriel', 'General', 'Hattie', 'Halite', 'Hephaestus', 'Henry', 'Haddock', 'Ignatius', 'Ingot', 'Ivory', 'Introvert', 'Iridium', 'Ingrid', 'Joy', 'Jack', 'Jasper', 'Jock', 'Kalium', 'Kraton', 'Korra', 'Keileigh', 'Lorna', 'Lorraine', 'Leontius', 'Loba', 'Lore', 'Love', 'Melanchoy', 'Mountain', 'Morning', 'Mud', 'Merit', 'Nemean', 'Nero', 'Nickel', 'Nahar', 'Noise', 'Opulent', 'Oreo', 'Oscar', 'Ornery', 'Opal', 'Palladium', 'Penny', 'Presage', 'Penske', 'Question', 'Quorum', 'Queen', 'Roverandom', 'Rascal', 'Ruby', 'Rotifer', 'Selene', 'Seneca', 'Sienna', 'Salamander', 'Tuscany', 'Tritium', 'Timothy', 'Trafalgar', 'Terrible', 'Uther', 'Uncouth', 'Upsilon', 'Unknown', 'Vulture', 'Virture', 'Victor', 'Volens', 'Wayne', 'Wayward', 'Wisteria', 'Xena', 'Xeno', 'Xenith', 'Yellow', 'Yelp', 'Young', 'Zoicite', 'Zebra', 'Zendar', 'Zizi' ];
    var sex=['F', 'M'];
    
    function randomize(){
        var sel = document.getElementsByTagName("select");
        for (var i=0; i < sel.length; i++){
            var items = sel[i].getElementsByTagName('option');
            var index = Math.floor(Math.random() * items.length);
            sel[i].selectedIndex = index;
        
        $randomName = Math.floor(Math.random() * names.length);
        $randomSex = Math.floor(Math.random() * sex.length);
        document.getElementById("griffname").value = names[$randomName];
        document.getElementById("sex").value = sex[$randomSex];
        document.getElementById("height").value = Math.floor((Math.random() * 110) + 90);
        document.getElementById("weight").value = Math.floor((Math.random() * 250) + 130);
        document.getElementById("str").value = Math.floor((Math.random() * 29) + 1);
        document.getElementById("intl").value = Math.floor((Math.random() * 29) + 1);
        document.getElementById("spd").value = Math.floor((Math.random() * 29) + 1);
        document.getElementById("agi").value=Math.floor((Math.random() * 29) + 1);
        document.getElementById("con").value=Math.floor((Math.random() * 29) + 1);
        
        }
    }
    </script>
    </body>
</html>

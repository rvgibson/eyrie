<?php
    include_once('DAMethods.php');
//    $dsn="mysql:host=184.154.206.12;dbname=pidrawsc_eyrie;charset=utf8";
//    $username='pidrawsc_birdadmin';
//    $password='Squareroot#2';
    
    //localhost
$dsn="mysql:host=localhost;dbname=pidrawsc_eyrie";
$username='root';
$password='';

    try {
     $db = new PDO($dsn, $username, $password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
    echo $e->getMessage();
    exit();
    }
    
function get_griffs_active($userid){
    global $db;
    $query = "SELECT * FROM griffins WHERE userid = :userid and status = 'active'";
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userid);
    $statement->execute();
    $griffs = $statement->fetchAll();
    $statement->closeCursor();

    foreach ($griffs as $griffin){
       $genomeArray= DAMethods::genome_parse($griffin['genome']);
       $genome = get_genes($genomeArray);    
       $barn[$griffin['id']] = new Pet(
               $griffin['id'],
               $griffin['name'],
               $griffin['sex'],
               $griffin['mother'],
               $griffin['father'],
               $griffin['age'],
               $griffin['breed'],
               $genome,
               $griffin['energy'],
               $griffin['maxHealth'],
               $griffin['health'],
               $griffin['maxTameness'],
               $griffin['tameness'],
               $griffin['imagepath'],
               $griffin['str'],
               $griffin['agi'],
               $griffin['intl'],
               $griffin['spd'],
               $griffin['con'],
               $griffin['height'],
               $griffin['weight']);
               $barn[$griffin['id']]->setHunger($griffin['hunger']);
    }
    return $barn;
}

function add_griff($griffin, $userid){
    $genomeStore = DAMethods::genome_encode($griffin->getGenome());
    $name = $griffin->getName();
    $sex = $griffin->getSex();
    $height = $griffin->getHeight();
    $weight = $griffin->getWeight();
    $str = $griffin->getStr();
    $spd = $griffin->getSpd();
    $agi = $griffin->getAgi();
    $intl = $griffin->getInt();
    $con = $griffin->getCon();
    $mother = $griffin->getMother();
    $father = $griffin->getFather();
    $health = '10';
    $energy = '10';
    $MaxTameness = $griffin->getMaxTameness();
    $tameness = $griffin->getTameness();
    $status = 'active';
    $imagepath = 'generate';
        global $db;
        $query = "INSERT INTO griffins 
                (userid, name, sex, genome, height, weight, str, intl, spd, agi, con, mother, father, health, energy, maxTameness, tameness, status, imagepath)
         VALUES (:userid, :name, :sex, :genome, :height, :weight, :str, :intl, :spd, :agi, :con, :mother, :father, :health, :energy, :maxTameness, :tameness, :status, :imagepath);";
        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userid);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':sex', $sex);
        $statement->bindValue(':genome', $genomeStore);
        $statement->bindValue(':height', $height);
        $statement->bindValue(':weight', $weight); 
        $statement->bindValue(':str', $str);
        $statement->bindValue(':intl', $intl);
        $statement->bindValue(':spd', $spd);
        $statement->bindValue(':agi', $agi);
        $statement->bindValue(':con', $con);
        $statement->bindValue(':mother', $mother);
        $statement->bindValue(':health', $health);
        $statement->bindValue(':father', $father);
        $statement->bindValue(':energy', $energy);
        $statement->bindValue(':maxTameness', $MaxTameness);
        $statement->bindValue(':tameness', $tameness);
        $statement->bindValue(':status', $status);
        $statement->bindValue(':imagepath', $imagepath);
        $statement->execute();
        $statement->closeCursor();
    
}

function get_genes($genomeArray){
    $g = array();
    global $db;
    foreach ($genomeArray as $geneSearch){
      $query = 'SELECT * FROM genes WHERE gene = :gene AND allele = :allele';
      $statement = $db->prepare($query);
      $statement->bindValue(':gene', $geneSearch[0]);
      $statement->bindValue(':allele', $geneSearch[1]);
      $statement->execute();
      $genetics = $statement->fetchAll();
      $statement->closeCursor();
      
      foreach($genetics as $gene){
                  $gene['id'] = new Gene(
                  $gene['name'],
                  $gene['allele'],
                  $gene['tameness'],
                  $gene['weight']);
          array_push($g, $gene['id']);
      }
    }
    $genome = new Genome($g[0], $g[1], $g[2], $g[3], $g[4], $g[5], $g[6], $g[7], $g[8], $g[9], $g[10], $g[11], $g[12], $g[13], $g[14], $g[15], $g[16], $g[17], $g[18], $g[19], $g[20], $g[21], $g[22], $g[23], $g[24], $g[25]);
    return $genome; 
}

function get_griff_by_id($id){
     global $db;
    $query = "SELECT * FROM griffins WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $griffs = $statement->fetchAll();
    $statement->closeCursor();

    foreach ($griffs as $griffin){
       $genomeArray= DAMethods::genome_parse($griffin['genome']);
       $genome = get_genes($genomeArray);
               $griffin['id'] = new Pet(
               $griffin['id'],
               $griffin['name'],
               $griffin['sex'],
               $griffin['mother'],
               $griffin['father'],
               $griffin['age'],
               $griffin['breed'],
               $genome,
               $griffin['energy'],
               $griffin['maxHealth'],
               $griffin['health'],
               $griffin['maxTameness'],
               $griffin['tameness'],
               $griffin['imagepath'],
               $griffin['str'],
               $griffin['agi'],
               $griffin['intl'],
               $griffin['spd'],
               $griffin['con'],
               $griffin['height'],
               $griffin['weight']);
               $griffin['id']->setHunger($griffin['hunger']);
    }
    return $griffin['id'];
}

function get_griffs_by_sex($userid, $sex){
    
     global $db;
    $query = "SELECT * FROM griffins WHERE userid = :userid AND status = 'active' AND sex = :sex";
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':sex', $sex);
    $statement->execute();
    $griffs = $statement->fetchAll();
    $statement->closeCursor();
    
    
    foreach ($griffs as $griffin){
       $genomeArray= DAMethods::genome_parse($griffin['genome']);
       $genome = get_genes($genomeArray);    
       $list[$griffin['id']] = new Pet(
               $griffin['id'],
               $griffin['name'],
               $griffin['sex'],
               $griffin['mother'],
               $griffin['father'],
               $griffin['age'],
               $griffin['breed'],
               $genome,
               $griffin['energy'],
               $griffin['maxHealth'],
               $griffin['health'],
               $griffin['maxTameness'],
               $griffin['tameness'],
               $griffin['imagepath'],
               $griffin['str'],
               $griffin['agi'],
               $griffin['intl'],
               $griffin['spd'],
               $griffin['con'],
               $griffin['height'],
               $griffin['weight']);
    }
    return $list;
}

function feed($userid, $griffid){
    global $db;
    $query = "UPDATE griffins SET hunger = hunger + 1 WHERE userid = :userid AND id = :griffid ;
              UPDATE users WHERE userid = :userid SET food = food - 1;";
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':griffid', $griffid);
    $statement->execute();
    $statement->closeCursor();
    
}

function medicine($userid, $griffid){
        global $db;
    $query = "UPDATE griffins SET health = health + 1, energy = energy -1;
             UPDATE users WHERE userid = :userid SET medicine = medicine - 1 WHERE userid = :userid AND id = :griffid AND energy > 1;";        
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':griffid', $griffid);
    $statement->execute();
    $statement->closeCursor();
}

function train($userid, $griffid){
    global $db;
    $query = "UPDATE griffins SET tameness = tameness + 1, "
            . "energy = energy - 3 WHERE userid = :userid AND id = :griffid AND energy > 3 AND tameness < maxTameness";
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':griffid', $griffid);
    $statement->execute();
    $statement->closeCursor();
}
function rename_griff($userid, $griffid, $newName){
    global $db;
    $query = "UPDATE griffins SET name = :newName WHERE userid = :userid AND id = :griffid";
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':griffid', $griffid);
    $statement->bindValue(':newName', $newName);
    $statement->execute();
    $statement->closeCursor();
}

function get_genes_by_type($gene){
     $g = array();
    global $db;
    
      $query = 'SELECT * FROM genes WHERE gene = :gene ';
      $statement = $db->prepare($query);
      $statement->bindValue(':gene', $gene);
      $statement->execute();
      $genetics = $statement->fetchAll();
      $statement->closeCursor();
      
      foreach($genetics as $gene){
                  $gene['id'] = new Gene(
                  $gene['name'],
                  $gene['allele'],
                  $gene['tameness'],
                  $gene['weight']);
          array_push($g, $gene['id']);
      }
    return $g;
}

function get_griffs_need_image($id){
     global $db;
    $query = "SELECT * FROM griffins WHERE imagepath = 'generate' and userid = :id";
    $statement = $db->prepare($query);
     $statement->bindValue(':id', $id);
    $statement->execute();
    $griffs = $statement->fetchAll();
    $statement->closeCursor();
    
    
    foreach ($griffs as $griffin){
       $genomeArray= DAMethods::genome_parse($griffin['genome']);
       $genome = get_genes($genomeArray);    
       $list[$griffin['id']] = new Pet(
               $griffin['id'],
               $griffin['name'],
               $griffin['sex'],
               $griffin['mother'],
               $griffin['father'],
               $griffin['age'],
               $griffin['breed'],
               $genome,
               $griffin['energy'],
               $griffin['maxHealth'],
               $griffin['health'],
               $griffin['maxTameness'],
               $griffin['tameness'],
               $griffin['imagepath'],
               $griffin['str'],
               $griffin['agi'],
               $griffin['intl'],
               $griffin['spd'],
               $griffin['con'],
               $griffin['height'],
               $griffin['weight']);
    }
    return $list;
}

function pasture($userid, $griffID){
     global $db;
    $query = "UPDATE griffins SET status='pasture' WHERE userid = :userid AND id = :griffid";
    $statement = $db->prepare($query);
    $statement->bindValue(':userid', $userid);
    $statement->bindValue(':griffid', $griffID);
    $statement->execute();
    $statement->closeCursor();
}

function update_image($griffID){
    $imagePath = 'g_'.$griffID.'.png';
    global $db;
    $query = "UPDATE griffins SET imagepath=:imagepath WHERE id = :griffid";
    $statement = $db->prepare($query);
    $statement->bindValue(':imagepath', $imagePath);
    $statement->bindValue(':griffid', $griffID);
    $statement->execute();
    $statement->closeCursor();
}

function puberty($griffID){
    global $db;
    $query = "UPDATE griffins SET height=height*4, weight=weight*10 WHERE id = :griffid";
    $statement = $db->prepare($query);
    $statement->bindValue(':griffid', $griffID);
    $statement->execute();
    $statement->closeCursor();
}




    

   


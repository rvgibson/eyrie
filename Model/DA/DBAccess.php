<?php
    include_once('DAMethods.php');

    $dsn="mysql:host=184.154.206.12;dbname=pidrawsc_eyrie;charset=utf8";
    $username='pidrawsc_birdadmin';
    $password='Squareroot#2';

try {
     $db = new PDO($dsn, $username, $password);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    } catch (PDOException $e) {
    echo $e->getMessage();
    exit();
    }
    
function get_user($username) {
    global $db;
    $query = 'SELECT id, username, barn, food, medicine, money FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $info = $statement->fetchAll();
    $statement->closeCursor();
    
    $user = new User($info['id'], $info['username'], $info['barn'], $info['food'], info['medicine'], info['money']);
    
    return $user;   
}

function get_user_by_id($id){
     global $db;
    $query = 'SELECT id, username, barn, food, medicine, money FROM users WHERE id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->execute();
    $info = $statement->fetchAll();
    $statement->closeCursor();
    
    $user = new User($info['id'], $info['username'], $info['barn'], $info['food'], info['medicine'], info['money']);
    
    return $user;   
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
    }
    return $barn;
}

function add_griff($griffin, $userid){
    $genomeStore = DAMethods::genome_encode($griffin->getGenome());
     global $db;
        $query = 'INSERT INTO griffins '
                . '(`userid`, `name`, `sex`, `genome`, `height`, `weight`, `age`, `str`, `intl`, `spd`, `agi`, `con`, `mother`, `father`, `breed`, `maxHealth`, `health`, `maxEnergy`, `energy`, `maxTameness`, `tameness`, `status`, `imagepath`) '
                . 'VALUES (:userid, :name, :sex, :genome, :height, :weight, :age, :str, :intl, :spd, :agi, :con, :mother, :father, :breed, :maxHealth, :health, :maxEnergy, :energy, :maxTameness, :tameness, :status, :imagepath)';
        $statement = $db->prepare($query);
        $statement->bindValue(':userid', $userid);
        $statement->bindValue(':name', $griffin->getName());
        $statement->bindValue(':sex', $griffin->getSex());
        $statement->bindValue(':genome', $genomeStore);
        $statement->bindValue(':height', $griffin->getHeight());
        $statement->bindValue(':weight', $griffin->getWeight());
        $statement->bindValue(':age', 0);
        $statement->bindValue(':str', $griffin->getStr());
        $statement->bindValue(':intl', $griffin->getInt());
        $statement->bindValue(':spd', $griffin->getSpd());
        $statement->bindValue(':agi', $griffin->getAgi());
        $statement->bindValue(':con', $griffin->getCon());
        $statement->bindValue(':mother', $griffin->getMother());
        $statement->bindValue(':father', $griffin->getFather());
        $statement->bindValue(':breed', 30);
        $statement->bindValue(':maxHealth', $griffin->getMaxHealth());
        $statement->bindValue(':health', $griffin->getHealth());
        $statement->bindValue(':maxEnergy', 30);
        $statement->bindValue(':energy', 30);
        $statement->bindValue(':maxTameness', $griffin->getMaxTameness());
        $statement->bindValue(':tameness', $griffin->getTameness());
        $statement->bindValue(':status', "active");
        $statement->bindValue(':imagePath', 'NA');
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
    }
    return $griffin;
}



    

   


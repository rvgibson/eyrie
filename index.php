<?php
require_once('Model/DA/GriffDA.php');
require_once('Model/DA/UserDA.php');
require_once('Model/Barn.php');
require_once('Model/Gene.php');
require_once('Model/Genome.php');
require_once('Model/Pet.php');
require_once('Model/User.php');
require_once('Model/Breeder.php');
require_once ('Model/loginManager.php');
require_once('vendor/autoload.php');
use Invervention\Image\ImageManager;

$action = filter_input(INPUT_POST, 'action');
if($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    if($action === NULL){
        $action = 'main';
    }
}
session_start();
if(!isset($_SESSION['user'])){
    $_SESSION['user']=NULL;
}
$_SESSION['loginattempts'] = 0;

switch ($action) {
    
    case 'main':
        include('./View/home.php');
        break;
    
    case 'goLogin':
        if($_SESSION['user'] == NULL){
        include('./View/login.php'); }
        else {
            include('./View/profile.php');
        } 
        break;
    
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $user = get_user($username);
        $password = filter_input(INPUT_POST, 'password');
        //retrieve the hashed password from the users table by username
        $hash_from_db = get_user_password($user->getId());
        //check the entered password against the hashed password received from the users table
        if (!password_verify($password, $hash_from_db)) {
            //password does not match--exit script and redirect to login
            $login_result = "Incorrect login. Please try again.";
            include('./View/login.php');
        } else {
            $_SESSION['user'] = get_user($username);
            $_SESSION['turns'] = 20;
            include('./View/home.php');
        }
        die();
        break;
    
    case 'register':
        $regError = '';
        include('./View/register.php');
        break;
    
    case 'submit_registration':
        //get data from the form
        $username = htmlspecialchars(trim(filter_input(INPUT_POST, 'username')));
        $email = htmlspecialchars(trim(filter_input(INPUT_POST, 'email_address')));
        $password = filter_input(INPUT_POST, 'password');     

        //validate and verify registration
        $regError = validate_reg($username, $password, $email);
        if($regError === ''){
            register_user($username, $password, $email);
            $message = 'Thank you for registering!';
            //log user in
            $_SESSION['user'] = get_user($username);
            $userid = $_SESSION['user']->getId();
            //generate random starter pets for new user
            $m = Breeder::make_starter_pet('M');
            add_griff_retroactive($m, $userid);
            $f = Breeder::make_starter_pet('F');
            add_griff_retroactive($f, $userid);
            
            $needimage = get_griffs_need_image($userid);
            foreach ($needimage as $birb){
                $phenotype = Breeder::punnet($birb->getGenome());
                Breeder::imageBuilder($phenotype, $birb->getId());
                update_image($birb->getId());
            }
            include('./View/loginconfirm.php');
        }
        else {
            include('./View/register.php');
        }
        break;

    case 'logout':
        session_destroy();
        header('location:index.php');
        break;
    
    case 'barn':
        $logintoken = false;
        $userID = filter_input(INPUT_GET, 'utarget');
        $griffinsList = get_griffs_active($userID);
        if($userID === $_SESSION['user']->getId()){
        $logintoken = true;}
        include('./View/barn.php');
        break;
    
    case 'profile':
        $logintoken = false;
        $userID = filter_input(INPUT_GET, 'utarget');
        if($userID === $_SESSION['user']->getId()){
        $logintoken = true;}
        include('./View/profile.php');
        break;
    
    case 'griffin':
        $logintoken = false;
        $griffID = filter_input(INPUT_GET, 'pid');
        $griff = get_griff_by_id($griffID);
         $ageDays=(time()-strtotime($griff->getAge()))/86400;
//            if ($ageDays >= 30){
//                puberty($griff); 
//            }
        $owner = get_user_by_griffin($griffID);
        if($owner === $_SESSION['user']->getId()){
        $logintoken = true;}
        $barn = get_griffs_active($owner);
        include('./View/griff.php');
        break;
   
    //Go to Breeding page and get list of viable pets
    case 'breeder':
        $logintoken = false;
        $mother = NULL;
        $father = NULL;
        $griffSelected = filter_input(INPUT_POST, 'griffID');
        $griff=get_griff_by_id($griffSelected);
        if ($griff->getSex() === "F"){
            $mother = $griff;
        } else if($griff->getSex() === "M"){
            $father = $griff;
        }
        if ($mother == NULL || !isset($mother)){
            $mother = "Select";
        }
        if ($father == NULL || !isset($father)){
            $father = "Select";
        }
        $femaleList = get_griffs_by_sex($_SESSION['user']->getId(), 'F');
        $maleList = get_griffs_by_sex($_SESSION['user']->getId(), 'M');
        $fBreedable = array();
        $mBreedable = array();
        foreach ($femaleList as $griff){
            $ageDays=(time()-strtotime($griff->getAge()))/86400;
            if ($ageDays >= 30){
                array_push($fBreedable, $griff); 
            }
        }
        foreach ($maleList as $griff){
            $ageDays=(time()-strtotime($griff->getAge()))/86400;
            if ($ageDays >= 30){
                array_push($mBreedable, $griff); 
            }
        }
        
        include('./View/breed.php');
        break;
    
    //breed selected pets, create new pet, and add to db
    case 'breed':
        require_once('./Model/Breeder.php');
        $motherID = filter_input(INPUT_POST, 'selectMother');
        $fatherID = filter_input(INPUT_POST, 'selectFather');
        $mother = get_griff_by_id($motherID);
        $father = get_griff_by_id($fatherID);
        $baby = Breeder::breedPets($mother, $father);
        add_griff($baby, $_SESSION['user']->getID());
        $needimage = get_griffs_need_image($_SESSION['user']->getID());
        foreach ($needimage as $birb){
            $phenotype = Breeder::punnet($birb->getGenome());
            Breeder::imageBuilder($phenotype, $birb->getId());
            update_image($birb->getId());
        }
        $griffinsList = get_griffs_active($_SESSION['user']->getID());
         header('location:index.php?action=barn&utarget='.$_SESSION['user']->getID());
        
        break;
    
    case 'pedigree':
        $griffID = filter_input(INPUT_POST, 'griffin');
        $griff = get_griff_by_id($griffID);
        $mother = get_griff_by_id($griff->getMother());
        $father = get_griff_by_id($griff->getFather());
        $offspring = get_offspring($griffID);
        if ($mother !== NULL){
        $matGrandmother = get_griff_by_id($mother->getMother());
            if($matGrandmother !== NULL){
               $matGGrandmother1 = get_griff_by_id($matGrandmother->getMother());
                $matGGrandfather1 = get_griff_by_id($matGrandmother->getFather());
            }
        $matGrandfather = get_griff_by_id($mother->getFather());
            if($matGrandfather !== NULL){
                $matGGrandmother2 = get_griff_by_id($matGrandfather->getMother());
                $matGGrandfather2 = get_griff_by_id($matGrandfather->getFather()); 
            }
        
        }
        if($father !== NULL){
        $patGrandmother = get_griff_by_id($father->getMother());
            if($patGrandmother !== NULL){
                $patGGrandmother1 = get_griff_by_id($patGrandmother->getMother());
                $patGGrandfather1 = get_griff_by_id($patGrandmother->getFather());
            }
        $patGrandfather = get_griff_by_id($father->getFather());
            if($patGrandfather !== NULL){
               $patGGrandmother2 = get_griff_by_id($patGrandfather->getMother());
               $patGGrandfather2 = get_griff_by_id($patGrandfather->getFather()); 
            }
        } 
        break;
    
    case 'feedAll':
        $barn = get_griffs_active($_SESSION['user']->getId());
        while ($_SESSION['user']->getFood() > 0){
            foreach ($barn as $griff){
                if ($griff->getHunger() < 10){
                    feed($_SESSION['user']->getId(), $griff->getId());
                }
            }
        }
        header('location:index.php?action=barn&utarget=' . $_SESSION['user']->getId());
        break;
    
    case 'feed':
        $griffID = filter_input(INPUT_POST, 'griffID');
        $griff = get_griff_by_id($griffID);
        if($griff->getHunger() < 10){
        feed($_SESSION['user']->getId(), $griffID);}
        header('location:index.php?action=griffin&pid=' . $griffID);
        break;
    case 'train':
        $griffID = filter_input(INPUT_POST, 'griffID');
        train($_SESSION['user']->getId(), $griffID);
        header('location:index.php?action=griffin&pid=' . $griffID);
        break;
    
    case 'medicine':
        $griffID = filter_input(INPUT_POST, 'griffID');
        medicine($_SESSION['user']->getId(), $griffID);
       header('location:index.php?action=griffin&pid=' . $griffID);
        break;
    
    case 'rename':
        $griffID = filter_input(INPUT_POST, 'griffID');
        $newName = filter_input(INPUT_POST, 'newName');
        rename_griff($_SESSION['user']->getId(), $griffId, $newName);
        header('location:index.php?action=griffin&pid=' . $griffID);
        break;
    
    case 'pasture':
        $griffID = filter_input(INPUT_POST, 'griffID');
        pasture($_SESSION['user']->getId(), $griffID);
        header('location:index.php?action=barn&utarget=' . $_SESSION['user']->getId());
        break;
    
    case 'explore':
        $message = '';
        include('./View/explore.php');
        
        break;
    
    case 'gather':
        $random = random_int(0, 100);
        if($random < 30){
            $message = "You didn't find anything.";
        }else if($random >= 30 && $random <=80){
            $food = random_int(1, 3);
            $message = "You found " . $food . " food!"; 
            update_food($_SESSION['user']->getId(), $food);
        }else if($random > 80 && $random < 85){
            $message = "You found 1 medicine!";
            update_medicine($_SESSION['user']->getId(), 1);
        }else if($random >=85){
            $money = random_int(1, 50);
            $message = "You found " .$money. " money!";
            update_money($_SESSION['user']->getId(), $money);
        }
        include('./View/explore.php');
        break;
    
    case 'trap':
        $random = random_int(0,100);
        if($random >= 72){
            $message = "You found a wild griffin!";
            $s = random_int(1, 2);
            if ($s === 1){
                $sex = 'F';
            }
            else {
                $sex = 'M'; 
            }
            $wildGriff = Breeder::make_starter_pet($sex);
            $wildGriffPassable = json_encode($wildGriff);
            $phenotype = Breeder::punnet($wildGriff->getGenome());
            Breeder::imageBuilder($phenotype, "wild");
            $WildImg = "./Model/griffin_images/g_wild.png";
        }
        else {
            $message = "You didn't find any griffins.";
        }
        include('./View/explore.php');
        break;
        
    case 'keep':
        $griffEncoded = $_POST["griff"];
        $griffin = json_decode($griffEncoded);
        include('./View/explore.php');
        break;
    case 'market':
        include('./View/shop.php');
        break;
    
    case 'newday':
        
        break;
    
    case 'admin':
        
        break;
    
    case 'buy':
        
        break;
    
    case 'makeGriff':
        $color = get_genes_by_type('color');
        $eyes = get_genes_by_type('eyes');
        $ears = get_genes_by_type('ears');
        $coat = get_genes_by_type('coat');
        $pattern = get_genes_by_type('pattern');
        $markings = get_genes_by_type('marking');
        $tail = get_genes_by_type('tail');
        $skin = get_genes_by_type('skin');
        $build = get_genes_by_type('build');
        $beak = get_genes_by_type('beak');
        $feet = get_genes_by_type('feet');
       include('./View/testGriffMaker.php');
        break;
    
    case 'make':
            $colorMother = filter_input(INPUT_POST, 'colorM');
            $colorFather = filter_input(INPUT_POST, 'colorF');
            $eyesMother = filter_input(INPUT_POST, 'eyesM');
            $eyesFather = filter_input(INPUT_POST, 'eyesF');
            $earsMother = filter_input(INPUT_POST, 'earsM');
            $earsFather= filter_input(INPUT_POST, 'earsF');
            $coatMother= filter_input(INPUT_POST, 'coatM');
            $coatFather= filter_input(INPUT_POST, 'coatF');
            $patternMother= filter_input(INPUT_POST, 'patternM');
            $patternFather= filter_input(INPUT_POST, 'patternF');
            $markingsMother= filter_input(INPUT_POST, 'markingsM');
            $markingsFather= filter_input(INPUT_POST, 'markingsF');
            $tailMother= filter_input(INPUT_POST, 'tailM');
            $tailFather= filter_input(INPUT_POST, 'tailF');
            $skinMother= filter_input(INPUT_POST, 'skinM');
            $skinFather= filter_input(INPUT_POST, 'skinF');
            $buildMother= filter_input(INPUT_POST, 'buildM');
            $buildFather= filter_input(INPUT_POST, 'buildF');
            $beakMother= filter_input(INPUT_POST, 'beakM');
            $beakFather= filter_input(INPUT_POST, 'beakF');
            $feetMother= filter_input(INPUT_POST, 'feetM');
            $feetFather= filter_input(INPUT_POST, 'feetF');
            $name = filter_input(INPUT_POST, 'griffname');
            $sex = filter_input(INPUT_POST, 'sex');
            $mother = filter_input(INPUT_POST, 'mother');
            $father = filter_input(INPUT_POST, 'father');
            $str = filter_input(INPUT_POST, 'str');
            $intl = filter_input(INPUT_POST, 'intl');
            $agi = filter_input(INPUT_POST, 'agi');
            $con = filter_input(INPUT_POST, 'con');
            $spd = filter_input(INPUT_POST, 'spd');
            $height = filter_input(INPUT_POST, 'height');
            $weight = filter_input(INPUT_POST, 'weight');
            $genomeString = $colorMother . $colorFather . $eyesMother . $eyesFather . $earsMother . $earsFather . $coatMother . $coatFather . $patternMother . $patternFather . $markingsMother . $markingsFather . $tailMother . $tailFather . $skinMother . $skinFather . $buildMother . $buildFather . $beakMother . $beakFather . $feetMother . $feetFather. 'W' .'W'.'W'.'W';
            $genomeArray = DAMethods::genome_parse($genomeString);
            $testGenome = get_genes($genomeArray);
            $maxTameness = $testGenome->calcTameness();
            $tameness = round($maxTameness/5);
            $testGriff = new Pet(NULL, $name, $sex, $mother, $father, NULL, NULL, $testGenome, 10, 10, 10, $maxTameness, (int) $tameness, 'generate', $str, $agi, $intl, $spd, $con, $height, $weight);
            add_griff($testGriff, $_SESSION['user']->getId());
 
           $needimage = get_griffs_need_image($_SESSION['user']->getID());
        foreach ($needimage as $birb){
            $phenotype = Breeder::punnet($birb->getGenome());
            Breeder::imageBuilder($phenotype, $birb->getId());
            update_image($birb->getId());
        }
        $griffinsList = get_griffs_active($_SESSION['user']->getID());
        header('location:index.php?action=barn&utarget='.$_SESSION['user']->getId());
        break;
       
        case 'test':
            $test = Breeder::make_starter_pet(1, "F");
            var_dump($test);
            break;
}
?>

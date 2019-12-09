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
        //get the username
        $username = htmlspecialchars(filter_input(INPUT_POST, 'username'));
        //get the password
        $password = filter_input(INPUT_POST, 'password');
        $user = get_user($username);
        $checkPassword = get_user_password($user['id']);
        
        if(!password_verify($password, $checkPassword)){
            //passwords don't match - return login error
            if($_SESSION['loginattempts'] >= 5){
            $loginMessage = "Too many login attempts. Please try again later or contact an administrator for help with your account at support@pidraws.com";
            }
            else{
            $loginMessage = "Incorrect username and/or password. Please try again";
            $_SESSION['loginattempts']++;
            }
        }
        else{
                $_SESSION['user'] = $user;
                include('./index.php?action=main');
           }
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
            include('./View/loginconfirm.php');
        }
        else {
            include('/View/register.php');
        }
        break;

    case 'logout':
        $_SESSION['user'] = NULL;
        include('./View/home.php');
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
            if ($ageDays >= 30){
                puberty($griff); 
            }
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
        $genCounter = 0;
        $griffID = filter_input(INPUT_GET, 'griffin');
        $griff = get_griff_by_id($griffID);
        $mother = get_griff_by_id($griff->getMother());
        $father = get_griff_by_id($griff->getFather());
        $matGrandmother = get_griff_by_id($mother->getMother());
        $matGrandfather = get_griff_by_id($mother->getFather());
        $patGrandmother = get_griff_by_id($father->getMother());
        $patGrandfather = get_griff_by_id($father->getFather());
        $matGGrandmother1 = get_griff_by_id($matGrandmother->getMother());
        $matGGrandmother2 = get_griff_by_id($matGrandfather->getMother());
        $matGGrandfather1 = get_griff_by_id($matGrandmother->getFather());
        $matGGrandfather2 = get_griff_by_id($matGrandfather->getFather());
        $patGGrandmother1 = get_griff_by_id($patGrandmother->getMother());
        $patGGrandmother2 = get_griff_by_id($patGrandfather->getMother());
        $patGGrandfather1 = get_griff_by_id($patGrandmother->getFather());
        $patGGrandfather2 = get_griff_by_id($patGrandfather->getFather());
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
            add_griff($testGriff, '1');
 
           $needimage = get_griffs_need_image($_SESSION['user']->getID());
        foreach ($needimage as $birb){
            $phenotype = Breeder::punnet($birb->getGenome());
            Breeder::imageBuilder($phenotype, $birb->getId());
            update_image($birb->getId());
        }
        $griffinsList = get_griffs_active($_SESSION['user']->getID());
        header('location:index.php?action=barn&utarget='.$_SESSION['user']->getId());
        break;
}
?>

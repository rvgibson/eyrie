<?php
require_once('Model/DA/DBAccess.php');
require_once('Model/Barn.php');
require_once('Model/Gene.php');
require_once('Model/Genome.php');
require_once('Model/Pet.php');
require_once('Model/User.php');

$action = filter_input(INPUT_POST, 'action');
if($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
    if($action === NULL){
        $action = 'main';
    }
}

$_SESSION['user'] = NULL;

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
        
        break;
    
    case 'logout':
        $_SESSION['user'] = NULL;
        include('./View/home.php');
        break;
    
    case 'barn':
        $userID = filter_input(INPUT_GET, 'utarget');
        $griffinsList = get_griffs_active($userID);
        include('./View/barn.php');
        break;
    
    case 'profile':
        $userID = filter_input(INPUT_GET, 'user');
        
        break;
    
    case 'griffin':
        $griffID = filter_input(INPUT_GET, 'pid');
        $griff = get_griff_by_id($griffID);
        include('./View/griff.php');
        break;
    
    case 'breeder':
        $mother = filter_input(INPUT_POST, 'motherID');
        $father = filter_input(INPUT_POST, 'fatherID');
        if ($mother == NULL || !isset($mother)){
            $mother = "Select";
        }
        if ($father == NULL || !isset($father)){
            $father = "Select";
        }
        $femaleList = get_griffs_by_sex($_SESSION[user]->getId(), 'F');
        $maleList = get_griffs_by_sex($_SESSION[user]->getId(), 'M');
        $fBreedable = [];
        $mBreedable = [];
        foreach ($femaleList as $griff){
            if ((time()- strtotime($griff->getAge()))/86400 >= 30 && (time()- strtotime($griff->getBreedTimer()))/86400 >= 14){
                array_push($fBreedable, $griff); 
            }
        }
        foreach ($maleList as $griff){
            if ((time()- strtotime($griff->getAge()))/86400 >= 30 && (time()- strtotime($griff->getBreedTimer()))/86400 >= 14){
                array_push($mBreedable, $griff); 
            }
        }
        include('./View/breed.php');
        break;
    
    case 'breed':
        $motherID = filter_input(INPUT_POST, 'selectMother');
        $fatherID = filter_input(INPUT_POST, 'selectFather');
        $mother = get_griff_by_id($motherID);
        $father = get_griff_by_id($fatherID);
        require_once('Model/Breeder.php');
        $baby = Breeder::breedPets($mother, $father);
        add_griff($baby, $_SESSION[user]->getID());
        $griffinsList = get_griffs_active($_SESSION[user]->getID());
        include('./View/barn.php');
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
    
    case 'feed':
        $barn = get_griffs_active($_SESSION['user']->getId());
        while ($_SESSION['user']->getFood() > 0){
            foreach ($barn as $griff){
                if ($griff->getHunger()){}
            }
        }
        break;
    
    case 'train':
        
        break;
    
    case 'medicine':
        
        break;
    
    case 'pasture':
        
        break;
    
    case 'market':
        
        break;
    
    case 'newday':
        
        break;
    
    case 'admin':
        
        break;
    
    case 'buy':
        
        break;
}
?>

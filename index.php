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
        //$userID = filter_input(INPUT_GET, 'user');
        $griffinsList = get_griffs_active(1);
        include('./View/barn.php');
        break;
    
    case 'profile':
        $userID = filter_input(INPUT_GET, 'user');
        
        break;
    
    case 'griffin':
        
        break;
    
    case 'breed':
        $motherID = filter_input(INPUT_POST, 'motherID');
        $fatherID = filter_input(INPUT_POST, 'fatherID');
        $mother = get_griff_by_id($motherID);
        $father = get_griff_by_id($fatherID);
        require_once('Model/Breeder.php');
        $baby = Breeder::breedPets($mother, $father);
        break;
    
    case 'pedigree':
        
        break;
    
    case 'feed':
        
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

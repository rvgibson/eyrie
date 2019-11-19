<?php
require_once('../Model/DA.php');
require_once('../Model/Barn.php');
require_once('../Model/Gene.php');
require_once('../Model/Genome.php');
require_once('../Model/Pet.php');
require_once('../Model/User.php');

$action = filer_input(INPUT_POST, 'action');
if($action == NULL){
    $action = filter_inter(INPUT_GET, 'action');
    if($action === NULL){
        $action = 'main';
    }
}

$_SESSION['user'] = NULL;

switch ($action) {
    
    case 'main':
        include('./View/home.php');
        
        break;
    
    case 'login': 
        include('./View/login.php');
        break;
    
    case 'logout':
        
        break;
    
    case 'barn':
        include('./View/barn.php');
        break;
    
    case 'profile':
        
        break;
    
    case 'griffin':
        
        break;
    
    case 'breed':
        
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

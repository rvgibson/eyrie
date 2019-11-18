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
?>

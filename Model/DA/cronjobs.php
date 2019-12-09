<?php

//$dsn="mysql:host=184.154.206.12;dbname=pidrawsc_eyrie;charset=utf8";
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
    
    function dec_hunger(){
         global $db;
    $query = "UPDATE griffins SET hunger=hunger-1 WHERE hunger > 0";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
    }
    
    function reset_energy(){
        global $db;
        $query = "UPDATE griffins SET energy = maxEnergy";
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }
    
    function daily_money(){
        global $db;
        $query = "UPDATE users SET money = money + 500";
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }
    

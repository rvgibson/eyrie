<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="./main.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative|Oswald|Rye|Trade+Winds|Underdog&display=swap" rel="stylesheet">
        <title></title>
        <?php
require_once('Model/DA/GriffDA.php');
require_once('./Model/DA/UserDA.php');
require_once('./Model/Barn.php');
require_once('./Model/Gene.php');
require_once('./Model/Genome.php');
require_once('./Model/Pet.php');
require_once('./Model/User.php');
require_once('./Model/Breeder.php');
        ?>
    </head>
    <body>
        <header>
            <div id="textLogo">
                     <img src="./Images/EyrieTextLogo.png" alt="Eyrie"/>
            </div>
        </header>
        
           <nav>
            <ul>
                <li><a href="?action=main">Home</a></li>
                <li><a href="?action=<?php if(isset($_SESSION['user']) && $_SESSION['user'] !== NULL){echo 'barn&utarget='.$_SESSION['user']->getId();} else{ echo 'goLogin.php';} ?>">Barn</a></li>
                <li><a href="?action=explore">Explore</a></li>
                <li><a href="?action=market">Shop</a></li>
                <li><a href="?action=<?php if(isset($_SESSION['user']) && $_SESSION['user'] !== NULL){echo 'profile&utarget='.$_SESSION['user']->getId();} else{ echo 'goLogin.php';} ?>"">Profile</a></li>
                <li><a href="?action=goLogin"><?php if($_SESSION['user']){
                                                        $loginText = "Logout";
                                                            }else{$loginText = "Login";}
                                                            echo $loginText;?></a></li>
                <?php if(isset($_SESSION['user']) && $_SESSION['user'] !== NULL && $_SESSION['user']->getRole() === 'admin'){?><li><a href="?action=makeGriff">Make Test Griff</a></li>
                <li><a href="?action=goAdmin">Admin Portal</a></li>
                <?php } ?>
            
            
            <?php if(isset($_SESSION['user']) && $_SESSION['user'] !== NULL){?>
               
                   <li style="padding-left: 20%"><a href="./index.php?action=profile&uid=<?php echo $_SESSION['user']->getId(); ?>"><?php echo $_SESSION['user']->getUsername();?></a></li>
                   <li>Money: <?php echo $_SESSION['user']->getMoney();?></li>
                   <li>Food: <?php echo $_SESSION['user']->getFood(); ?></li>
                   <li>Hunger: <?php $allGriffs = get_griffs_active($_SESSION['user']->getId());
                                     $totalHunger;
                                     $hunger = 0;
                                     foreach($allGriffs as $griffin){
                                         $hunger = $hunger + $griffin->getHunger();
                                     }
                                     $totalHunger = round(($hunger/ count($allGriffs)), 0);
                                     echo $totalHunger;
                                    ?> </li>
                   <li>Energy: <?php
                                     $totalEnergy;
                                     $energy = 0;
                                     foreach($allGriffs as $griffin){
                                         $energy += $griffin->getEnergy();
                                     }
                                     $totalEnergy = round(($energy/ count($allGriffs)), 0);
                                     echo $totalHunger;
                                    ?></li> 
                   <li>Health: <?php 
                                     $totalHealth;
                                     $health = 0;
                                     foreach($allGriffs as $griffin){
                                         $health = $health + $griffin->getHealth();
                                     }
                                     $totalHealth = round(($health/ count($allGriffs)), 0);
                                     echo $totalHealth;
                                    ?>
            <?php } ?>
                   </ul>
           </nav>


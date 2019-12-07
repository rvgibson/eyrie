<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
    $loginText = "Login";
    $userID = "1";
    ?>
    <head>
        <meta charset="UTF-8">
        <link href="./main.css" rel="stylesheet" type="text/css"/>
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Cinzel+Decorative|Oswald|Rye|Trade+Winds|Underdog&display=swap" rel="stylesheet">
        <title></title>
    </head>
    <body>
        <header>
            <div id="textLogo">
                <div id="eyrieText">EYRIE</div>
            </div>
        </header>
        
           <nav>
            <ul>
                <li><a href="?action=main">Home</a></li>
                <li><a href="?action=barn&utarget=<?php echo $userID; ?>">Barn</a></li>
                <li><a href="?action=explore">Explore</a></li>
                <li><a href="?action=shop">Shop</a></li>
                <li><a href="?action=profile&utarget=<?php echo $userID; ?>">Profile</a></li>
                <li><a href="?action=login"><?php echo $loginText; ?></a></li>
            
            </ul>
           </nav>


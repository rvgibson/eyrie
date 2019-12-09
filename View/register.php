<?php
include_once('./Model/DA/DAMethods.php');
include_once('./Model/Breeder.php');
require_once('./View/nav.php'); ?>

    <section class='main'>
    <div>
        <form id='register' method='post' autocomplete='off' action='./index.php'>
            <label for="username">Username:</label><input type="text" name="username" class="textbox"><br/>
            <label for="password">Password:</label><input type="password" name="password" class="textbox"><br/>
            <label for="email">Email:</label><input type="email" name="email" class="textbox">
        </form>
    </div>
</section>
    </body>
</html>

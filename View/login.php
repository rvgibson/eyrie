
        <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
<section>
    <form method="POST" action="./index.php">
        <label for="username">Username </label>
            <input type="text" name="username" class="textbox" <?php if (isset($username)) {
                                                                    echo "value='$username'";
                                                                } ?>><br>
            <label for="password">Password </label>
            <input type="password" name="password" class="textbox" <?php if (isset($password)) {
                                                                        echo "value='$password'";
                                                                    } ?>><br>
            <input type='hidden' name="action" value="submit_login">
            <br>
            <button type="submit">Login</button>  
    </form>
    
    <div><p>Don't have an account? <a href='./index.php?action=register'>Register here.</a></p></div>
</section>  
    </body>
</html>

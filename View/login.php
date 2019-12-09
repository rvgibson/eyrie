
        <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
<section>
    <form method="POST" action="./index.php">
        <label for="username">Username </label>
            <input type="text" name="username"><br>
            <label for="password">Password </label>
            <input type="password" name="password"><br>
            <input type='hidden' name="action" value="login">
            <br>
            <input type="submit" value="Login" name="Login" class="btn btn-primary">  
    </form>
    
    <div><p>Don't have an account? <a href='./index.php?action=register'>Register here.</a></p></div>
</section>  
    </body>
</html>

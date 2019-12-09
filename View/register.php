<?php
include_once('./Model/DA/DAMethods.php');
include_once('./Model/Breeder.php');
require_once('./View/nav.php'); ?>

    <section class='main'>

        <h2 id="register-header">Registration</h2>
            <form id="register" method="POST" action="./index.php">
                                        
              
                        <label>Email Address</label>
                        <input type="text" name="email_address">
                        <br/>
                        <label>Username</label>
                        <input type="text" name="username"  >
                        <br/>
                        <label>Password</label>
                        <input type="password" name="password"> 
                        <br/>
                    <input type="hidden" name="action" value="submit_registration">
                    <input type="submit" name="Submit" value="Submit">
                </div>
            </form>
            
            <?php if($regError !== ''){echo $regError; } ?>
            </section>
         </section>
    </body>
</html>

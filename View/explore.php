 <?php
       include_once('./Model/DA/DAMethods.php');
       include_once('./Model/Breeder.php');
       require_once('./View/nav.php'); ?>
<section>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <a href="./index.php?action=gather">Gather</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="./index.php?action=trap">Trap</a>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="messageOut">
            <?php echo $message; ?>
        </div>
        <div class="WildGriff">
            <?php if(isset($WildImg)){ ?> <img src="<?php echo $WildImg; ?>">
            <form id="trapping" method="POST" action="./index.php">
                <input type="hidden" name="griff" value="<?php echo $wildGriffPassable;?>">
                <input type="hidden" name="action" value="keep">
                <input type="submit" value="Keep" name="Keep" class="btn btn-primary"> 
            </form>
            <button id="release" onclick="release()" name="Release" value="Release" class="btn-danger">Release</button>
                <?php } ?>
        </div>
    </div>
    <script>
        function release(){
        location.reload();
    }
        </script>
</section>
    </body>
</html>

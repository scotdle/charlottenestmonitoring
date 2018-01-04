<?php
session_start();
 include("styles.php");



$submissiontext= "<h1>thanks for your submission! flying back to the homepage</h1>";

echo "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php';

}, 3000); </script>"; 


?>

    <div class="logincheck ">

        <?php echo $submissiontext;
echo $errortext; ?>
    </div>
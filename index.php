<?php session_start();
include('styles.php');
include('credentialslocal.php');
?>

<?php
    if(isset($_SESSION['username'])) {            
                        
        $result = mysqli_query($mysqli, "SELECT * FROM users");
                    

header("location:maintable.php");


    } else {

	    header("location:login.php");



    }
    ?>

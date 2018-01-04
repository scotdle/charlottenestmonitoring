<?php session_start();
include('styles.php');
include('credentialslocal.php');
?>

<?php
    if(isset($_SESSION['username'])) {            
                        
        $result = mysqli_query($mysqli, "SELECT * FROM users");
                    
    $logintext = "<h1>Welcome back " . $_SESSION['username']. " flying you to the database!</h1> " . "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php';

}, 3000); </script>"; ?>
    <?php    
    } else {
       $logintext=  "<h1>Howdy Stranger! Flying you to the login page...</h1><br/><br/>" .
  "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'login.php';

}, 3000); </script>";


    }
    ?>

    <div class="logincheck">
        <?php echo $logintext; ?>

    </div>
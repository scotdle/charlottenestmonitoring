<?php
    session_start();
    include('styles.php');
    include('credentialslocal.php');

 $logintext ="<a href='register.php'>Don't have an account?</a>";
    if(isset($_POST['submit'])) {

 $username = $_POST['username'];
	$password = $_POST['password'];

	
    $result = $mysqli->query("select * from users where username = '$username'");  
        
    $row = $result->fetch_array(MYSQLI_BOTH);
        
if(password_verify($password, $row['password']  ))
	{

	    $_SESSION["id"] = $row['id'];
     $_SESSION['username'] = $_POST['username'];
    $_SESSION["name"] = $row['name'];
    $name = $_SESSION['name'];
	   $logintext = "Welcome back " . $name . "! flying you to your homepage";
        $accountcreation = " ";    
echo "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php';

}, 3000); </script>";	        
}else{
    $logintext = "Username/password is incorrect.<br><a href='passwordresettoemail.php'>forgot your password?</a><br><a href='register.php'>Don't have an account?</a>";   
    
}
    }else{


	   $nonaccounttext = '<a href="maintable.php" ><h2>view the public table without logging in</h2></a>';

    }
        
        
        
        
        
        /*
        
        
        $query = "SELECT * FROM `users` WHERE username='$username'";
		
		
	$result = mysqli_query($mysqli,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
        $_SESSION['username'] = $_POST['username'];
        
            $getname = mysqli_query($mysqli, "SELECT * FROM users WHERE username='$username'");
      while ($row=mysqli_fetch_assoc($getname))

      {   
    $name= $row['name'];      
	if(password_verify($password, $row['password']  ));
	{
	   $logintext = "Welcome back " . $name . "! flying you to your homepage";
        $accountcreation = " ";    
echo "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php';

}, 3000); </script>";	
		

	}
          
	}
          
      }else{ 
            
$logintext = "Username/password is incorrect.<br>";
$accountcreation ="<a href='register.php'>Don't have an account?</a>";     
            
        }
     */   
    
            
?>



    <div class="loginpage col-lg-12">

        <img src="images/logosecondary.png" alt="logo" class=" img-responsive center "><br>
    <div class="loginpageform">
            <form method="post">

                <div class="formgroup">
                    Username<br>
                    <input type="text" name="username" required="required" class="form-control form-add-on" placeholder="&#xf2be; "><br>
                </div>
                <div class="form-group">
                    Password<br>
                    <input type="password" name="password" class="form-control form-add-on" required="required" placeholder="&#xf023;"><br>
                </div>
                <input type="submit" name="submit" class="form-add-on submit" value="Submit &#xf2c6;"><br>
            </form>




            <div class="loginalerts">
                <?php echo $logintext; 
echo $accountcreation;                ?>
            </div>
            <div>

<?php echo $nonaccounttext; ?>
            </div>

        </div>



        <script>
            $.validate({
                modules: 'html5'
            });
        </script>

    </div>

    <?php include('endpage.php'); ?>
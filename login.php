<?php
session_start();
include( 'styles.php' );
include( 'credentialslocal.php' );

$logintext = "<button class='loginpage'><a href='register.php'>Don't have an account?</a></button>";
if ( isset( $_POST['submit'] ) ) {

	$username = $_POST['username'];
	$password = $_POST['password'];


	$result = $mysqli->query( "select * from users where username = '$username'" );

	$row = $result->fetch_array( MYSQLI_BOTH );

	if ( password_verify( $password, $row['password'] ) ) {

		$_SESSION["id"]       = $row['id'];
		$_SESSION['username'] = $_POST['username'];
		$_SESSION["name"]     = $row['name'];
		$name                 = $_SESSION['name'];
		$logintext            = "Welcome back " . $name . "! flying you to your homepage";
		$accountcreation      = " ";
		echo "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php';

}, 3000); </script>";
	} else {
		$logintext = "Username/password is incorrect.<br><button><a href='passwordresettoemail.php' class='loginpage'>forgot your password?</button></a><br><button><a href='register.php' class='loginpage'>Don't have an account?</buttona></a>";

	}
} else {


	$nonaccounttext = '<button class="loginpage"><a href="maintable.php">view the public table without logging in</button></a>';

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


    <div class="container-fluid h-100 loginpagecontainer">
        <div class="row h-100">
            <div class="col-lg-12 h-100">
                <div class="row h-100">
                    <div class="loginsection col-md-12">


                        <div class="loginpageform">
                            <img src="images/logosecondary.png" alt="logo" class=" img-responsive navbar-brand "><br>
                            <h2 class="boldheader"> found a nest? <br> sign in to record it!</h2>
                            <form method="post">

                                <div class="formgroup">
                                    <input type="text" name="username" required="required"
                                           class="form-control form-add-on"
                                           placeholder="&#xf2be; ">
                                    <h3> username</h3><br>
                                </div>
                                <div class="formgroup">

                                    <input type="password" name="password" class="form-control form-add-on"
                                           required="required"
                                           placeholder="&#xf023;">
                                    <h3>password</h3><br>
                                </div>
                                <input type="submit" name="submit" class="formsubmit submit"
                                       value="Log In &#xf2c6;"><br>
	                            <?php echo $logintext;
	                            '<hr>';
	                            echo $nonaccounttext;

	                            ?>
                            </form>

                        </div>
						<?php
						?>

                        <div class="cityimage d-none d-sm-block">
                            <img src="images/charlotteoutline.png" alt="charlotte">

                        </div>
                    </div>


                </div>

            </div>

        </div>
    </div>



<?php include( 'endpage.php' ); ?>
<?php

session_start();

include("styles.php");
include("credentialslocal.php");
include("scripts/resetemailfunction.php");

$email = $_GET['email'];
$username = $_GET['username'];
$token = $_GET['token'];


$verifytoken = verifytoken($email, $username, $token, $mysqli);




if(isset($_POST['submit']))
{
	$new_password = $_POST['new_password'];
	$new_passwordEncrypted = password_hash($new_password, PASSWORD_BCRYPT, array('cost' => 10));
	$retype_password = $_POST['retype_password'];
	
	if($new_password == $retype_password)
	{
		$update_password = mysqli_query($mysqli, "UPDATE users SET password = '$new_passwordEncrypted' WHERE username = '$username'");
		if($update_password)
		{
				mysqli_query($mysqli, "UPDATE recovery_keys SET = 0 WHERE username = '$username' AND token ='$token'");
				$alertmessage = "Your password has changed successfully. Please login with your new password.";
           echo " <script>
    window.setTimeout(function() {

        // Move to a new location or you can do something else
        window.location.href = 'login.php';

    }, 2000);
</script>";

		}
	}else
	{
		 $alertmessage = "Password doesn't match";
	
	}
	
}

?>
<?php if($verifytoken == 1) { ?>
  <div class="registerpage col-lg-12">
        <h2>New Password</h2>

        <div class="registerpageform">
            <form method="post">


                New Password<br>
                <input type="password" name="new_password" required="required" class="form-control form-add-on" placeholder="&#xf023;"><br> 
                Retype New Password
                <br>
                <input type="password" name="retype_password" required="required" class="form-control form-add-on" placeholder="&#xf023;"><br>

                <input type="submit" class="form-add-on submit" name="submit" value="Submit &#xf2c6;">


            </form>
            <?php echo $alertmessage; ?>

        </div>
<?php }else {?>
	    	<div class="col-lg-4 col-lg-offset-4">
   		       	<h2>Invalid or Broken Token</h2>
	            <p>Opps! The link you have come with is maybe broken or already used. Please make sure that you copied the link correctly or request another token from <a href="index.php">here</a>.</p>
			</div>
        <?php }?>





    </div>
    <script>
        $.validate({
            modules: 'html5'
        });
    </script>
    <?php include("endpage.php"); ?>
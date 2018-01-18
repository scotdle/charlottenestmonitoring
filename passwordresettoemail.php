<?php
session_start();

include("styles.php");
include("credentialslocal.php");
include("scripts/resetemailfunction.php");



 $alertmessage = "<a href=\"login.php\">I remembered my password!</a>";
        
    if(isset($_POST['submit'])){
        
    $email = $_POST['email'];
    $username = $_POST['username'];
        
  
 $checkEmail = emailValidation($mysqli, $email);
        
    
    if($checkEmail == "true"){
        
    $token = generateRandomString(); 
     $alertmessage = "it worked";

     echo $token;
     echo $alertmessage;
        
    $insertToken= mysqli_query($mysqli, "INSERT INTO recovery_keys (email, username, token) VALUES ('$email' , '$username' ,'$token') ");
       
    $sendEmail = sendEmail($token, $username, $email);

    if ($sendEmail == "success") {
        
    $alertmessage = "a password reset email has been sent to " . $email . " please check your spam folder!";    
     
        
        echo $to;
        
    }  
        
if($sendEmail == "fail") {
    
$alertmessage = "message not sent";    
     
}
        
        
    }  else{
	    $alertmessage = "it didn't work!";
	    echo $alertmessage;
    }


    }
 
        
    
        
        
 
        ?>


    <div class="registerpage col-lg-12">
        <h2>Password Reset</h2>

        <div class="registerpageform">
            <form method="post">


                Email<br>
                <input type="text" name="email" required="required" class="form-control form-add-on" placeholder="&#xf003; "><br> Username
                <br>
                <input type="text" name="username" required="required" class="form-control form-add-on" placeholder="&#xf2be;"><br>

                <input type="submit" class="form-add-on submit" name="submit" value="Submit &#xf2c6;">


            </form>
            <?php echo $alertmessage; ?>

        </div>






    </div>
    <script>
        $.validate({
            modules: 'html5'
        });
    </script>
    <?php include("endpage.php"); ?>
<?php
session_start();
ini_set('display_errors',1);
error_reporting(-1);
include("styles.php");
include("credentialslocal.php");
$username =  $_SESSION['username'];

 $result = mysqli_query($mysqli, "SELECT * FROM users WHERE username='$username'");
      while ($row=mysqli_fetch_assoc($result))

      {   
    $id = $row['id'];      
    $name= $row['name'];      
      $username =$row['username'];
    $password =$row['password'];
    $favoritebird =$row['favoritebird'];
    $currentprofilepic = $row['profilepic'];      
         
          
      }

?>
    <?php 

if(isset($_POST['submit'])) {
        $name = $_POST['name'];
       $username = $_POST['username'];
        $favoritebird = $_POST['favoritebird'];
   
		
		
    $name = preg_replace('/\s+/','', $name);



 mysqli_query($mysqli, "UPDATE users SET name= '$name', username= '$username', favoritebird= '$favoritebird' WHERE id=$id");
    
}

if(isset($_POST['editprofilepic'])) {
    
     move_uploaded_file($_FILES['profilepic']['tmp_name'],
    "images/profilepics/" . $_FILES['profilepic']['name']);
        $profilePic=$_FILES['profilepic']['name'];
    
    mysqli_query($mysqli, "UPDATE users SET profilepic = '$profilePic' WHERE id=$id");
    
    
}



if(isset($_POST['editpassword'])) {
    
    $password = $_POST['password'];
		$storePassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
    
     mysqli_query($mysqli, "UPDATE users SET password= '$storePassword' WHERE id=$id");
    
}
 
?>
    <div class="container-fluid">
<div class="row">
    <div class="registerpage col-lg-12">
        <h2>Edit Profile</h2>

        <div class="registerpageform">
            <form method="post" action="" >


                Name<br>
                <input type="text" name="name" required="required" class="form-control form-add-on" value="<?php echo $name; ?> "><br> Username
                <br>
                <input type="text" name="username" required="required" class="form-control form-add-on" value="<?php echo $username; ?>">
                <br>
                    Favorite Bird<br>
                <input type="text" name="favoritebird" required="required" class="form-control form-add-on" value="<?php echo $favoritebird; ?>"><br> 
               

                <input type="submit" name="submit" class="form-add-on submit" value="Submit &#xf2c6;"><br>

            </form>
        </div>
        
        <br>
<div class="editprofilepictureform">
      <div class="col-lg-6 ">   

        <form method="post" enctype="multipart/form-data">
            
        <h2>Edit Profile Picture</h2>  
     <input type="file" name="profilepic" class="img-responsive" >        
            
         <input type="submit" name="editprofilepic" class="form-add-on submit" value="Change Profile Picture &#xf2be;"><br>
   
    </form> 
            </div>      
        
        
        <div class="col-lg-6 ">   

        <form method="post">
            
        <h2>Edit Password</h2>         
            
        <input type="password" name="password" required="required" class="form-control form-add-on" ><br>
       <input type="submit" name="editpassword" class="form-add-on submit" value="Change Password &#xf023;"><br>     
            
    </form> 
            </div>      
          <a href="maintable.php">back to the main table</a>   
        </div>
      
    </div>
    </div>
        
</div>

    <script>
        $.validate({
            modules: 'html5'
        });
    </script>
    <?php include("endpage.php"); ?>
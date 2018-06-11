<?php
session_start();
ini_set( 'display_errors', 1 );
error_reporting( - 1 );
include( "styles.php" );
include( "credentialslocal.php" );


$registertext = "<button><a href=\"login.php\">I don't want to register</a></button>";
$error        = "";


if ( isset( $_POST['submit'] ) ) {
	$name          = $_POST['name'];
	$email         = $_POST['email'];
	$username      = $_POST['username'];
	$password      = $_POST['password'];
	$storePassword = password_hash( $password, PASSWORD_BCRYPT, array( 'cost' => 10 ) );
	$favoritebird  = $_POST['favoritebird'];
	move_uploaded_file( $_FILES['profilepic']['tmp_name'],
		"images/profilepics/" . $_FILES['profilepic']['name'] );
	$profilePic = $_FILES['profilepic']['name'];


	mysqli_query( $mysqli, "INSERT INTO users (name, email, username, password, favoritebird, profilepic) VALUES('$name', '$email','$username','$storePassword', '$favoritebird', '$profilePic')" )
	or die( $error = "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'registrationerror.php';

}, 000); </script>" );


	$registertext = "<h1>Welcome " . $name . "! Flying you to your HomePage!</h1>" . "<br/>";

	$_SESSION['name']     = $name;
	$_SESSION['username'] = $username;

	echo "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php';

}, 3000); </script>";
}

?>


    <div class="registerpage  col-lg-12">
    <div class="registerpageform">
        <h2 class="boldheader">Howdy! <br> go ahead and fill out the form below and you'll be tracking nests in no time!</h2>
		<?php 		echo $registertext;

		echo $error;
		?>
        <form method="post" action="" enctype="multipart/form-data">


            Name<br>
            <input type="text" name="name" required="required" class="form-control form-add-on"
                   placeholder="&#xf031; "><br>
            Email<br>
            <input type="text" name="email" required="required" class="form-control form-add-on"
                   placeholder="&#xf003; "><br>
            Username
            <br>
            <input type="text" name="username" required="required" class="form-control form-add-on"
                   placeholder="&#xf2be;"><br>
            Password
            <br>
            <input type="password" name="password" required="required" class="form-control form-add-on"
                   placeholder="&#xf023;"><br>

            <div class="row">

                <div class="col-lg-6">
                    <h2 class="boldheader">Favorite Bird</h2><br>
                    <input type="text" name="favoritebird" required="required" class="form-control form-add-on"
                           placeholder="&#xf004;"><br>
                </div>

                <div class="col-lg-6">

                    <h2 class="boldheader">Profile Picture</h2><br><br>
                    <input type="file" name="profilepic" class="img-responsive" id="profilePicUpload" accept="image/gif, image/jpeg, image/png"><br>
                    <img src="" class="rounded-circle submittedbypicture" id="output_image"/>

                </div>
            </div>
            <button><input type="submit" name="submit" class="submit" value="Submit &#xf2c6;"></button>

        </form>
    </div>



<?php include( "endpage.php" ); ?>
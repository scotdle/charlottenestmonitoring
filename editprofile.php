<?php
session_start();
ini_set( 'display_errors', 1 );
error_reporting( - 1 );
include( "styles.php" );
include( "credentialslocal.php" );
$username            = $_SESSION['username'];
$editProfileSuccess  = '';
$editPasswordSuccess = '';


$result = mysqli_query( $mysqli, "SELECT * FROM users WHERE username='$username'" );
while ( $row = mysqli_fetch_assoc( $result ) ) {
	$id                = $row['id'];
	$name              = $row['name'];
	$username          = $row['username'];
	$password          = $row['password'];
	$favoritebird      = $row['favoritebird'];
	$currentprofilepic = $row['profilepic'];


}


if ( isset( $_POST['submit'] ) ) {
	$name         = $_POST['name'];
	$username     = $_POST['username'];
	$favoritebird = $_POST['favoritebird'];

	$editProfileSuccess = 'Profile Edited!';

	$name = preg_replace( '/\s+/', '', $name );


	mysqli_query( $mysqli, "UPDATE users SET name= '$name', username= '$username', favoritebird= '$favoritebird' WHERE id=$id" );

	$_SESSION['username'] = $username;
}

if ( isset( $_POST['editprofilepic'] ) ) {

	$oldprofilepic = 'images/profilepics/' . $currentprofilepic;
	unlink( $oldprofilepic ); //deleting old profile pic

	move_uploaded_file( $_FILES['profilepic']['tmp_name'],
		"images/profilepics/" . $_FILES['profilepic']['name'] );
	$profilePic = $_FILES['profilepic']['name'];

	mysqli_query( $mysqli, "UPDATE users SET profilepic = '$profilePic' WHERE id=$id" );

	$editPictureSuccess = 'picture successfully changed!';
	$result = mysqli_query( $mysqli, "SELECT * FROM users WHERE username='$username'" );
	while ( $row = mysqli_fetch_assoc( $result ) ) {
		$currentprofilepic = $row['profilepic'];


	}

}


if ( isset( $_POST['editpassword'] ) ) {

	$password      = $_POST['password'];
	$storePassword = password_hash( $password, PASSWORD_BCRYPT, array( 'cost' => 10 ) );

	mysqli_query( $mysqli, "UPDATE users SET password= '$storePassword' WHERE id=$id" );

	$editPasswordSuccess = 'password successfully changed!';

}

?>
    <div class="container-fluid">
        <div class="row">
            <div class="registerpage col-lg-12">
                <h2 class="loginheader">Edit Profile</h2>

                <div class="registerpageform">
                    <form method="post" action="">


                        Name<br>
                        <input type="text" name="name" required="required" class="form-control form-add-on"
                               value="<?php echo $name; ?> "><br> Username
                        <br>
                        <input type="text" name="username" required="required" class="form-control form-add-on"
                               value="<?php echo $username; ?>">
                        <br>
                        Favorite Bird<br>
                        <input type="text" name="favoritebird" required="required" class="form-control form-add-on"
                               value="<?php echo $favoritebird; ?>"><br>


                        <button><input type="submit" name="submit" class="submit" value="Submit &#xf2c6;"><br></button>
						<?php echo $editProfileSuccess; ?>

                    </form>
                </div>


            <br>
                <div class="editprofilepictureform">
                    <div class="row">
                    <div class="col-lg-6">

                        <form method="post" enctype="multipart/form-data">

                            <h2 class="loginheader">Edit Profile Picture</h2>

                            <input type="file" name="profilepic" class="img-responsive">
							<?php echo "<img src='images/profilepics/" . $currentprofilepic . "'" . " class= 'img-circle profilepic' > " ?>

                            <button><input type="submit" name="editprofilepic" class="submit" value="Change Profile Picture &#xf2be;"></button>

                        </form>
                    </div>


                    <div class="col-lg-6">

                        <form method="post">

                            <h2 class="loginheader">Edit Password</h2>

                            <input type="password" name="password" required="required" class="form-control form-add-on"><br>
                            <button><input type="submit" name="editpassword" class="submit" value="Change Password &#xf023;"></button><br>
							<?php echo $editPasswordSuccess; ?>
                        </form>
                    </div>
                </div>
                    <a href="maintable.php">back to the main table</a>

                </div>
        </div>
    </div>
    </div>


<?php include( "endpage.php" ); ?>
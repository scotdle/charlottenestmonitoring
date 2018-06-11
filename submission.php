<?php
session_start();
require("credentialslocal.php");
 include("styles.php");



$username = $_SESSION['username'];
$profilepicimage = $_SESSION['profilepic'];
$profilepicfile = $_SESSION['profilepicfile'];
$eggornestling = $_POST['eggornestling'];
$howmany = $_POST['howmany'];
$location = $_POST['location'];
$description = $_POST['description'];
$possiblespecies = $_POST['possiblespecies'];



$location = mysqli_real_escape_string($mysqli, $location);
$description = mysqli_real_escape_string($mysqli,$description);
$possiblespecies = mysqli_real_escape_string($mysqli, $possiblespecies);
$id = $_POST["id"];
if(isset($_POST['submit'])) {  
    
if(isset($_POST['eggornestling'])) {
	$getuserid ="SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($mysqli, $getuserid);

	$submittinguser = mysqli_fetch_array($result);
$currentuserid= $submittinguser['id'];


	$sql= "INSERT INTO nesttable (userid,  datesubmitted,  eggsornestlings, howmany, location, description, possiblespecies)
VALUES
('$currentuserid' ,  CURDATE() , '$eggornestling' , '$howmany' , '$location' , '$description' , '$possiblespecies')";
    
if (!mysqli_query($mysqli, $sql))
  {
  die('Error: ' . mysqli_error($mysqli));
  }      
    
  echo "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'add.php';

}, ); </script>"; 
}
  


 




    
}

echo $submissiontext;

?>



    <div class="addpage col-lg-12">
        <h1>Add A Nest</h1>
        <form method="post" class="editpageform">
            Submitted By:<br>
            <?php echo $profilepicimage; ?>
            Egg or Nestling?<br>
            <input type="radio" value="egg"checked name="eggornestling" class="required"> Egg
            <input type="radio" value="nestling" name="eggornestling"> Nestling<br><br>
             How Many<br>
            <input type="number" name="howmany" required="required" class="form-control form-add-on">
            <br> Location of Nest<br>
            <input type="text" name="location" required="required" class="form-control form-add-on" data-suggestions="Forest, Field, Tree, Building, Nestbox, Cavity, Lake, Pond, Ocean" placeholder="add a location or even coordinates!">
            <br> Description of Nest<br>
            <textarea name= "description" cols="40" rows="5" class="form-control form-add-on " placeholder="the more discriptive the better! what color were the eggs? how big was the nest? What about nesting materials? " required="required"><?php echo $description; ?></textarea>
            <br>Possible Species?<br>
            <input type="text" class=" form-control form-add-on " name="possiblespecies" value="Not sure yet..."> <br>
           

            <input type="submit" class="form-add-on submit" name="submit" value="Submit &#xf2c6;">
        </form>
    </div>
    <script>
        $.validate({
            modules: 'html5'
         });
        
        
    </script>
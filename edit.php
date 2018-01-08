<?php 
session_start();
// including the database connection file
include('styles.php');
include('credentialslocal.php'); 
    
    $nestid = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM nesttable WHERE nestid=$nestid");
      while ($row=mysqli_fetch_assoc($result))

      {   
    $userwhosubmitted = $row['userwhosubmitted'];      
    $eggsornestlings= $row['eggsornestlings'];      
      $howmany =$row['howmany'];
    $location =$row['location'];
    $description =$row['description'];
     $possiblespecies =$row['possiblespecies'];      
          
      }
       
//getting id from url
 /*if($userwhosubmitted !== $_SESSION['username'])

{
    
    
$errortext=  "<h1 class= 'editpageerror'> Only " . $userwhosubmitted . " can edit this record. </h1><br/><br/>" .
  
    
    "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php#nesttable';

}, 4000); </script>";    
    
  echo $errortext;
    die();
    
}
    */
if($_SERVER['REQUEST_METHOD']=='POST') {
    
    $nestid = $_GET['id'];

 $eggornestling = $_POST['eggornestling'];
$howmany = $_POST['howmany'];
$location = $_POST['location'];
$description = $_POST['description'];
$possiblespecies = $_POST['possiblespecies'];   
    
 
    $location = mysqli_real_escape_string($mysqli, $location);
$description = mysqli_real_escape_string($mysqli,$description);
$possiblespecies = mysqli_real_escape_string($mysqli, $possiblespecies);


 mysqli_query($mysqli, "UPDATE nesttable SET eggsornestlings= '$eggornestling', lastedited = CURDATE() ,  howmany= '$howmany', location= '$location', description= '$description', possiblespecies= '$possiblespecies' WHERE nestid=$nestid");
 
$updated = '<a href="maintable.php#nesttable"> Done Editing? Head back to the Nest Table</a>';  
    
}
?>

<div class="editpage col-lg-12">
    <form method="post" class="editpageform">
        Edit Egg or Nestling<br>
        <input type="radio" value="egg" name="eggornestling" <?php echo ($eggsornestlings=='egg' )? ' checked': '' ?>> Egg
        <input type="radio" value="nestling" name="eggornestling" <?php echo ($eggsornestlings=='nestling' )? ' checked': '' ?>> Nestling<br><br> Edit How Many<br>
        <input type="number" name="howmany" required="required" class="form-control form-add-on" value="<?php echo $howmany; ?>"><br> Edit Location of Nest<br>
        <input type="text" name="location" required="required" class="form-control form-add-on" data-suggestions="Forest, Field, Tree, Building, Nestbox, Cavity, Lake, Pond, Ocean" value="<?php echo $location; ?>"><br> Edit Description<br>
        <textarea name=description cols="40" rows="5" class="form-control form-add-on description" required="required"><?php echo $description; ?></textarea><br> Possible Species?<br>
        <input type="text" class=" form-control form-add-on " name="possiblespecies" value="<?php echo $possiblespecies; ?>"> <br>

        <input type="submit" class="form-add-on submit" name="submit" value="Submit &#xf2c6;">
        <?php echo $updated; ?>
    </form>

   
</div>
<?php include('endpage.php'); ?>
<?php 
session_start();
include('styles.php');
include('credentialslocal.php');
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
 $deletemessage = "Are you sure you want to delete this record?";

if(isset($_POST['yes'])) {
    
$selectfromnesttable ="SELECT * FROM nesttable WHERE id=$id";  
    
$records = mysqli_query($mysqli, $selectfromnesttable);
    
while($nest=mysqli_fetch_assoc($records)) {
    
 $userwhosubmitted =$nest['userwhosubmitted'];

}
    
if($userwhosubmitted == $_SESSION["username"]) {
    
 mysqli_query($mysqli, "DELETE FROM nesttable WHERE id=$id");
    
    $deletemessage= "ok, record deleted, <br><br> sending you back to the main page";
    
   echo  "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php#nesttable';

}, 2000); </script>";
}   
    
    
    
    
    


else {
    
    
  $deletemessage= "Only " . $userwhosubmitted . " can delete this record! <br><br> returning you to the main table";   
    
     echo  "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php#nesttable';

}, 2000); </script>";
    
}
    
    
    
    
}



if(isset($_POST['no'])) 
{
   echo  "<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = 'maintable.php#nesttable';

}, 2000); </script>";
                          
        }


?>
<div class="deleterecord col-lg-12 ">

    <div class="">
 <br>
        <h1><?php echo $deletemessage; ?></h1>
        

        <form method="post">
            <input type="submit" class="submit form-add-on" value="Yes &#xf014;" name="yes">
            <input type="submit" class="submit form-add-on" value="No &#xf2d4;" name="no">
        </form>



  

       
    </div>
</div>
<?php include('endpage.php'); ?>
<?php
session_start();
include('styles.php');
include('credentialslocal.php');

        //escapes special characters in a string

$username = $_SESSION['username'];
$username = mysqli_real_escape_string($mysqli,$username);
$result = mysqli_query($mysqli, "SELECT TRIM(id) AS id, TRIM(name) AS name, TRIM(favoritebird) as favoritebird, TRIM(profilepic) as profilepic FROM users WHERE username= '$username'");
while ($row=mysqli_fetch_assoc($result)) {
$id = $row['id'];
$name= $row['name'];
$favoritebird= $row['favoritebird'];
$profilepicfile = $row['profilepic'];
    }


if (empty($profilepicfile))
{
    
$profilepic = "<img src='images/profilepics/defaultprofilepic.png' class= 'rounded-circle profilepic' > <br>";
$_SESSION['profilepic'] = $profilepic;     
    
}else{


$profilepic = "<img src='images/profilepics/". $profilepicfile ."'" . "class= 'rounded-circle profilepic' > <br>";
  $_SESSION['profilepic'] = $profilepic;
$_SESSION['profilepicfile'] = $profilepicfile;



}



$d1=strtotime("September 16");
$d2=ceil(($d1-time())/60/60/24);
$nestingseasonends = "There are " . $d2 ." days until the end of nesting season!";

$hometext = "Hi " . $name . "!" . "<br> favorite bird: " . $favoritebird . "<br>";    


$allrecords= "SELECT * FROM nesttable";
$result = mysqli_query($mysqli, $allrecords);
$num_nests = mysqli_num_rows($result);

$nestsindatabase="<div class='databasefacttext'>" .$num_nests . " total nests in the database </div>";
                           
$eggquery = "SELECT COUNT(*) AS eggsornestlings FROM nesttable WHERE eggsornestlings = 'egg'";

$result = mysqli_query($mysqli, $eggquery); // Result resource

$row = mysqli_fetch_array($result); // Use something like this to get the result
$eggsindatabase= "<div class='databasefacttext'>". $row['eggsornestlings'] . " nests with eggs <br></div> ";



$nestlingquery = "SELECT COUNT(*) AS eggsornestlings FROM nesttable WHERE eggsornestlings = 'nestling'";

$result = mysqli_query($mysqli, $nestlingquery); 

$row = mysqli_fetch_array($result); 
$nestlingsindatabase=  $row['eggsornestlings']. " nests with nestlings";






?>







    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">


<nav class="navbar navbar-expand-lg navbar-light fixed-bottom">
    <img src="images/logosecondary.png" alt="logo" class="navbar-brand">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
            <a href="#section1" class="smoothscroll nav-link">Home</a>

            </li>

            <li class="nav-item">
                <a href="#section2" class="smoothscroll nav-link">View the Nest Table!</a>

            </li>
            <?php if(isset($id)) {
           echo ' <li class="nav-item">
                <a href="submission.php" class="nav-link"> Submit a Nest! </a>
            </li> ' ;} ?>
	        <?php if(isset($id)) {
		        echo ' 
                     <li class="nav-item">
                <a class="nav-link useractions" href="editprofile.php">Edit Profile</a>
            </li>
                 <li class="nav-item">
                <a class="nav-link useractions" href="logout.php" > Log out </a>
            </li> ' ;} ?>


        </ul>
        <span class="navbar-text">
      Navbar text with an inline element
    </span>
    </div>
</nav>


            </div>
        </div>
    </div>

	              <div class="row mainpagesection1 no-gutter" id = "section1" >
		              <?php if(isset($id)) {
                  echo  '<div class="col-md-6 " >';



                        echo $profilepic .
                         $hometext . '</div>';

                        }else{

			              echo  '<div class="col-md-6" >'
                                . $profilepic . $id .
                                '<h1>Hey stranger! <br> Register today! </h1>' .
                                '</div>';
		              }
                        ?>



                    <div class="col-md-6 databasefacts">
                        <?php

                    
                    
                    echo $nestsindatabase;
                    
                    echo $eggsindatabase;
                    
                    echo $nestlingsindatabase;
                    
        
?>


                    </div>
                </div>

                <div class="row mainpagesection1 no-gutter">
                    <div class="col-md-12 nestingseason">

                        <?php  echo $nestingseasonends  ?>

                    </div>

                <input type="text" id="searchTable" placeholder="Search Through the CNM Database!" >
                </div>




                <div class="row mainpagesection2 no-gutter" id="section2">
                    <div class="col-md-12">


<br>
                            <?php 

    
    $selectfromnesttable= "SELECT * FROM nesttable 
INNER JOIN users ON nesttable.userid = users.id ";
     

$records= mysqli_query($mysqli, $selectfromnesttable);

while ( $nest = mysqli_fetch_assoc( $records ) ) {

		                            echo '<div class = "tablesection">';
		                            echo '<table id= "nestTable" class="responsive-stacked-table with-mobile-labels tablesectionstyling ">
                           <tr>
                                <th>Submitted By</th>
                                <th>Date Submitted</th>
                                <th>Egg or Nestling?</th>
                                <th>How Many?</th>
                                <th>Location</th>
                                <th>Description of Nest</th>
                                <th>Possible Species?</th>';

		                            if($_SESSION['id']===$nest['id'])  {

		                            echo '<th>Edit || Delete </th>';

		                            }

		                            echo "</tr>";
		                            echo "<tr>";
		                            echo "<td data-label='Submitted By:' >" . "<img src='images/profilepics/" . $nest['profilepic'] . "'" . "class= 'rounded-circle submittedbypicture' > <br>" . $nest['username'] . "</td>";
		                            echo "<td  data-label='Date Submitted:' >" . $nest['datesubmitted'] . "<br> Last Edited: <br> " . $nest['lastedited'] . "</td>";
		                            echo "<td data-label='Egg or Nestling:' >" . $nest['eggsornestlings'] . "</td>";
		                            echo "<td  data-label='How Many:'>" . $nest['howmany'] . "</td>";
		                            echo "<td  data-label='Location:'>" . $nest['location'] . "</td>";
		                            echo "<td  data-label='Description:'>" . $nest['description'] . "</td>";
		                            echo "<td  data-label='Possible Species:'>" . $nest['possiblespecies'] . "</td>";
                            if($id===$nest['id']) {

	                            echo "<td><a href=\"edit.php?id=$nest[nestid]\">Edit</a> // <a href=\"delete.php?id=$nest[nestid]\">Delete</a></td>";
                            }
		                            echo "</tr>";
		                            echo "</table>";
		                            echo "</div>";
	                            }


    
?>
                   









                    </div>
                </div>


<script type="text/javascript">
var $rows = $('.tablesection ');
$('#searchTable').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

</script>
    <?php include('endpage.php'); ?>



 
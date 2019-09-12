<?php
  session_start();
	$connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  if (isset ($_POST['UpdateProfile'])){
  	$Full_Name = $_POST['Full_Name'];
  	$Username = $_POST['Username'];
  	$StaffID = $_POST['StaffID'];
  	$Email = $_POST['Email'];
  	$Mobile = $_POST['Mobile'];
  	$Gender =$_POST['Gender'];
    $user=$_SESSION['username'];


  	$sql="UPDATE users SET StaffID = '$StaffID' , Username= '$Username' , Email ='$Email', StaffName= '$Full_Name', MobileNum= '$Mobile', Gender= '$Gender' WHERE username='$user' AND roles='Admin'";
  	$result= mysqli_query ($connection, $sql) or die ("Could not execute query");

    if ($result)
  	{
      echo "success";
    }

    else {
      echo "Profile not update Try again";
    }
  }
  ?>

<?php
  $connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $CurrentYear = date("Y");
  if (isset($_POST['New']))
  {
    $StaffName = $_POST['Full_Name'];
    $username = strtoupper($_POST['Username']);
    $StaffID = strtoupper($_POST['StaffID']);
    $Gender = $_POST['Gender'];
    $TOS = $_POST['TOS'];
    $Position = $_POST['Position'];
    $Mobile = $_POST['Mobile'];
    $department = $_POST['department'];
    $Email   = $_POST['Email'];
    $Password1= $_POST['Password1'];
    $Password2= $_POST['Password2'];
    $ML= $_POST['ML'];
    $AL= $_POST['AL'];
    $RL= $_POST['RL'];

    $sql = "SELECT UPPER(username) FROM USERS WHERE Username = '$username'";
    $result = mysqli_query($connection,$sql) or die ("Couldn`t execute query");
    $myrow = mysqli_fetch_row($result);

    if($myrow[0]==$username){
        echo "Username already exist\n";
    }
    $sql1 = "SELECT UPPER(StaffID) FROM USERS WHERE StaffID = '$StaffID'";
    $result1 = mysqli_query($connection,$sql1) or die ("Couldn`t execute query");
    $myrow = mysqli_fetch_row($result1);
    if ($myrow[0]==$StaffID){
      echo "\nStaffID already exist, it must be unique to a staff only";
    }
    else{
      if ($Password1==$Password2)
      {
        $options = [
        'cost' => 12,
    		];
    		$hashed_password = password_hash($Password2, PASSWORD_BCRYPT, $options);

        $sql="INSERT INTO users (StaffName, username, StaffID, Password, Gender, Roles, MobileNum, department, Email, CL, CLbalance, Annual, Annualbalance, OL, OLbalance, TOS) VALUES
        ('$StaffName', '$username', '$StaffID', '$hashed_password', '$Gender','$Position', '$Mobile' ,'$department',
        '$Email','$ML', '$ML', '$AL', '$AL', '$RL', '$RL', '$TOS')";
        $result=mysqli_query($connection, $sql) or die ("Couldn't execute query");

        if ($result)
        {
          echo "success";
        }
        else{
          echo "There was something wrong while inserting your data, Try again";
        }
      }
      else {
        echo "Password Fields do not match";
      }
    }
  }
?>

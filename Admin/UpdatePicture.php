<?php
  session_start();
	$connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  if (isset ($_POST['updateimage'])){
    $user=$_SESSION['username'];
    $errors= array();
    $file_name = $_FILES['profimage']['name'];
    $file_size =$_FILES['profimage']['size'];
    $file_tmp =$_FILES['profimage']['tmp_name'];
    $file_type=$_FILES['profimage']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = strtolower(end($tmp));
    $expensions= array("jpeg","jpg","png");

    if((in_array($file_ext,$expensions)=== false)&&(empty($file_name)==false)){
       $errors[]="extension not allowed, please choose pictures in jpg, png or jpeg only.";
    }

    if($file_size > 5097152){
       $errors[]='File size must be less than 5 MB';
    }

    if(empty($errors)==true){
       move_uploaded_file($file_tmp,"ProfilePictures/".$file_name);

    } else{
       print_r($errors);
    }

  	$sql="UPDATE users SET  Profileimg ='$file_name' WHERE username='$user' AND roles='Admin'";
  	$result= mysqli_query ($connection, $sql) or die ("Could not execute query");

    if ($result)
  	{
      echo "success";
    }

    else {
      echo "Profile not updated Try again";
    }
  }
  ?>

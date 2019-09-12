<?php
  session_start();
  $connection=mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
    $user=$_SESSION['username'];
    $lid=intval($_GET['leaveid']);


      if (isset ($_POST['UpdateDetail'])){
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $ActionDate= date('d-m-Y G:i:sa ');
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $sql="UPDATE request SET request.Status ='$status', request.Remark='$remark', request.ActionDate='$ActionDate' WHERE request.Id=$lid";
        $result= mysqli_query ($connection, $sql) or die ("Could'nt execute query");
          if ($result)
            {
              $sql= "SELECT * FROM users WHERE username='$user' AND roles='Superior'";
              $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
              $myrow= mysqli_fetch_row ($result);
              if ($result){
                $sql1= "SELECT * FROM users WHERE department='HUMAN RESOURCE DEPARTMENT' AND roles='HR'";
                $result1= mysqli_query ($connection, $sql1) or die ("Could not execute query");
                $myrow= mysqli_fetch_row ($result1);
                include 'email.php';
              }
            }

            else {
              echo "An Error occurred, Leave not processed";
            }
          }
  ?>

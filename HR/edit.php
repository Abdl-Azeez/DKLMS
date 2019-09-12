<?php
  include("session.php");
?>

  <title>L_M_S |User Update</title>
  <link type="text/css" rel="stylesheet" href="/DK/css/details.css">
  <?php
    include"display.php";
  ?>
  <style>
    #Full_Name{
      padding: 20px 10px 10px 50px;
    }
    #Username{
      padding: 20px 10px 10px 80px;
    }
    #StaffID{
      padding: 20px 10px 10px 80px;
    }
    #TOS{
      padding: 20px 10px 10px 300px;
    }
    #Mobile{
      padding: 20px 10px 10px 80px;
    }
    #Position{
      padding: 20px 10px 10px 135px;
    }
    #Email{
      padding: 20px 10px 10px 80px;
    }
    #department{
      padding: 20px 10px 10px 230px;
    }
    @media screen and (max-width: 1060px) {
      .form-group input, .form-group section, .form-group select {
        font-size: 14px;
      }
      #Full_Name{
        padding: 20px 10px 10px 63px;
      }
      #Username{
        padding: 20px 10px 10px 60px;
      }
      #StaffID{
        padding: 20px 10px 10px 60px;
      }
      #Gender{
        padding: 20px 10px 10px 130px;
      }
      #TOS{
        padding: 20px 10px 10px 240px;
      }
      #Mobile{
        padding: 20px 10px 10px 80px;
      }
      #Position{
        padding: 20px 10px 10px 110px;
      }
      #Email{
        padding: 20px 10px 10px 80px;
      }
      #department{
        padding: 20px 10px 10px 190px;
      }
      #Password1::placeholder{
        display: none;

      }
    }
    @media screen and (max-width: 992px) {
      ::placeholder {
        font-size: 12px;
      }
      .form-group input,
      .form-group section,
      .form-group select {
        padding: 20px 0px 10px 119px;
        font-size: 12px;
      }
      #Password2{
        padding: 20px 0px 10px 160px;
      }
      input[type="submit"]{
        padding: 10px 24px;
      }
    }
    @media screen and (max-width: 768px) {
      input[type="submit"],input[type="submit"]:hover{
        margin: 20px auto;
        padding: 11px 20px;
        font-size: 13px;
      }
      #Username{
        padding: 20px 10px 10px 80px;
      }
      #StaffID{
        padding: 20px 10px 10px 80px;
      }
      #Gender{
        padding: 20px 10px 10px 195px;
      }
      #TOS{
        padding: 20px 10px 10px 200px;
      }
      #Mobile{
        padding: 20px 10px 10px 80px;
      }
      #Position{
        padding: 20px 10px 10px 183px;
      }
      #Email{
        padding: 20px 10px 10px 80px;
      }
      #department{
        padding: 20px 10px 10px 186px;
      }
    }
    @media screen and (max-width: 640px) {
      #Gender {
        padding: 20px 10px 10px 154px;
      }
      #TOS {
        padding: 20px 10px 10px 163px;
      }
      #Position {
        padding: 20px 10px 10px 120px;
      }
      #department {
        padding: 20px 10px 10px 127px;
      }
    }
    @media screen and (max-width: 480px) {
      .form-group input, .form-group section, .form-group select {
        padding: 20px 0px 10px 60px;
      }
      #Username {
        padding: 20px 10px 10px 45px;
      }
      #StaffID {
        padding: 20px 10px 10px 45px;
      }
      #Gender {
        padding: 20px 10px 10px 100px;
      }
      #TOS {
        padding: 20px 10px 10px 130px;
      }
      #Mobile {
        padding: 20px 10px 10px 65px;
      }
      #Position {
        padding: 20px 10px 10px 85px;
      }
      #Email {
        padding: 20px 10px 10px 52px;
      }
      #department {
        padding: 20px 10px 10px 100px;
        font-size: 10px;
      }
      #Password1{
        padding: 20px 0px 10px 110px;
      }
      #Password2 {
        padding: 20px 0px 10px 125px;
      }
    }
  </style>
</head>
<body>
  <div id="load"></div>
  <main>
    <navigation  class="fixed-top navbar navbar-expand-lg navbar-dark nav-style">
      <div class='logo' style="width: 32%;">
        <div class='logoImage'>
          <a href='\DK\index.php'>
            <img src='\DK\images\DKlogo.png' alt='logo'>
            <label>LEAVE MANAGEMENT<br> SYSTEM</label>
          </a>
        </div>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="ul-class nav navbar-nav borderEffect">
         <li class="nav-item"><a href="\DK\HR\Records.php" class="ml-2" style="padding-left:8px;">Requests</a></li>
         <li class="nav-item"><a href="\DK\HR\AllRecords.php">Records</a></li>
         <li class='nav-item'><a href='\DK\HR\Users.php'>Users</a></li>
         <li class="nav-item"><a href="\DK\HR\Profile.php">Profile</a></li>
         <li class="nav-item" style="display:none;"><a href="\DK\Login.php">Logout</a></li>
        </ul>
      </div>
      <div class="userProfileImage">
        <img src="<?php if ($myrow[22]==""){echo "\DK\images\userPlaceholder.png";}else{echo"\DK\HR\ProfilePictures\\$myrow[22]";};?>"/>
        <section style="display: inline-flex;justify-content: space-around;">
          <a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button">
            <i class="material-icons">notifications_none</i>
            <?php
            $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
            $user=$_SESSION['username'];
            $sql = "SELECT COUNT(*) AS 'count' FROM request WHERE request.status=2";
            $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
            $row = mysqli_fetch_assoc($result);
            $count = $row['count'];
            ?>
            <span class="badge"><?php echo $count;?></span>
          </a>
          <ul id="dropdown1" class="dropdown-content" style="width: 46px; position: absolute;top: 0px;left: 1034.75px;opacity: 1; display: none;">
            <li class="notificatoins-dropdown-container">
              <ul>
                <li class="notification-drop-title">Notifications</li>
                <?php
                $user=$_SESSION['username'];
                $sql2 = "SELECT request.Id AS lid, request.StaffName, request.StaffID, request.leaveType, request.DateFrom, request.DateTo, request.Attachment, request.PostingDate, request.status FROM request
                WHERE request.status=2 ORDER BY request.ActionDate desc";
                $result2= mysqli_query ($connection, $sql2) or die ("Could not execute query");

                if ($result2->num_rows > 0)
                  {
                     while($myrow = $result2->fetch_assoc()){
                    ?>
                <li>
                  <a href="details.php?leaveid=<?php echo $myrow["lid"];?>" name="checked" id="checked">
                    <div class="notification">
                      <div class="notification-icon"><i class="material-icons">done</i>
                      </div>
                      <div class="notification-text"><p>Superior approved <br><b style="text-transform:uppercase;"><?php echo $myrow["StaffName"];?><br/></b>
                        <?php echo $myrow ["StaffID"]?> <br><b><?php if ($myrow["leaveType"]==1)
                              {
                                echo "Annual Leave";
                              }
                              else if ($myrow["leaveType"]==2)
                              {
                                echo "Emergency Leave";
                              }
                              else if ($myrow["leaveType"]==3)
                              {
                                echo "Medical Leave";
                              }
                              else if ($myrow["leaveType"]==4)
                              {
                                echo "Replacement Leave";
                              }
                              else{
                                echo $myrow["leaveType"];
                              };?></b><br> applied on <?php echo $myrow["PostingDate"];?></p>
                      </div>
                    </div>
                  <?php }}?>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
          <a class="logout" href='\DK\Logout.php'>Logout</a>
        </section>
      </div>
    </navigation>
    <div class='content'>
      <span>Update Details</span>
      <div class="profileSection">
        <?php
          $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
          $user=$_SESSION['username'];
          $lid=intval($_GET['empid']);
          $sql= "SELECT * FROM USERS WHERE users.Id=$lid";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          ?>
        <form id="UpdateS"  method='post' action="#" onsubmit="return UpdateUse();">
          <input type="hidden" value="UpdateProfile" name="UpdateProfile">
          <div class="form-group">
            <label>Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" name="Full_Name" id="Full_Name" value="<?php echo $myrow[5]?>" style="text-transform:uppercase;" required>
          </div>
          <div class="form-group">
            <label>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" name="Username" id="Username" value="<?php echo $myrow[2];?>" readonly style="cursor: not-allowed;">
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Staff-ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="StaffID" id="StaffID" value="<?php echo $myrow[1];?>" required style="text-transform: uppercase;cursor: not-allowed;" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <select name="Gender" id="Gender">
                <option value="<?php echo $myrow[7];?>" selected><?php echo $myrow[7];?></option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Mobile-No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="Mobile" id="Mobile" value="<?php echo $myrow[6];?>">
            </div>
            <div class="form-group col-md-6">
              <label>Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <select name="Position" id="Position">
                <option value="<?php echo $myrow[8];?>" selected><?php echo $myrow[8];?></option>
                <option value="Staff">Staff</option>
                <option value="Superior">Superior</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Type of Staff&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <select name="TOS" id="TOS">
              <option value="<?php echo $myrow[23];?>" selected><?php echo $myrow[23];?></option>
              <option value="Contract">Contract</option>
              <option value="Permanent">Permanent</option>
            </select>
          </div>
          <div class="form-group">
            <label>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="email" name="Email" id="Email" value="<?php echo $myrow[3];?>" style="text-transform: lowercase;">
          </div>
          <div class="form-group">
            <label>Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <select name="department" id="department">
              <option value="<?php echo $myrow[9];?>" selected><?php if ($myrow[9]== "HUMAN RESOURCE DEPARTMENT"){echo "HUMAN RESOURCE DEPT.";}
              else if  ($myrow[9]== "TECHNICAL DEPARTMENT"){echo "TECH TEAM DEPT.";}
              else if  ($myrow[9]== "FINANCE DEPARTMENT"){echo "FINANCE DEPT.";}
              else if  ($myrow[9]== "SALES DEPTARMENT"){echo "SALES DEPT.";}?></option>
              <option value="HUMAN RESOURCE DEPARTMENT">HUMAN RESOURCE DEPARTMENT</option>
              <option value="TECHNICAL DEPARTMENT">TECHNICAL DEPARTMENT</option>
              <option value="FINANCE DEPARTMENT">FINANCE DEPARTMENT</option>
              <option value="SALES DEPARTMENT">SALES DEPARTMENT</option>
            </select>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Emergency Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="EL" id="EL" value="<?php echo $myrow[16];?>" style=" width:90%;cursor: not-allowed;" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php echo $myrow[11];?>" style=" width:90%; cursor: not-allowed;cursor: not-allowed;" readonly>
            </div>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Medical Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="ML" id="ML" value="<?php echo $myrow[13];?>" style="width:90%;">
            </div>
            <div class="form-group col-md-6">
              <label>Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php echo $myrow[14];?>" style=" width:90%; cursor: not-allowed;" readonly>
            </div>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Annual Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="AL" id="AL" value="<?php echo $myrow[16];?>" style="width:90%;">
            </div>
            <div class="form-group col-md-6">
              <label>Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php echo $myrow[17];?>" style=" width:90%; cursor: not-allowed;" readonly>
            </div>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Replacement Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="RL" id="RL" value="<?php echo $myrow[19];?>" style="width:90%;">
            </div>
            <div class="form-group col-md-6">
              <label>Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php echo $myrow[20];?>" style="width:90%; cursor: not-allowed;" readonly>
            </div>
          </div>
          <div class="formbutton">
              <input type="submit" name="submit" value="Update" style="margin: 10px 0px;">
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
<script type="text/javascript">
  function UpdateUse()
  {
    var form= $("#UpdateS")[0];
    var formdata= new FormData(form);
    var r = confirm("You are about to update Staff Detail\n\n Press OK to proceed \nCANCEL to terminate the process");
     if (r == true) {
      $.ajax
      ({
          type:"post",
          url:"/DK/HR/UpdateUser.php?empId=<?php echo $myrow[0];?>",
          data:formdata,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response=="success")
              {
                alert("Staff detail as been updated");
                window.location.reload();
              }
            else{
              alert(response);
            }
          }
      });
    }
    else {
        alert("Process terminated");
        window.location.reload();
    }

   return false;
}
</script>
</html>

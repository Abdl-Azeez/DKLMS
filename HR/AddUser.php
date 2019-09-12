<?php
  include("session.php");
?>

  <title>L_M_S |New User</title>
  <link type="text/css" rel="stylesheet" href="/DK/css/details.css">
  <?php
    include"display.php";
  ?>
  <style>
    #username{
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
      padding: 20px 10px 10px 100px;
    }
    #Email{
      padding: 20px 10px 10px 80px;
    }
    #department{
      padding: 20px 10px 10px 250px;
    }
    @media screen and (max-width: 1060px) {
      .form-group input, .form-group section, .form-group select {
        font-size: 14px;
      }
      #username{
        padding: 20px 10px 10px 60px;
      }
      #StaffID{
        padding: 20px 10px 10px 60px;
      }
      #Gender{
        padding: 20px 10px 10px 95px;
      }
      #TOS{
        padding: 20px 10px 10px 240px;
      }
      #Mobile{
        padding: 20px 10px 10px 80px;
      }
      #Position{
        padding: 20px 10px 10px 85px;
      }
      #Email{
        padding: 20px 10px 10px 80px;
      }
      #department{
        padding: 20px 10px 10px 250px;
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
      <span>Add New Staff</span>
      <div class="profileSection">
        <form id="AddUser"  method='post' action="#" onsubmit="return Add();">
          <input type="hidden" value="New" name="New">
          <div class="form-group">
            <label>Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" name="Full_Name" id="Full_Name" placeholder="Enter user Full Name" style="text-transform:uppercase;" required>
          </div>
          <div class="form-group">
            <label>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" name="Username" id="Username" placeholder="Enter username" required>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Staff-ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="StaffID" id="StaffID" placeholder="Enter user ID" required style="text-transform: uppercase;">
            </div>
            <div class="form-group col-md-6">
              <label>Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <select name="Gender" id="Gender" required>
                <option value="" disabled selected hidden>Choose Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Type of Employee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <select name="TOS" id="TOS"  required>
              <option value="" disabled selected hidden>Choose type</option>
              <option value="Contract">Contract</option>
              <option value="Permanent">Permanent</option>
            </select>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Mobile-No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="Mobile" id="Mobile" placeholder="Enter user mobile number">
            </div>
            <div class="form-group col-md-6">
              <label>Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <select name="Position" id="Position" required>
                <option value="" disabled selected hidden>Choose user position</option>
                <option value="Staff">Staff</option>
                <option value="Superior">Superior</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="email" name="Email" id="Email" placeholder="Enter user email address" style="text-transform: lowercase;">
          </div>
          <div class="form-group">
            <label>Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <select  name="department" id="department" required>
              <option value="" disabled selected hidden>Choose a Department</option>
              <option value="HUMAN RESOURCE DEPARTMENT">HUMAN RESOURCE DEPARTMENT</option>
              <option value="TECHNICAL DEPARTMENT">TECHNICAL DEPARTMENT</option>
              <option value="FINANCE DEPARTMENT">FINANCE DEPARTMENT</option>
              <option value="SALES DEPARTMENT">SALES DEPARTMENT</option>
            </select>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>New Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="password" name="Password1" id="Password1" placeholder="Enter New Password" minlength="6" pattern=".{6,}" title="Password must contain six or more characters without space" required>
            </div>
            <div class="form-group col-md-6">
              <label>Confirm Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="password" name="Password2" id="Password2"  placeholder="Re-type Password" minlength="6" pattern=".{6,}" title="Password must contain six or more characters without space" required>
            </div>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Medical Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="ML" id="ML" style="padding: 20px 10px 10px 150px; width:90%;" required>
            </div>
            <div class="form-group col-md-6">
              <label>Annual Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="AL" id="AL" style="padding: 20px 10px 10px 150px; width:90%;" required>
            </div>
          </div>
          <div class="form-row" style="margin-left: 20px;">
            <div class="form-group col-md-6">
              <label>Replacement Leaves&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="RL" id="RL" style="padding: 20px 10px 10px 150px; width:90%;" required>
            </div>
          </div>
          <div class="formbutton" style="margin:0px;">
              <input type="submit" name="submit" value="Add Staff" style="margin:0px;">
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
<script type="text/javascript">
  function Add()
  {
    var form= $("#AddUser")[0];
    var formdata= new FormData(form);
    var r = confirm("You are about to Add New User\n Press OK to proceed \nCANCEL to terminate the process");
     if (r == true) {
      $.ajax
      ({
          type:"post",
          url:"/DK/HR/NewStaff.php",
          data:formdata,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response=="success")
              {
                alert("New User as been created");
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

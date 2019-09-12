<?php
  include'session.php';
?>

  <title>L_M_S | PROFILE</title>
  <link rel="stylesheet" href="\DK\css\Profile.css">
  <?php
    include'display.php';
  ?>
</head>
<body>
  <div id="load"></div>
  <main>
    <navigation  class='fixed-top navbar navbar-expand-lg navbar-dark nav-style'>
      <div class='logo' style="width: 24%;">
        <div class='logoImage'>
          <a href='\DK\index.php'>
            <img src='\DK\images\DKlogo.png' alt='logo'>
            <label>LEAVE MANAGEMENT<br> SYSTEM</label>
          </a>
        </div>
      </div>
			<button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
  				<span class='navbar-toggler-icon'></span>
			</button>
			<div class='collapse navbar-collapse' id='navbarNav'>

        <ul class='ul-class nav navbar-nav borderEffect'>
         <li class='nav-item'><a href='\DK\Superior\Records.php' style='padding-left:8px;' class="ml-2">Staff Requests</a></li>
         <li class='nav-item'><a href='\DK\Superior\StaffRecords.php'>Staff Records</a></li>
         <li class='nav-item'><a href='\DK\Superior\Record.php'>My Records</a></li>
         <li class='nav-item'><a href='\DK\Superior\Request.php'>Apply</a></li>
         <li class='activated'><a href='\DK\Superior\Profile.php' style='color: #121307;'>Profile</a></li>
         <!-- <li class='nav-item'><a href='\DK\Superior\ChangePassword.php'>Change Password</a></li> -->
         <li class='nav-item' style='display:none;'><a href='\DK\Login.php'>Logout</a></li>
        </ul>
      </div>
      <div class='userProfileImage'>
        <img src='<?php if ($myrow[22]==""){echo "\DK\images\userPlaceholder.png";}else{echo"\DK\Superior\ProfilePictures\\$myrow[22]";};?>'/>
        <section style="display: inline-flex;justify-content: space-around;">
          <a href="javascript:void(0)" data-activates="dropdown1" class="dropdown-button">
            <i class="material-icons">notifications_none</i>
            <?php
            $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
            $user=$_SESSION['username'];
            $sql = "SELECT COUNT(*) AS 'count' FROM request INNER JOIN users ON users.Department = request.Departments WHERE users.StaffID=request.StaffID AND users.roles='Staff' AND request.status=0";
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
                $sql2 = "SELECT request.Id AS lid, request.StaffName, request.StaffID, request.leaveType, request.DateFrom, request.DateTo, request.Attachment, request.PostingDate, users.Department, request.status FROM request INNER JOIN users ON users.Department = request.Departments
                WHERE users.StaffID=request.StaffID AND users.roles='Staff' AND request.status=0 ORDER BY request.PostingDate desc";
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
                      <div class="notification-text"><p><b style="text-transform:uppercase;"><?php echo $myrow["StaffName"];?><br/></b>
                        <?php echo $myrow ["StaffID"]?> <br>applied for <b><?php if ($myrow["leaveType"]==1)
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
                              };?></b> on <br><?php echo $myrow["PostingDate"];?></p>
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
    <div class='component'>
      <label>My Profile</label>
      <?php
        $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
        // $StaffName=$_POST['StaffName'];
        $user=$_SESSION['username'];
        $sql= "SELECT * FROM users WHERE username='$user' AND roles='Superior'";
        $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
        $myrow= mysqli_fetch_row ($result);
        echo "
        <div class='profileSection col-md-12'>
          <form id=\"Image\" enctype=\"multipart/form-data\" class=\"col-md-6\" method='post' action=\"#\" onsubmit=\"return image();\">
          <input type=\"hidden\" value=\"updateimage\" name=\"updateimage\">
            <div class='profilePicture'>
              <a href=\"";if ($myrow[22]==""){echo "\DK\images\userPlaceholder.png";}else{echo"\DK\Superior\ProfilePictures\\$myrow[22]";};echo"\" target=\"_blank\">
                <img src='";if ($myrow[22]==""){echo "\DK\images\userPlaceholder.png";}else{echo"\DK\Superior\ProfilePictures\\$myrow[22]";};echo"'/>
              </a>
              <span>Change Profile Picture</span>
              <input type=\"file\" name=\"profimage\" id=\"profimage\" style=\"padding:20px 0px;\">
              <div class='formbutton' style='position: absolute;top: 76%;left: 70%;'>
                  <input type='submit' name='submit' id='imageURL' style='border-radius: 12px;padding: 12px; color:white;' value='Upload'>
              </div>

            </div>
          </form>
          <form id=\"Profile\" enctype=\"multipart/form-data\" class=\"col-md-6\" method='post' action=\"#\" onsubmit=\"return Profile();\">
            <input type=\"hidden\" value=\"UpdateProfile\" name=\"UpdateProfile\">
            <div class='sideform'>
              <div class='form-group'>
                <label>Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Full_Name' id='Full_Name' value='$myrow[5]' style='text-transform:uppercase;' required>
              </div>
              <div class='form-group'>
                <label>Username&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Username' id='Username' value='$myrow[2]' pattern=\"^[a-zA-Z][a-zA-Z0-9-_\/.]{1,20}$\" title=\"username should not contain any space\" required>
              </div>
              <div class='form-group'>
                <label>Staff-ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='StaffID' id='StaffID' value='$myrow[1]' required style='text-transform: uppercase;' readonly>
              </div>
              <div class='form-group'>
                <label>Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Department' id='Department' value='";
                if ($myrow[9]=="HUMAN RESOURCE DEPARTMENT"){echo "HUMAN RESOURCE";}
                else if ($myrow[9]=="TECHNICAL DEPARTMENT"){echo "TECH TEAM";}
                else if ($myrow[9]=="FINANCE DEPARTMENT"){echo "FINANCE";}
                else if ($myrow[9]=="SALES DEPARTMENT"){echo "SALES";}
                else{echo "$myrow[9]";}
                echo"' readonly>
              </div>
              <div class='form-group'>
                <label>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='email' name='Email' id='Email' value='$myrow[3]' required style='text-transform: lowercase;'>
              </div>
              <div class='form-group'>
                <label>Mobile-No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Mobile' id='Mobile' value='$myrow[6]' size='12'>
              </div>
              <div class='form-group'>
                <label>Gender&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                <input type='text' name='Gender' id='Gender' value='$myrow[7]'>
              </div>
              <div class='formbutton'>
                  <input type='submit' name='submit' value='Update'>
              </div>
            </div>
          </form>
        </div>";
          if ($myrow[22]!=""){echo "
            <form id=\"DeleteForm\" action=\"#\" method=\"post\"  onsubmit=\"return rowdel();\" class=\"deleteForm\">
              <input type=\"hidden\" value=\"ProcessDelete\" name=\"ProcessDelete\">
              <div id=\"dlt\" onclick=\"return rowdel();\">
                  <input type=\"submit\" class=\"Add deleteIcon\" name=\"submit\" value=\"Remove Picture\">
                  <i class=\"material-icons\" style=\"color: #dfeaeb;cursor: pointer;\" title=\"Delete User\">delete_forever</i>
              </div>
            </form>
          ";}?>
    </div>
  </main>
</body>
<?php
  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
  $user=$_SESSION['username'];
  $sql= "SELECT * FROM users WHERE roles='Superior' AND username='$user'";
  $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
  $myrow= mysqli_fetch_row ($result);
?>
<script type="text/javascript">
  function rowdel(){
    if(confirm("Are you sure you want to remove your profile picture?")){
      $.ajax
      ({
          type:'post',
          url:'/DK/Superior/Picturedel.php?empid=<?php echo "$myrow[0]";?>',
          data:{
           ProcessDelete:"ProcessDelete",
          },
          success: function (response) {
            if (response=="success")
              {
                alert("Picture successfully removed");
                window.location.reload();
              }
            else{
              alert(response);
            }
          }
      });
    }
    else {
      alert("Action Discard");
    }
     return false;
   }

  function Profile()
  {
     // var Full_Name=$("#Full_Name").val();
     // var Username=$("#Username").val();
     // var StaffID=$("#StaffID").val();
     // var Email=$("#Email").val();
     // var Mobile=$("#Mobile").val();
     // var Gender=$("#Gender").val();
     var form= $("#Profile")[0];
     var formdata= new FormData(form);
     var r = confirm("You are about to update your profile\n Press OK to proceed \nCANCEL to terminate the process");
      if (r == true) {
        $.ajax
        ({
            type:'post',
            url:'/DK/Superior/UpdateProfile.php',
            data:formdata,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response=="success")
                {
                  alert("Your profile as been updated");
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
  function image()
  {
     var form= $("#Image")[0];
     var formdata= new FormData(form);
     var r = confirm("You are about to update your profile picture\n Press OK to proceed \nCANCEL to terminate the process");
      if (r == true) {
        $.ajax
        ({
            type:'post',
            url:'/DK/Superior/UpdatePicture.php',
            data:formdata,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response=="success")
                {
                  alert("Your profile Picture as been updated");
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
  $('#imageURL').hide();

    setInterval(function(){
        if($('#profimage').val()!=""){
         $('#imageURL').show();
        }else{
            $('#imageURL').hide();
        }
    },1000);
</script>
</html>

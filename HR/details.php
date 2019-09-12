<?php
  include('session.php');
?>

  <title>L_M_S |Staff Details</title>
  <link type="text/css" rel="stylesheet" href="/DK/css/details.css">
  <?php
    include'display.php';
  ?>
  <style>
  @media screen and (max-width:992px){
    #department{
      padding-left: 150px;
    }
  }
  @media screen and (max-width:768px){
    #department{
      padding-left: 115px;
    }
  }
  @media screen and (max-width:640px){
    #department{
      padding-left: 92px;
    }
  }

  </style>
</head>
<body>
  <div id="load"></div>
  <div id="wait" style="display:none;"></div>
  <main>
    <navigation  class='fixed-top navbar navbar-expand-lg navbar-dark nav-style'>
      <div class='logo' style="width: 32%;">
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
         <li class='nav-item'><a href='\DK\HR\Records.php' class="ml-2" style="padding-left:8px;">Requests</a></li>
         <li class='nav-item'><a href='\DK\HR\AllRecords.php'>Records</a></li>
         <li class='nav-item'><a href='\DK\HR\Users.php'>Users</a></li>
         <li class='nav-item'><a href='\DK\HR\Profile.php'>Profile</a></li>
         <li class='nav-item' style='display:none;'><a href='\DK\Login.php'>Logout</a></li>
        </ul>
      </div>
      <div class='userProfileImage'>
        <img src='<?php if ($myrow[22]==""){echo "\DK\images\userPlaceholder.png";}else{echo"\DK\HR\ProfilePictures\\$myrow[22]";};?>'/>
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
      <span>Staff Details</span>
      <div class="profileSection">
        <?php
          $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
          $user=$_SESSION['username'];
          $lid=intval($_GET['leaveid']);
          $sql= "SELECT request.id as lid, request.StaffName, request.StaffID, users.Email, users.MobileNum, request.Attachment, request.Reason, request.status, users.Roles, users.ELtaken, users.ELbalance, users.CLtaken, users.CLbalance, users.Annualtaken, users.Annualbalance, users.OLtaken, users.OLbalance,
          request.Departments, request.Remark, users.Profileimg, request.leaveType, users.TOS FROM request LEFT JOIN USERS ON USERS.StaffID = REQUEST.StaffID WHERE request.Id=$lid";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          ?>
        <div class="profilePicture">
            <img src='<?php if ($myrow[19]==""){echo "\DK\images\userPlaceholder.png";}else{echo"\DK\Staff\ProfilePictures\\$myrow[19]";};?>'/>
            <input type="text" name="username" value="<?php echo $myrow[1]; ?>" style="text-transform:uppercase;" readonly>
        </div>
        <form class="" name="userUpdate" method="post" action="ProcessDetails.php?leaveid=<?php echo $myrow[0];?>" onsubmit="return UpdateDetail();">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Staff-ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="StaffID" value="<?php echo $myrow[2]; ?>" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Mobile-No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="Mobile" value="<?php echo $myrow[4]; ?>" readonly>
            </div>
          </div>
          <div class='form-group'>
            <label>Employee&nbsp;&nbsp;&nbsp;&nbsp;Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type='text' name='TOS' id='TOS' value='<?php echo $myrow[21];?>'  style='cursor:not-allowed;padding: 20px 10px 10px 20px;' readonly>
          </div>
          <div class="form-group">
            <label>Position&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" name="Position" value="<?php echo $myrow[8]?>" style='cursor:not-allowed;padding: 20px 10px 10px 20px;' readonly>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Leave Taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" name="" value="<?php if ($myrow[20]==1)
                    {
                      echo "$myrow[13]";
                    }
                    else if ($myrow[20]==2)
                    {
                      echo "$myrow[9]";
                    }
                    else if ($myrow[20]==3)
                    {
                      echo "$myrow[11]";
                    }
                    else if ($myrow[20]==4)
                    {
                      echo "$myrow[15]";
                    }?>" readonly>
            </div>
            <div class="form-group col-md-6">
              <label>Balance&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
              <input type="text" value="<?php  if ($myrow[20]==1)
                      {
                        echo "$myrow[14]";
                      }
                      else if ($myrow[20]==2)
                      {
                        echo "$myrow[14]";
                      }
                      else if ($myrow[20]==3)
                      {
                        echo "$myrow[12]";
                      }
                      else if ($myrow[20]==4)
                      {
                        echo "$myrow[16]";
                      }
                      else{
                        echo "Null";
                      } ?>" readonly>
            </div>
          </div>
          <?php if ($myrow[5]!=""){ echo"
          <div class=\"form-group\">
            <label>Attachment Uploaded &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <a href=\"/DK/Staff/uploadeddata/$myrow[5]\" target=\"_blank\"><img id=\"viewicon\" src=\"/DK/images/Attach.png\"></a><input type=\"text\" readonly>
          </div>
          ";}?>
          <div class="form-group">
            <label>Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="text" name="department" value="<?php echo $myrow[17]; ?>" id="department" readonly>
          </div>
          <div class="form-group">
            <label>Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <input type="email" name="Email" value="<?php echo $myrow[3]; ?>" style="padding-left: 10px;" readonly>
          </div>
          <div class="form-group" id="statuss">
            <label>Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
            <?php
              if($myrow[7]==1){
              echo "<section style=\"padding: 5px 280px;\"><span style='color: green'>Approved</span>";
              }
              if($myrow[7]==2){
              echo "<section style=\"padding: 5px 239px;\"><span style='color: blue'>Waiting For Approval</span>";
              }
              if($myrow[7]==4){
              echo "<section style=\"padding: 5px 264px;\"><span style='color: red'>Not Approved</span>";
              }
            ; ?>  </section>
          </div>
          <div class="form-group" style="margin-top:40px;">
            <label style="margin-left: 70px;">Staff Reason</label>
            <textarea readonly><?php if ($myrow[6]==""){echo "Not Stated";} else {echo $myrow[6];} ?></textarea>
          </div>
          <div class="formbutton">
              <?php if ($myrow[7]==2){?>
                <button type="button" class="inpute" data-toggle="modal" data-target=".bd-example-modal-lg">Action</button>
              <?php }?>
              <div class="modal fade bd-example-modal-lg modal-fixed-footer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content" style="background: #568fc7; width:90%; border-radius: 20px;">
                    <div class="modal-header">
                      <h5 class="modal-title">HR Action</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" method="post">
                      <div class="modal-form-content">
                        <select name="status" id="status" required="">
                            <option value="">Choose your action here</option>
                            <option value="1">Approved</option>
                            <option value="4">Not Approved</option>
                        </select>
                      </div>
                      <div class="modal-form-content">
                        <label>Superior Remarks</label>
                        <textarea readonly><?php if ($myrow[18]==""){echo "No Remark Stated";} else {echo $myrow[18];}?></textarea>
                      </div>
                      <input type="submit" name="submit" value="Submit" onclick="myFunction()" style="padding: 14px 25px;">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</body>
<script type="text/javascript">
  function UpdateDetail()
  {
     var status=$("#status").val();
     document.getElementById('wait').style.display="";

      $.ajax
      ({
          type:'post',
          url:'/DK/HR/ProcessDetails.php?leaveid=<?php echo $myrow[0];?>',
          data:{
           UpdateDetail:"UpdateDetail",
           status:status
          },
          success: function (response) {
            if ((response=="success") || (response=="Action recorded but fail to send to Staff mail"))
              {
                alert("Action Taken");
                window.location.reload();
              }
            else{
              alert(response);
              document.getElementById('wait').style.display="none";
            }
          }
      });
      // alert("Password successfully Updated");

     return false;
  }
</script>
</html>

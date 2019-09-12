<?php
  include'session.php';
?>
<title>L_M_S | RECORDS PAGE</title>
<link rel="stylesheet" href="\DK\css\modal.css">
<?php
  include'display.php';
?>
<style>
#datefromto{
  width: 120px;
}
#tdstatus{font-weight: 600; width: 100px;}
#tdpostingdate{width: 150px;}

@media
  only screen
  and (max-width: 760px), (min-device-width: 768px)
  and (max-device-width: 1024px)  {
    #datefromto{width: auto;}
    #tdstatus{font-weight: 600; width: auto;}
    #tdpostingdate{width: auto;}
    #tddetails{padding-left: 67%;}
    #tddetailinput{padding: 5px 22px;}
    tr,  th{
      border: 0.5px solid white;
      padding: 10px;
      text-shadow: none;
    }
    .search-txt {width: auto;}
    td:nth-of-type(1):before { content: "#"; }
    td:nth-of-type(2):before { content: "Staff Name"; }
    td:nth-of-type(3):before { content: "Staff ID"; }
    td:nth-of-type(4):before { content: "Leave Type"; }
    td:nth-of-type(5):before { content: "From"; }
    td:nth-of-type(6):before { content: "To"; }
    td:nth-of-type(7):before { content: "No. Of Days"; }
    td:nth-of-type(8):before { content: "Posting Date"; }
    td:nth-of-type(9):before { content: "Status"; }
    td:nth-of-type(10):before { content: "Action"; }
  }
</style>
</head>
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
         <li class='activated'><a href='\DK\Superior\Records.php' style='color: #1463f7fc; padding-left:8px;' class="ml-2">Staff Requests</a></li>
         <li class='nav-item'><a href='\DK\Superior\StaffRecords.php'>Staff Records</a></li>
         <li class='nav-item'><a href='\DK\Superior\Record.php'>My Records</a></li>
         <li class='nav-item'><a href='\DK\Superior\Request.php'>Apply</a></li>
         <li class='nav-item'><a href='\DK\Superior\Profile.php'>Profile</a></li>
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
      <label>Leave Records</label>
      <div class="search-box">
        <input type="text" class="search-txt" id="searchInput" onkeyup="myFunction()" placeholder="Search staff names.." title="Type a staff name">
        <a class="search-btn" href="javascript:void(0)">
          <i class="fa fa-search" aria-hidden="true"></i>
        </a>
      </div>
      <input type='text' value='WELCOME &nbsp <?php echo $_SESSION['username']; ?> !' readonly class='user'>
      <div style="display: flex;justify-content: space-around;width: 100%;margin-top: 50px;">
        <div class="row-group" id="row-group">
          <select name="state" id="maxRows" class="form-control" style="width:150px;">
            <option value="5000">Show All</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="75">75</option>
            <option value="100">100</option>
          </select>
        </div>
        <form method="post" action="generate_pdf.php">
          <div class="formbutton">
          <button type="button" class="inpute" data-toggle="modal" data-target=".bd-example-modal-lg">Print Records</button>
          <div class="modal fade bd-example-modal-lg modal-fixed-footer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content" style="background: #568fc7; width:90%; border-radius: 20px;">
                <div class="modal-header">
                  <h5 class="modal-title">Sort Record to Generate</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <?php
                  $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
                  $user=$_SESSION['username'];
                  $query="SELECT * FROM users WHERE users.username='$user'";
                  $outcome= mysqli_query ($connection, $query) or die ("Could not execute query");
                  $rowselected= mysqli_fetch_row ($outcome);
                  if ($outcome){
                        $sql= "SELECT * FROM users WHERE users.roles='staff' AND users.Department='$rowselected[9]'";
                        $result1= mysqli_query ($connection, $sql) or die ("Could not execute query");
                      ?>
                <div class="modal-body" method="post">
                  <div class="modal-form-content">
                    <select name="empname" id="empname" required>
                        <option value="">Choose Staff Name here</option>
                            <?php if ($result1->num_rows > 0)
                              {
                                 while($myrow = $result1->fetch_assoc()){
                            ?>
                                  <option value="<?php echo $myrow["StaffName"]?>"><?php echo $myrow["StaffName"]?></option><?php }
                              }}?>
                        <option value="5">All</option>
                    </select>
                  </div>
                  <div class="modal-form-content">
                    <select id="empleave" name="empleave" required>
                        <option selected>Choose Leave Type...</option>
                        <option value="1">Annual Leave</option>
                        <option value="2">Emergency Leave</option>
                        <option value="3">Medical Leave</option>
                        <option value="4">Replacement Leave</option>
                        <option value="5">All</option>
                    </select>
                  </div>
                  <input type="submit" name="Formsubmit" value="Print">
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
        <?php
          $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
          $user=$_SESSION['username'];
          $status=0;
          $sql= "SELECT request.Id, request.StaffName, request.StaffID, request.leaveType, request.DateFrom, request.DateTo, request.NoDays, request.PostingDate, users.Department, request.status FROM request INNER JOIN users ON users.Department = request.Departments
          WHERE users.StaffID=request.StaffID AND users.roles='Staff' AND request.status=$status ORDER BY  request.PostingDate desc";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          echo"
                <table id='Table' class=\"table-responsive\" style=\"margin-top:20px;\">
                      <thead>
                        <tr>
                          <th>Staff Name</th>
                          <th>Staff ID</th>
                          <th>Leave Type</th>
                          <th>Leave Taken<br>{From}</th>
                          <th>Leave Taken<br>{To}</th>
                          <th>No. Of Days</th>
                          <th>Posting Date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>";
          if ($myrow[0]>0){
            do{
              echo"
                      <tbody>
                        <tr>
                          <td style='text-transform:uppercase;'>$myrow[1]</td>
                          <td name='name'>$myrow[2]</td>
                          <td>"; if ($myrow[3]==1)
                                {
                                  echo "Annual Leave";
                                }
                                else if ($myrow[3]==2)
                                {
                                  echo "Emergency Leave";
                                }
                                else if ($myrow[3]==3)
                                {
                                  echo "Medical Leave";
                                }
                                else if ($myrow[3]==4)
                                {
                                  echo "Replacement Leave";
                                }
                                else {
                                  echo "$myrow[3]";
                                }echo"

                          </td>
                          <td>$myrow[4]</td>
                          <td>$myrow[5]</td>
                          <td>$myrow[6]</td>
                          <td>$myrow[7]</td>
                          <td id=\"tdstatus\">";
                              if($myrow[9]==0)  {
                              echo "<span style='color: Yellow'>Pending</span>";
                               }
                              if($myrow[9]==1){
                              echo "<span style='color: green'>Approved</span>";
                              }
                              if($myrow[9]==2){
                              echo "<span style='color: blue'>Waiting for Admin Approval</span>";
                              }
                              if($myrow[9]==3){
                              echo "<span style='color: red'>Not Approved</span>";
                              }
                              if($myrow[9]==4){
                              echo "<span style='color: red'>Not Approved by Admin</span>";
                              }
                              echo"
                          </td>
                          <td id=\"tddetails\"><a href='details.php?leaveid=$myrow[0]'><input type='submit' name='view' value='view' id=\"tddetailinput\"></a></td>
                        </tr>
                      </tbody>";
              }
              while($myrow= mysqli_fetch_row($result));
              echo"<span class='NotFound' style=\"display:none;\" id=\"noresults\">No Names of Staff has \"<span id=\"qt\"></span>\"</span></table>";
}
          else {
            echo "<tbody><tr><td colspan='11'><span class='NoRecord'>No Request at the Moment</span></td></tr></tbody></table>";
          }
      ?>
      <div class="pagination-container" id="paginationContainer">
        <nav aria-label="Page navigation example">
            <ul class="pagination"></ul>
        </nav>
      </div>
    </div>
    <?php if ($count>0){?>
      <div id="boxes">
        <div style="top: 199.5px; left: 551.5px; display: none; display: flex; flex-direction: column; align-items: center;" id="dialog" class="window">
          <div id="popuptext">
            <p>You have &nbsp <?php echo "$count";?> &nbsp unchecked <?php if ($count==1){echo "notification";} else {echo "notifications";}?></p>
          </div>
          <div id="popupfoot"> <span class="discard">Close</span></div>
        </div>
        <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
      </div>
    <?php } ?>
  </main>
  <?php include 'pagination.php';?>
</body>
</html>

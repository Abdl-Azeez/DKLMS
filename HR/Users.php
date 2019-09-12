<?php
  include('session.php');
?>

  <title>L_M_S | STAFFS</title>
  <?php
    include'display.php';
  ?>
</head>
<body>
  <div id="load"></div>
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
          <li class='nav-item'><a href='\DK\HR\Records.php' style='padding-left:8px;' class="ml-2">Requests</a></li>
          <li class='nav-item'><a href='\DK\HR\AllRecords.php'>Records</a></li>
          <li class='activated'><a href='\DK\HR\Users.php' style="color: #121307;">Users</a></li>
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
    <div class='component'>
      <label>All Users</label>
      <div class="search-box">
        <input type="text" class="search-txt" id="searchInput" onkeyup="myFunction()" placeholder="Search staff names.." title="Type a staff name">
        <a class="search-btn" href="javascript:void(0)">
          <i class="fa fa-search" aria-hidden="true"></i>
        </a>
      </div>

      <div style="display: flex;justify-content: space-around;width: 100%;margin-top: 50px;">
        <div class="row-group" id="row-group">
          <select name="state" id="maxRows" class="form-control">
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
        <a href="AddUser.php"><input type="submit" value="New Staff" class="Add"></a>
      </div>
        <?php
          $connection = mysqli_connect("localhost", "root", "", "FYP") or die ("Couldn't connect to server");
          $user=$_SESSION['username'];
          $status=1;
          $Currentdate = date("Y-m-d");
          $sql= "SELECT * FROM users where roles!='HR' AND roles<>'Admin'";
          $result= mysqli_query ($connection, $sql) or die ("Could not execute query");
          $myrow= mysqli_fetch_row ($result);
          echo"
                <table id='Table' class=\"table table-responsive\" style='margin-top:20px;'>
                      <thead>
                        <tr>
                          <th>Staff ID</th>
                          <th>Staff Name</th>
                          <th>Department</th>
                          <th>Position</th>
                          <th>Action</th>
                        </tr>
                      </thead>";
          if ($myrow[0]>0){
            do{
              echo"
                      <tbody>
                        <tr>
                          <td style='text-transform:uppercase;'>$myrow[1]</td>
                          <td>$myrow[5]</td>
                          <td>$myrow[9]</td>
                          <td>$myrow[8]</td>
                          <td style=\"display: flex; border: none;\"><a href='edit.php?empid=$myrow[0]'><i class=\"material-icons\" style=\"color:green;\" title=\"Update User\">mode_edit</i></a>
                          <form id=\"DeleteForm\" action=\"delete.php\" method=\"post\"  style=\"margin: 0px 0px 0px 22px;\" onsubmit=\"return confirm('Do you really want to delete this user?');\">
                            <input name=\"del\" class='del' type=\"hidden\"  value=\"$myrow[0]\">
                            <i onclick=\"$(this).closest('form').submit();\" class=\"material-icons\" style=\"color:red; cursor:pointer;\" title=\"Delete User\">delete_forever</i>
                          </form>
                          </td>
                        </tr>
                      </tbody>";
              }
              while($myrow= mysqli_fetch_row($result));
              echo"<span class='NotFound' style=\"display:none; top:71%;\" id=\"noresults\">No Names of Staff has \"<span id=\"qt\"></span>\"</span></table>";
          }
          else {
            echo "<tbody><tr><td colspan='5'><span class='NoRecord'>No Staffs Available</span></td></tr></tbody></table>";
          }
      ?>
        <div class="pagination-container" id="paginationContainer">
          <nav aria-label="Page navigation example">
              <ul class="pagination"></ul>
          </nav>
        </div>
      </div>
  </main>
  <?php include 'pagination.php';?>
</body>
</html>

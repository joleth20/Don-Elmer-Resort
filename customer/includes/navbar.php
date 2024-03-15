<?php

require '../connection.php';

if (isset($_SESSION['customer_id']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
?>
   
   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-water"></i>
  </div>
  <div class="sidebar-brand-text mx-3">Don Elmer's <sup>Hotel & Resort</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<li class="nav-item">
  <a class="nav-link" href="available-schedule.php" id="nav-link-available">
    <i class="fas fa-calendar-alt"></i>
    <span> Available schedules</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Dashboard -->
<li class="nav-item ">
  <a class="nav-link" href="dashboard.php" id="nav-link-dashboard">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- List of reservations -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages" id="nav-link-status">
    <i class="fas fa-list"></i>
    <span> List your Status</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="pending.php">Pending</a>
      <a class="collapse-item" href="approved.php">Approved</a>
      <a class="collapse-item" href="reject.php">Rejected</a>
  </div>
</li>


<li class="nav-item">
  <a class="nav-link" href="profile.php" id="nav-link-profile">
    <i class="fas fa-fas fa-user "></i>
    <span> Profile</span></a>
</li>


<li class="nav-item">
  <a class="nav-link"  href="log-in.php" data-toggle="modal" data-target="#logoutModal ">
    <i class="fas fa-sign-out-alt"></i>
    <span> Logout</span></a>
</li>






<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <?php
// Your PHP code to fetch reservations and count rows
$currentUser = $_SESSION['customer_id'];

// Check if the bell icon is clicked
if (isset($_GET['markAsSeen'])) {
    // Update the 'seen' column to mark reservations as seen
    $updateQuery = "UPDATE reservations SET seen = 1 WHERE (status = 'Approved' OR status = 'reject') AND user_id = '$currentUser'";
    mysqli_query($con, $updateQuery);
}

// Fetch the count considering both seen and unseen reservations
$query = "SELECT * FROM reservations WHERE (status = 'Approved' OR status = 'reject') AND user_id = '$currentUser' ORDER BY user_id DESC";
$result = mysqli_query($con, $query);


$reservationCount = ''; 

// Check each reservation for the 'seen' status
while ($row = mysqli_fetch_array($result)) {
    if ($row['seen'] == 0) {
        $reservationCount++;
    }
}

// Store the count in a session variable
$_SESSION['reservation_count'] = $reservationCount;

?>




            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1" id="alertsDropdown">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" >
        <i title="Notifications" class="fas fa-bell fa-fw" id="reservationCount"></i>
        <span class="count">
    <?php echo $_SESSION['reservation_count'] = $reservationCount; ?>
</span>

        </span>
    </a>

              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
    <span class="dropdown-header" >
        Notifications
    </span> 
    <div class="dropdown-content" style="max-height: 300px; overflow-y: auto;">
    <?php
$currentUser = $_SESSION['customer_id'];
$query = "SELECT * FROM reservations WHERE (status = 'Approved' OR status = 'Reject') AND user_id = '$currentUser' ORDER BY user_id DESC";
$result = mysqli_query($con, $query);
$reservationCount = mysqli_num_rows($result);

if ($reservationCount > 0) {
    echo '    <div class="mark-as-all-seen">
    <a href="?markAsSeen=1?">Mark all as seen</a>
    </div>';

    while ($row = mysqli_fetch_array($result)) {
        $backgroundColor = ($row['status'] == 'Approved');
        echo '<div class="clickable-row" data-reservation-id="' . $row['reservation_id'] . $backgroundColor . '; padding: 5px; margin-bottom: 5px;">
        <span>ID ' . $row['reservation_id'] . '</span><br>
        <span>Your reservation has been ' . $row['status'] . '</span><br>
        <span> ' . date('Y-m-d H:i:s') . '</span>
        </div>';
    }
} else {
    echo '<div class="no-notifications"><span>No notifications from the admin</span></div>';
}
?>




<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</div>

                  </div>
            <?php
$CurrentUser =  $_SESSION['customer_id'];
$sql = "SELECT * FROM customer WHERE customer_id = '$CurrentUser'";
$customer_id = $con->query($sql) or die ($con->error);
$row = $customer_id->fetch_assoc();
   ?>
  
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                <span class="mr-2 d-none d-lg-inline text-gray-600 small text-capitalize" >
                <?php echo $row['firstname']  ?>  <?php echo $row['lastname']  ?>
                <?php
$profileImage = !empty($row['img']) && file_exists('upload/' . $row['img']) ? 'upload/' . $row['img'] : 'img/user-img.png';
?>
<img class="img-profile rounded-circle" src="<?php echo $profileImage; ?>" alt="Profile Image">
              </a>

            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current profile.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="#" method="POST" onsubmit="return false;"> 
    <button type="submit" name="logout_btn" class="btn btn-primary" onclick="logout()">Logout</button>
</form>
          <script>
        function logout() {
            // Perform logout actions with JavaScript
            // For example, you can clear client-side session-related data

            // Redirect to the login page
            window.location.href = '../log-in.php';
        }
    </script>


        </div>
      </div>
    </div>
  </div>
  <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Rest of your code
?>
  <?php
} else {
    header("Location: ../");
    exit();
}
?>
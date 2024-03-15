<?php

require '../connection.php';

if (isset($_SESSION['admin_id']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
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

<!-- Nav Item - Dashboard -->
<li class="nav-item ">
  <a class="nav-link" href="dashboard.php" id="nav-link-dashboard">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<li class="nav-item">
  <a class="nav-link" href="admin_profile.php" id="nav-link-admin">
    <i class="fas fa-user"></i>
    <span>List of Admin</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="customer_account.php" id="nav-link-customer">
    <i class="fas fa-users"></i>
    <span>List of Customer</span></a>
</li>


<!-- Reservation -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities" id="nav-link-reservation">
  <i class="fas fa-calendar-alt"></i>
    <span>Reservation</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="pending.php">List of Pending</a>
      <a class="collapse-item" href="approve.php">List of Approved</a>
      <a class="collapse-item" href="reject.php">List of Rejected</a>
    </div>
  </div>
</li>


<!-- Expense - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" id="nav-link-expense">
    <i class="fas fa-tag"></i>
    <span>Expense</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="add_expense.php">Add Expenses</a>
      <a class="collapse-item" href="expense.php">Manage Expenses</a>
    </div>
  </div>
</li>

<!-- Income - Pages Collapse Menu -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages" id="nav-link-income">
    <i class="fas fa-money-bill"></i>
    <span>Income</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="add_income.php">Add Income</a>
      <a class="collapse-item" href="income.php">Manage Income</a>
  </div>
</li>


<li class="nav-item">
  <a class="nav-link" href="queries.php" id="nav-link-queries">
    <i class="fa fa-address-book"></i>
    <span>Queries</span></a>
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
     
  <div class="collapse navbar-collapse" id="navbarNav">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>



          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto" >
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
            </li><?php
$currentUser = $_SESSION['admin_id'];
// Check if the bell icon is clicked for reservations
if (isset($_GET['markAsSeen'])) {
  // Update the 'seen' column to mark reservations as seen
  $updateReservationQuery = "UPDATE reservations SET seen = 1 WHERE status = 'Pending'";
  mysqli_query($con, $updateReservationQuery);

  // Update the 'seen' column to mark contacts as seen
  $updateContactQuery = "UPDATE contact SET seen = 1";
  mysqli_query($con, $updateContactQuery);
}

// Fetch both reservations and contacts in a single query
$combinedQuery = "
    SELECT 'reservation' as type, reservation_id as id, seen FROM reservations WHERE status = 'Pending'
    UNION
    SELECT 'contact' as type, id, seen FROM contact
    ORDER BY id DESC";  // Assuming 'id' is a common field in both tables

$combinedResult = mysqli_query($con, $combinedQuery);

$reservationCount = 0;
$contactCount = 0;

// Check if there are any unseen reservations or contacts
if ($combinedResult) {
    // Check each row for the 'seen' status and update counts
    while ($row = mysqli_fetch_array($combinedResult)) {
      if ($row['seen'] == 0) {
          if ($row['type'] == 'reservation') {
              $reservationCount++;
          } elseif ($row['type'] == 'contact') {
              $contactCount++;
          }
      }
    }
}

// Store the counts in session variables
$_SESSION['reservation_count'] = $reservationCount;
$_SESSION['contact_count'] = $contactCount;

// Sum the counts and store in a new session variable
$_SESSION['total_count'] = $reservationCount + $contactCount;


?>


            
         
            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1" id="alertsDropdown">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" >
    <i title="Notifications" class="fas fa-bell fa-fw" id="reservationCount"></i>
    <span class="count">
    <?php echo $_SESSION['total_count'] = $reservationCount + $contactCount;?> 
</span>
    </a>

              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <span class="dropdown-header" >
        Notifications
    </span>
    <div class="dropdown-content" style="max-height: 300px; overflow-y: auto;">
          
    <?php
$currentUser = $_SESSION['admin_id'];

// Fetch contact notifications
$contactQuery = "SELECT * FROM contact ORDER BY id DESC";
$contactResult = mysqli_query($con, $contactQuery);
$contactCount = mysqli_num_rows($contactResult);

// Fetch reservation notifications
$reservationQuery = "SELECT * FROM reservations WHERE status = 'Pending' ORDER BY reservation_id DESC";
$reservationResult = mysqli_query($con, $reservationQuery);
$reservationCount = mysqli_num_rows($reservationResult);


$sql = "SELECT * FROM customer ";
$customerResult = mysqli_query($con, $sql);
$customerCount = mysqli_num_rows($customerResult);


// Display mark all as seen button for contact notifications
if ($contactCount > 0) {
    echo '<div class="mark-as-all-seen">';
    echo '<a href="?markAsSeen=1">Mark all as seen</a>';
    echo '</div>';
}

// Display contact notifications
while ($contactRow = mysqli_fetch_array($contactResult)) {
    echo '<div class="clickable-row" data-reservation-id="' . $contactRow['id'] . '">';
    echo '<span>Name ' . $contactRow['name'] . '</span><br>';
    echo '<span>Email ' . $contactRow['email'] . '</span><br>';
    echo '<span>Subject ' . $contactRow['subject'] . '</span><br>';
    echo '<span>Message ' . $contactRow['message'] . '</span><br>';
    echo '<span>' . date('Y-m-d H:i:s') . '</span>';
    echo '</div>';
}

// Display reservation notifications
while ($reservationRow = mysqli_fetch_array($reservationResult) and $customerRow = mysqli_fetch_array($customerResult)) {
  echo '<div class="reservation-row" data-reservation-id="' . $reservationRow['reservation_id'] . '">';
  echo '<span>From: ' . $reservationRow['name'] . '</span><br>';
  echo '<span>Pending Reservation </span><br>';
  echo '<span>' . date('Y-m-d H:i:s') . '</span>';
  echo '</div>';
}


// Display a message if there are no notifications
if ($contactCount == 0 && $reservationCount == 0) {
    echo '<div class="no-notifications"><span>No notifications</span></div>';
}
?>

                  </div>
            <!-- Nav Item - Messages -->
            <?php

$CurrentUser =  $_SESSION['admin_id'];
$sql = "SELECT * FROM admin WHERE admin_id = '$CurrentUser'  ";
$admin_id = $con->query($sql) or die ($con->error);
$row = $admin_id->fetch_assoc();
   ?>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  >
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <?php echo $row['firstname']  ?>    <?php echo $row['lastname']  ?>
                </span>
                <?php
// Check if the user has a profile image
$profileImage = !empty($row['img']) && file_exists('upload/' . $row['img']) ? 'upload/' . $row['img'] : 'img/admin-profile.png';
?>
<img class="img-profile rounded-circle" src="<?php echo $profileImage; ?>" alt="Profile Image">
              </a>
              
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php"> 
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
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
} else {
    header("Location: ../");
    exit();
}
?>
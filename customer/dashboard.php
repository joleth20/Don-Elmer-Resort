<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

?>


<head>
    <style>
 .sidebar-dark .nav-item #nav-link-dashboard {
  background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}



    </style>

<script src="js/html2p  f.bundle.min.js"></script>
    <script>
      
      function generatePDF() {
        // Choose the element that our report is rendered in.
        const element = document.getElementById("report");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save();
      }
    </script>

</head>


<!-- Begin Page Content -->
<div class="container-fluid" id="report">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard </h1>
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="generatePDF()"><i
        class="fas fa-download fa-sm text-white-50" ></i> Generate Report</button> 
  </div>

  <!-- Content Row -->
  <div class="row" id="invoice">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Approved Reservation</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
$currentUser = $_SESSION['customer_id']; 

$query = "SELECT * FROM reservations WHERE (status = 'Approved') AND user_id = '$currentUser' ORDER BY user_id ASC";   
$query_run = mysqli_query($con, $query);

$row = mysqli_num_rows($query_run);
echo '<h4><center>' . $row . '</center></h4>';
?>


              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-check fa-2x  text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
   
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Pending Reservation</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
$currentUser = $_SESSION['customer_id'];

$query = "SELECT * FROM reservations WHERE user_id = '$currentUser' AND status = 'pending' ORDER BY reservation_id ASC";
$query_run = mysqli_query($con, $query);
$row = mysqli_num_rows($query_run);

echo '<h4><center>' . $row . '</center></h4>';
?>

              </div>
            </div>
            <div class="col-auto">
            <i class="fas fa-spinner fa-2x  text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>




        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Rejected Reservation</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
$currentUser = $_SESSION['customer_id'];

$query = "SELECT * FROM reservations WHERE user_id = '$currentUser' AND status = 'Reject' ORDER BY reservation_id ASC";
$query_run = mysqli_query($con, $query);
$row = mysqli_num_rows($query_run);

echo '<h4><center>' . $row . '</center></h4>';
?>

              </div>
            </div>
            <div class="col-auto">
            <i class="fas fa-spinner fa-2x  text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>




    </div>




</div>

</div>
    


    
    

     







<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
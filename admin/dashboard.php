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

.easypiechart{
  font-size: 24px;
  display:flex;
  justify-content:center;
}

.canvasjs-chart-canvas{
  border-radius:0.35rem;
}

    </style>

<script src="js/html2pdf.bundle.min.js"></script>
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
    <h1 class="h3 mb-0 text-gray-800">Monitoring </h1>
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="generatePDF()"><i
        class="fas fa-download fa-sm text-white-50" ></i> Generate Report</button> 
  </div>

  <!-- Content Row -->
  <div class="row" id="invoice">

    <!-- Admin row -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Admin Account</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                
                $query = "SELECT admin_id FROM admin ORDER BY admin_id";  
                $query_run = mysqli_query($con, $query);
                $row = mysqli_num_rows($query_run);
                echo '<h4>  <center>'.$row.'<center></h4>';
            ?>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Customers Account</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                
                $query = "SELECT customer_id FROM customer ORDER BY customer_id";  
                $query_run = mysqli_query($con, $query);
                $row = mysqli_num_rows($query_run);
                echo '<h4>  <center>'.$row.'<center></h4>';
            ?>
              </div>
            </div>
            <div class="col-auto">
            <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Approved Reservation</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                
                $query = "SELECT * FROM reservations WHERE status = 'approved' ORDER BY reservation_id ASC";
                $query_run = mysqli_query($con, $query);
                $row = mysqli_num_rows($query_run);
                echo '<h4>  <center>'.$row.'<center></h4>';
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
                
                $query = "SELECT * FROM reservations WHERE status = 'pending' ORDER BY reservation_id ASC";  
                $query_run = mysqli_query($con, $query);
                $row = mysqli_num_rows($query_run);
                echo '<h4>  <center>'.$row.'<center></h4>';
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

     <!-- Expense and Income -->
     <div class="col-xl-3 col-md-6 mb-4"  style="height: 300px; width:700px;">
      <div class="card border-left-primary shadow h-100 py-2"  style="height: 300px; width:700px;">
<!-- Most high expense Expense -->
   
   <section>
   <?php

require "../connection.php";
mysqli_select_db($con, "resortdb");


$test=array ();


$count=0;
$res= mysqli_query($con, "SELECT * FROM tblexpense");
while($row=mysqli_fetch_array($res))
{
       $test[$count] ["label"] = $row["ExpenseItem"];
       $test[$count] ["y"] = $row["ExpenseCost"];
       $count=$count+1;
}

?>

<html>
<head>
<script>
window.onload = function () {
 
var chart1 = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "MOST HIGH EXPENSE"
	},

	data: [{
		type: "column",
		dataPoints: <?php echo json_encode($test, JSON_NUMERIC_CHECK); ?>
	}]
});
chart1.render();
 
}
</script>
</head>
<body>
<div id="chartContainer1" style="height: 300px; width:700px;  "></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>          
</section>
<!-- end -->
      </div>
    </div>





    </div>

     <!-- Income Card -->
     <div class="col-xl-3 col-md-6 mb-4"  style="height: 300px; width:1050px; margin-left:-10px">
      <div class="card border-left-primary shadow h-100 py-2"  style="height: 300px; width:700px;">
<!-- Most high expense Expense -->
     
<?php

require "../connection.php";

?>

<?php
$query = "SELECT * FROM tblincome";
$result = mysqli_query($con, $query);

?>




<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['account', 'amount'],
         <?php 
            

			while($chart = mysqli_fetch_assoc($result))

			{

               echo " ['".$chart['account']."',".$chart['amount']."],";

			}

?>
        ]);

        var options = {
          title: 'DAILY INCOME',
          is3D: true,
          titleTextStyle: {
    color: '#3a3b45',      
    fontSize: 22,   
    fontFamily: 'Nunito,-apple-system,BlinkMacSystemFont,', 
    lineHeight:1.5,  
    align: 'center',   
         
           
  }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
        
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="height: 300px; width:700px;"></div>
  </body>
</html>

<!-- end -->



</div>


    </div>




</div>

</div>
    


    
    

     







<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
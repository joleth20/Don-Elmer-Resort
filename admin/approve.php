<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

require "../connection.php";



error_reporting(0);


if(isset($_POST['delete_btn'])) {
    $reservation_id = $_POST['delete_id'];
    $query = "DELETE FROM reservations WHERE reservation_id = '$reservation_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        $_SESSION['status'] = "Approve has been deleted!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['reservationSuccess']);

        // Unset or remove the reservation_made session variable
unset($_SESSION['reservation_made']);

// After unsetting, you might want to set it to false, depending on your logic
$reservationMade = false;

    } else {
        $_SESSION['status'] = "Your Reservation cannot be canceled because admin has already approved!";
        $_SESSION['status_code'] = "error";
    }
}


$records_per_page = 10;

// Determine the current page number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}

// Calculate the offset for the query
$offset = ($page - 1) * $records_per_page;



// Display pagination links

$total_pages_query = "SELECT COUNT(*) FROM admin";
$total_pages_result = mysqli_query($con, $total_pages_query);
$total_records = mysqli_fetch_array($total_pages_result)[0];
$total_pages = ceil($total_records / $records_per_page);




?>

<?php
            // Assuming $date contains the date in a format like 'm/d/Y'
            $formattedDate = !empty($date) ? date('Y-m-d', strtotime($date)) : '0000-00-00';
        ?>

<!DOCTYPE html>
<html>
<head>
    
<!-- Add these script tags to include jsPDF and html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>



<script>  
function exportTableToExcel(dataTable, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(dataTable);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
 </script>

<script src="js/html2pdf.bundle.min.js"></script>
    <script>
      
      function generatePDF() {
        // Choose the element that our pdf is rendered in.
        const element = document.getElementById("pdf");
        // Choose the element and save the PDF for our user.
        html2pdf()
          .from(element)
          .save();
      }
    </script>


    <style>
 .sidebar-dark .nav-item #nav-link-reservation {
    background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

#action{
    display:flex;
    align-items:center;
    justify-content: center;
    gap:5px;
    flex-wrap: nowrap;
}


td{
    text-align:center;
}

.pagination {
        display: flex;
        list-style: none;
        padding: 0;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        color: #007bff;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #ddd;
        margin: 0 4px;
        cursor: pointer;
    }

    .pagination a:hover {
        background-color: #007bff;
        color: #fff;
    }

    .pagination .active {
        background-color: #007bff;
        color: #fff;
    }

   </style>



</head>

<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <div class="d-sm-flex align-items-center  mb-4" style="gap:20px">
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="generatePDF()"><i
        class="fas fa-download fa-sm text-white-50" ></i> Import PDF</button> 
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="exportTableToExcel('dataTable', 'members-data')">Import CSV</button> 
        
  </div>
            <h6 class="m-0 font-weight-bold text-primary">Reservation Approved of Customers</h6>
        </div>
        <div class="row" id="pdf">
        <div class="card-body">
     <div class="table-responsive">
            <?php
                        // Sorting

$sort = "DESC";
$column = "reservation_id";

if (isset($_GET['column']) && isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $column = $_GET['column'];

    $sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC';

}

$query = "SELECT * FROM reservations ORDER BY $column $sort ";
$query_run = mysqli_query($con, $query);

// End Sorting
                        
 $con = new mysqli($host, $username, $password, $dbname);
                  
            ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><center><a href="?column=reservation_id&sort=<?php echo $sort?>">Reservation ID</a><center></th>
                        <th><center><a href="?column=name&sort=<?php echo $sort?>">Username</a><center></th>
                        <th><center><a href="?column=number&sort=<?php echo $sort?>">Phone No.</a><center></th>
            <th><center><a href="?column=status&sort=<?php echo $sort?>">Status</a><center></th>

            <th><center>Actions<center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT * FROM reservations WHERE status = 'approved' ORDER BY reservation_id ASC";    
                           $result = mysqli_query($con, $query);
                           while($row = mysqli_fetch_array($result)){                   
                        ?>
                            <tr>
                            <td><center><?php  echo $row['reservation_id']; ?><center></td>
                            <td><center><?php  echo $row['name']; ?><center></td>
                            <td><center><?php  echo $row['number']; ?><center></td>
                                <td><center><?php  echo $row['status']; ?><center></td>
                      
                     
                                <td id="action">
                <form action="approve.php" method="post">
                <input type="hidden" name="delete_id" value="<?php echo $row['reservation_id']; ?>">
                    <button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                </form>
                 <form action="approved-view.php" method="post" >
    <input type="hidden" name="reservation_id" value="<?php echo $row['reservation_id']; ?>">
    <button title="View All" name="approved_btn" type="submit" class="btn btn-primary" >
        <i class="fa fa-eye" aria-hidden="true"></i>
    </button>
                           </form>
                    
            </td>
        </tr>

                            <?php
                            } 
                        ?>       
                        
                        
 <!-- Pagination -->
 <?php

    
if (!isset($_GET['search']) && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
        <td><center><?php echo $row['reservation_id']; ?></center></td>
            <td><center><?php echo $row['name']; ?></center></td>
            <td><center><?php echo $row['number']; ?></center></td>
            <td><center><?php echo $row['status']; ?></center></td>
            
            <td id="actions">
            <form action="approve.php" method="post">
                <input type="hidden" name="delete_id" value="<?php echo $row['reservation_id']; ?>">
                    <button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                </form>
                 <form action="approved-view.php" method="post" >
    <input type="hidden" name="reservation_id" value="<?php echo $row['reservation_id']; ?>">
    <button title="View All" name="approved_btn" type="submit" class="btn btn-primary" >
        <i class="fa fa-eye" aria-hidden="true"></i>
    </button>
                </form>
            </td>
        </tr>
    <?php
    }
} elseif (!isset($_GET['search'])) {
    // No records found without search
    ?>
    <tr>
        <td colspan="5">No records found</td>
    </tr>
<?php
}
?>
      
                        
                    </tbody>
                </table>

                         <!-- Pagination links -->
<?php
if (!isset($_GET['search'])) {
    echo '<div class="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<a href="?column=' . $column . '&sort=asc&page=' . $i . '">' . $i . '</a>';
    }
    echo '</div>';
}
?>
<!-- end pagination -->


            </div>
        </div>
    </div>
    </div>
</div>

</html>



<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
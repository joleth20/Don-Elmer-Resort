<?php
include('includes/header.php'); 
include('includes/navbar.php'); 


if(isset($_POST['delete_btn'])) {
    $reservation_id = $_POST['delete_id'];
    $query = "DELETE FROM reservations WHERE reservation_id = '$reservation_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        $_SESSION['status'] = " Your Rejected Reservation has been Deleted!";
        $_SESSION['status_code'] = "success";


// After unsetting, you might want to set it to false, depending on your logic
$reservationMade = false;

    } else {
        $_SESSION['status'] = "Your reservation cannot be delete because admin has already approved!";
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
$total_pages_query = "SELECT COUNT(*) FROM reservations WHERE status = 'Reject' AND user_id = '$currentUser'";
$total_pages_result = mysqli_query($con, $total_pages_query);
$total_records = mysqli_fetch_array($total_pages_result)[0];
$total_pages = ceil($total_records / $records_per_page);


?>

<!DOCTYPE html>
<html>
<head>
    
<!-- Add these script tags to include jsPDF and html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


    <style>

 .sidebar-dark .nav-item #nav-link-status {
    background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}
.card-header.py-3{
  display:flex;
   justify-content:space-around;
   flex-wrap:wrap;
}
th{
    text-align:center;
}

td{
    text-align:center;
}


#actions{
    display:flex;
    align-items:center;
    justify-content: center;
    gap:5px;
    flex-wrap: nowrap;
}


.btn.btn-primary{
    z-index: 0;
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
            &nbsp;
                      <!-- Topbar Search -->
          <form action="" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" name="search" value="<?php if(isset($_POST['search'])){echo $_POST['search'];} ?>" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="card-body">
        <div class="table-responsive">
        
        <?php
        // Sorting
        $sort = "ASC";
        $column = "reservation_id";
    
        if (isset($_GET['column']) && isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $column = $_GET['column'];
    
            $sort = ($sort == 'ASC') ? 'DESC' : 'ASC';
        }
    
        $currentUser = $_SESSION['customer_id'];
    
        // Initialize $con before using it in the query
        $con = new mysqli($host, $username, $password, $dbname);
    
        // Get the total number of records for pagination
        $total_pages_query = "SELECT COUNT(*) FROM reservations WHERE status = 'Reject' AND user_id = '$currentUser'";
        $total_pages_result = mysqli_query($con, $total_pages_query);
        $total_records = mysqli_fetch_array($total_pages_result)[0];
        $total_pages = ceil($total_records / $records_per_page);
    
        // Determine the current page number
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
    
        
    
        // Calculate the offset for the query
        $offset = ($page - 1) * $records_per_page;
    
        // Modify your existing query to include LIMIT and OFFSET
        $query = "SELECT * FROM reservations WHERE status = 'Reject' AND user_id = '$currentUser' ORDER BY $column $sort LIMIT $offset, $records_per_page";
        $result = mysqli_query($con, $query);
        ?>
    <!-- Header Table -->
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th><center><a href="?column=reservation_id&sort=<?php echo $sort ?>">Reservation ID</a></center></th>
                <th><center><a href="?column=name&sort=<?php echo $sort ?>">Username</a></center></th>
                <th><center><a href="?column=number&sort=<?php echo $sort ?>">Phone No.</a></center></th>
                <th><center><a href="?column=status&sort=<?php echo $sort ?>">Status</a></center></th>
                <th><center>Action</center></th>
            </tr>
        </thead>
        <tbody>
    <!-- End Header Table -->
    
        <!-- Search function -->
        <?php
        $con = new mysqli($host, $username, $password, $dbname);
        if (isset($_GET['search'])) {
            $filtervalues = $_GET['search'];
            $currentUser = $_SESSION['customer_id'];

            $query = "SELECT * FROM reservations WHERE user_id = '$currentUser' AND CONCAT(reservation_id, name, number) LIKE '%$filtervalues%' ";
            $query_run = mysqli_query($con, $query);
    
            if (mysqli_num_rows($query_run) > 0) {
                while ($items = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <tr>
                        <td><center><?= $items['reservation_id']; ?></center></td>
                        <td><center><?= $items['name']; ?></center></td>
                        <td><center><?= $items['number']; ?></center></td>
                        <td><center><?= $items['status']; ?></center></td>
    
                        <td id="actions">
                            <form action="reject.php" method="post">
                                <input type="hidden" name="delete_id" value="<?php echo $items['reservation_id']; ?>">
                                <button title="Delete" type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                            </form>
                            <form action="reject-view.php" method="post">
                                <input type="hidden" name="reservation_id" value="<?php echo $items['reservation_id']; ?>">
                                <button title="View All" name="approved_btn" type="submit" class="btn btn-primary">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
            } else {
                // No records found for the search
                ?>
                <tr>
                    <td colspan="6">No Records Found</td>
                </tr>
            <?php
            }
        }
    
        ?>
        <!-- end search -->
    
        <!-- Pagination -->
        <?php
    
        
        if (!isset($_GET['search']) && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['reservation_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['number']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td id="actions">
                        <form action="reject.php" method="post">
                            <input type="hidden" name="delete_id" value="<?php echo $row['reservation_id']; ?>">
                            <button title="Delete" type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                        </form>
                        <form action="reject-view.php" method="post">
                            <input type="hidden" name="reservation_id" value="<?php echo $row['reservation_id']; ?>">
                            <button title="View All" name="approved_btn" type="submit" class="btn btn-primary">
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
                <td colspan="6">No records found</td>
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


</html>




<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>


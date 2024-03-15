<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

require "../connection.php";


if(isset($_POST['delete_queries']))
{
$id = $_POST['delete_id'];
$query = "DELETE FROM contact WHERE id = '$id' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['status'] = "Query record successfully Deleted";
    $_SESSION['status_code'] = "success";
  
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
$total_pages_query = "SELECT COUNT(*) FROM contact";
$total_pages_result = mysqli_query($con, $total_pages_query);
$total_records = mysqli_fetch_array($total_pages_result)[0];
$total_pages = ceil($total_records / $records_per_page);

// Your original query with the LIMIT clause
$query = "SELECT * FROM contact ORDER BY id ASC LIMIT $offset, $records_per_page";
$query_run = mysqli_query($con, $query);


?>

<head>


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
 .sidebar-dark .nav-item #nav-link-queries {
    background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

.card-header.py-3{
  display:flex;
  align-items:center;
   justify-content:space-around;
   flex-wrap:wrap;
}

th{
    text-align:center;
}
td{
    text-align:center;
}
td:nth-child(6){
    display:flex;
    justify-content:center;
    gap:10px;
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
            
            <h6 class="m-0 font-weight-bold text-primary">Manage Queries</h6>
            <div class="d-sm-flex align-items-center  mb-4" style="gap:20px">
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="generatePDF()"><i
        class="fas fa-download fa-sm text-white-50" ></i> Import PDF</button> 
        <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="exportTableToExcel('dataTable', 'members-data')">Import CSV</button> 
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
        </div>
        <div class="row" id="pdf">
        <div class="card-body">
            <div class="table-responsive">
        
        <?php
        // Sorting
        $sort = "ASC";
        $column = "id";
    
        if (isset($_GET['column']) && isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            $column = $_GET['column'];
    
            $sort = ($sort == 'ASC') ? 'DESC' : 'ASC';
        }

    
        // Initialize $con before using it in the query
        $con = new mysqli($host, $username, $password, $dbname);
    
        // Get the total number of records for pagination
        $total_pages_query = "SELECT COUNT(*) FROM contact ";
        $total_pages_result = mysqli_query($con, $total_pages_query);
        $total_records = mysqli_fetch_array($total_pages_result)[0];
        $total_pages = ceil($total_records / $records_per_page);
    
        // Determine the current page number
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
    
        
    
        // Calculate the offset for the query
        $offset = ($page - 1) * $records_per_page;
    
        // Modify your existing query to include LIMIT and OFFSET
        $query = "SELECT * FROM contact ORDER BY $column $sort LIMIT $offset, $records_per_page";
        $result = mysqli_query($con, $query);
        ?>
    <!-- Header Table -->
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
            <th><a href="?column=id&sort=<?php echo $sort?>">ID</a></th>
                        <th><a href="?column=name&sort=<?php echo $sort?>">Name</a></th>
                        <th><a href="?column=email&sort=<?php echo $sort?>">Email</a></th>
                       <th><a href="?column=subject&sort=<?php echo $sort?>">Subject</a></th>
                       <th><a href="?column=message&sort=<?php echo $sort?>">Message</a></th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <!-- End Header Table -->
    
       <!-- Search function -->
        <?php
        $con = new mysqli($host, $username, $password, $dbname);
        if (isset($_GET['search'])) { 
            $filtervalues = $_GET['search'];
            $query = "SELECT * FROM contact WHERE CONCAT(id, name, email, subject, message) LIKE '%$filtervalues%' ";
            $query_run = mysqli_query($con, $query);
    
            if (mysqli_num_rows($query_run) > 0) {
                while ($items = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <tr>
                        <td><center><?= $items['id']; ?></center></td>
                        <td><center><?= $items['name']; ?></center></td>
                        <td><center><?= $items['email']; ?></center></td>
                        <td><center><?= $items['subject']; ?></center></td>
                        <td><center><?= $items['message']; ?></center></td>
    
                        <td id="actions">
                        <form action="queries.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $items['id']; ?>">
                                        <button type="submit" name="delete_queries" class="btn btn-danger"> DELETE</button>
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
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td id="actions">
                    <form action="queries.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_queries" class="btn btn-danger"> DELETE</button>
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
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

require "../connection.php";


// Delete Search

if(isset($_POST['delete_search']))
{
$admin_id = $_POST['delete_id'];
$query = "DELETE FROM admin WHERE admin_id='$admin_id' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['status'] = "Your Data is Deleted";
    $_SESSION['status_code'] = "success";
 
}
else
{
    $_SESSION['status'] = "Your Data is NOT DELETED";
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

<head>
    <style>
 .sidebar-dark .nav-item #nav-link-admin {
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

#actions{
    display:flex;
    justify-content:center;
    gap:10px;
}


#actions{
    display:flex;
    justify-content:center;
    gap:10px;
}

.form-group-pass{
    margin:20px 0;
        display:flex;
        justify-content: flex-end;        
    }

    #eyeicon{
        height: 22px;
        width: 22px;
        margin:5px 15px;;
        position:absolute;
    }

    td:nth-child(7){
    display:flex;
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
    $column = "admin_id";

    if (isset($_GET['column']) && isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        $column = $_GET['column'];

        $sort = ($sort == 'ASC') ? 'DESC' : 'ASC';
    }



    // Initialize $con before using it in the query
    $con = new mysqli($host, $username, $password, $dbname);

    // Get the total number of records for pagination
    $total_pages_query = "SELECT COUNT(*) FROM admin ";
    $total_pages_result = mysqli_query($con, $total_pages_query);
    $total_records = mysqli_fetch_array($total_pages_result)[0];
    $total_pages = ceil($total_records / $records_per_page);

    // Determine the current page number
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

    

    // Calculate the offset for the query
    $offset = ($page - 1) * $records_per_page;

    // Modify your existing query to include LIMIT and OFFSET
    $query = "SELECT * FROM admin ORDER BY $column $sort LIMIT $offset, $records_per_page";
    $result = mysqli_query($con, $query);
    ?>
<!-- Header Table -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
            <th><a href="?column=admin_id&sort=<?php echo $sort?>"> Admin ID</a></th>
            <th><a href="?column=firstname&sort=<?php echo $sort?>">Firstname</a></th>
            <th><a href="?column=lastname&sort=<?php echo $sort?>">Lastname</a></th>
            <th><a href="?column=email&sort=<?php echo $sort?>">Email</a></th>
            <th><a href="?column=created_at&sort=<?php echo $sort?>">Created_at</a></th>
            <th>ACTION </th>
                        </tr>
                    </thead>
                    <tbody>
<!-- End Header Table -->

    <!-- Search function -->
    <?php
    $con = new mysqli($host, $username, $password, $dbname);
    if (isset($_GET['search'])) {
        $filtervalues = $_GET['search'];
        $query = "SELECT * FROM admin WHERE CONCAT(admin_id, firstname, lastname, email, created_at) LIKE '%$filtervalues%' ";
        $query_run = mysqli_query($con, $query);

        if (mysqli_num_rows($query_run) > 0) {
            while ($items = mysqli_fetch_assoc($query_run)) {
                ?>
                <tr>
                    <td><center><?= $items['admin_id']; ?></center></td>
                    <td><center><?= $items['firstname']; ?></center></td>
                    <td><center><?= $items['lastname']; ?></center></td>
                    <td><center><?= $items['email']; ?></center></td>
                    <td><center><?= $items['created_at']; ?></center></td>

                    <td id="actions">
                                    <form action="admin_profile.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $items['admin_id']; ?>">
                                        <button type="submit" name="delete_search" class="btn btn-danger"> DELETE</button>
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
                <td><center><?php echo $row['admin_id']; ?></center></td>
                <td><center><?php echo $row['firstname']; ?></center></td>
                <td><center><?php echo $row['lastname']; ?></center></td>
                <td><center><?php echo $row['email']; ?></center></td>
                <td><center><?php echo $row['created_at']; ?></center></td>
                
                <td id="actions">
   
                                    <form action="admin_profile.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['admin_id']; ?>">
                                        <button type="submit" name="delete_search" class="btn btn-danger"> DELETE</button>
                                    </form>
                    </form>
                </td>
            </tr>
        <?php
        }
    } elseif (!isset($_GET['search'])) {
        // No records found without search
        ?>
        <tr>
            <td colspan="6">No records found.</td>
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

<script >

// Hide and Show Password

let eyeicon = document.querySelector('#eyeicon');
let password = document.querySelector('#password');


eyeicon.onclick = function(){
    if(password.type == "password"){
        password.type = "text";
        eyeicon.src = "img/open-eye.png";
    }else{
        password.type = "password";
        eyeicon.src = "img/eye-close.png";
    }
}
</script>


<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
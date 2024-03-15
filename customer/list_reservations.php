<?php
include('includes/header.php'); 
include('includes/navbar.php'); 


if(isset($_POST['delete_btn'])) {
    $reservation_id = $_POST['delete_id'];
    $query = "DELETE FROM reservations WHERE reservation_id = '$reservation_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run) {
        $_SESSION['status'] = "Your Reservation is Canceled!";
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
?>

<!DOCTYPE html>
<html>
<head>
    
<!-- Add these script tags to include jsPDF and html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


    <style>
 .sidebar-dark .nav-item #nav-link-manage {
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


.card-body {
    overflow-y: auto;
}

#myBtn:hover{
    text-decoration: underline;
}

.modal-content{
    z-index: 100;
    display:grid;
    grid-column-gap: 30px;
    grid-template-areas:"1fr 1fr 1fr 1fr" ;
    grid-auto-flow:column;
}


.modal-content .close:hover{
    color:#FEA116;
}


    

    
/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
    width:25px;
    height:25px;
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
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

$sort = "DESC";
$column = "customer_id";

if (isset($_GET['column']) && isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $column = $_GET['column'];

    $sort == 'ASC' ? $sort = 'ASC' : $sort = 'DESC';

}


$currentUser = $_SESSION['customer_id'];
$query = "SELECT * FROM reservations WHERE (status = 'Approved' OR status = 'Pending') AND user_id = '$currentUser' ORDER BY user_id ASC";
$result = mysqli_query($con, $query);

$row = mysqli_fetch_array($result);
// End Sorting
                
                        $con = new mysqli($host, $username, $password, $dbname);
         
            ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th><center><a href="?column=name&sort=<?php echo $sort?>">Username</a><center></th>
                        <th><center><a href="?column=number&sort=<?php echo $sort?>">Phone No.</a><center></th>
                        <th><center><a href="?column=user_id&sort=<?php echo $sort?>">Costumer ID</a><center></th>
            <th><center><a href="?column=status&sort=<?php echo $sort?>">Status</a><center></th>
            <th><center>Action<center> </th>
                        </tr>
                    </thead>
                    <tbody>



                    <?php
$currentUser = $_SESSION['customer_id'];
$query = "SELECT * FROM reservations WHERE (status = 'Approved' OR status = 'Pending') AND user_id = '$currentUser' ORDER BY user_id ASC";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['number']; ?></td>
            <td><?php echo $row['user_id']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td id="actions">

                <form action="list_reservations.php" method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['reservation_id']; ?>">
                    <button title="Cancel" type="submit" name="delete_btn" class="btn btn-danger">CANCEL</button>
                </form>
                  <button id="myBtn" title="View All" type="submit" name="view" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i></button>
            </td>
        </tr>
<?php
    } 
}
?>

<!-- The Modal -->
<div id="mymodal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <!-- Close button -->
  <span class="close" onclick="closeModal()">&times;</span>
                      <?php
$query = "SELECT * FROM reservations WHERE status IN ('Pending', 'Approved') ORDER BY reservation_id ASC";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
?>
     
     <div class="box-1">
       <h1>Reservation</h1>
       <label for="basic-url" class="form-label fw-bold">Reservation ID</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['reservation_id']; ?>"  readonly></div>
       <label for="basic-url" class="form-label fw-bold">Username</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['name']; ?>"  readonly></div>
       <label for="basic-url" class="form-label fw-bold">Phone No.</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['number']; ?>"  readonly></div>
       <label for="basic-url" class="form-label fw-bold">Check IN</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['DATE']; ?>"  readonly></div>
       <label for="basic-url" class="form-label fw-bold">Check OUT</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['check_out_date']; ?>"  readonly></div>
       <label for="basic-url" class="form-label fw-bold">Guest</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['num_guests']; ?>"  readonly></div>
       <label for="basic-url" class="form-label fw-bold">Status</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['status']; ?>"  readonly></div>
     </div>
      <div class="box-2">
          <h1>Payment</h1>
       <label for="basic-url" class="form-label fw-bold">Payment Method</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['paymentMethod']; ?>"  readonly></div>
       <label for="basic-url" class="form-label fw-bold">Reference Number</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['referenceNumber']; ?>"  readonly></div>
       <label for="basic-url" class="form-label fw-bold">Image Proof</label><br>
       <img src="../customer/upload/<?php echo $row['imageProof']; ?>" alt="image" width="200px;" height="200px;"><br>
       <label for="basic-url" class="form-label fw-bold">Accomodation Type</label>
       <div class="input-group"><input type="text" class="form-control" value="<?php echo $row['accommodationType']; ?>"  readonly></div>

      </div>
 



  <?php
  } 
}
?>
  </div>

</div>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>


</html>

<script>
// Get the modal
var modal = document.getElementById("mymodal");


// Function to close the modal
function closeModal() {
var modal = document.getElementById("mymodal");
modal.style.display = "none";
document.body.style.overflow = "auto"; // Enable scrolling
}

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close");

// When the user clicks the button, open the modal
btn.onclick = function() {
modal.style.display = "block";
document.body.style.overflow = "hidden"; // Disable scrolling
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
modal.style.display = "none";
document.body.style.overflow = "auto"; // Enable scrolling
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal) {
modal.style.display = "none";
document.body.style.overflow = "auto"; // Enable scrolling
}
}


</script>


<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>


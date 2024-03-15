<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<head>
    <style>
 .sidebar-dark .nav-item #nav-link-status {
    background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

#reservation-payment{
    display:flex;
    gap:60px;
   
}
 
    
    </style>

</head>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> View All </h6>
        </div>
        <div class="card-body">
        <?php
        
        $con =  mysqli_connect($host, $username, $password, $dbname);

        if(isset($_POST['approved_btn']))
        {
            $reservation_id = $_POST['reservation_id'];
            $query = "SELECT * FROM reservations WHERE reservation_id ='$reservation_id' ";

            $query_run = mysqli_query($con, $query);

            foreach($query_run as $row)
            {
                ?>

                        <form action="#" method="POST" id="reservation-payment">

                        <input type="hidden" name="user_id" value="<?php echo $row['reservation_id'] ?>">
                        <div class="box-1">
                                <h3>Reservation</h3>
                            <div class="form-group">
                            <label for="Firstname" class="form-label"> UserName</label>
                                    <input type="text" value="<?php echo $row['name']  ?>" class="form-control text-capitalize" 
                                       readonly>
            </div>
            <div class="form-group">
            <label for="Lastname" class="form-label">Phone No.</label>
                                    <input type="text"  value="<?php echo $row['number']  ?>"  class="form-control text-capitalize"  readonly>
            </div>
            <div class="form-group">
            <label for="number" class="form-label">Customer ID</label>
                                    <input type="number"  value="<?php echo $row['user_id']  ?>"  class="form-control text-capitalize" readonly>
            </div>
            <div class="form-group">
            <label for="Email" class="form-label">Check in Date</label>
                                    <input type="email"  value="<?php echo $row['DATE']  ?>"  class="form-control" readonly>
            </div>
            <label for="Guest" class="form-label">Guest</label>
            <div class="form-group-pass">
            <input type="text"  value="<?php echo $row['num_guests']  ?>"  class="form-control"  readonly>   
        </div>
        <br>
            <label for="Email" class="form-label">Check out Date</label>
            <div class="form-group-pass">
            <input type="text"  value="<?php echo $row['check_out_date']  ?>"  class="form-control"   readonly>   
        </div>
        <br>
        <a href="approve.php" class="btn btn-danger"> BACK </a>
        </div>
        
        <div class="box-2">
        <h3>Payment</h3>
                            <div class="form-group">
                            <label for="Firstname" class="form-label"> Status</label>
                                    <input type="text" value="<?php echo $row['status']  ?>" class="form-control text-capitalize" 
                                       readonly>
            </div>
            <div class="form-group">
            <label for="Lastname" class="form-label">Payment Method</label>
                                    <input type="text"  value="<?php echo $row['paymentMethod']  ?>"  class="form-control text-capitalize" readonly>
            </div>
            <div class="form-group">
            <label for="number" class="form-label">Reference Number</label>
                                    <input type="number"  value="<?php echo $row['referenceNumber']  ?>"  class="form-control text-capitalize"  readonly>
            </div>
            <label for="Email" class="form-label">Accomodation Type</label>
            <div class="form-group-pass">
            <input type="text"  value="<?php echo $row['accommodationType']  ?>"  class="form-control"  readonly>   
        </div>
            
        </div>
     <div class="box-3">
     <div class="form-group">
            <label for="Email" class="form-label">Image Proof Payment</label>
            <br>
            <img src="../customer/upload/<?php echo $row['imageProof']; ?>" alt="image" width="450px;" height="450px;">
            </div>
     </div>
                         
                        </form>
                        <?php
                }
            }
        ?>
        </div>
    </div>
</div>

</div>


</script>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
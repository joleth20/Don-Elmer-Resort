<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<head>
    <style>
 .sidebar-dark .nav-item #nav-link-customer {
    background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

.form-group-pass{
        margin:20px 0;
        display:flex;
        justify-content: flex-end;        
    }

    #eyeicon{
        height: 22px;
        width: 22px;
        margin:8px 15px;;
        position:absolute;
    }

    #password{
        margin-top:-20px;
    }
    </style>

</head>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Customer Profile </h6>
        </div>
        <div class="card-body">
        <?php
        
$con =  mysqli_connect($host, $username, $password, $dbname);

            if(isset($_POST['customer_btn']))
            {
                $customer_id = $_POST['customer_id'];
                $query = "SELECT * FROM customer WHERE customer_id ='$customer_id' ";

                $query_run = mysqli_query($con, $query);

                foreach($query_run as $row)
                {
                    ?>

                        <form action="code_customer.php" method="POST">

                        <input type="hidden" name="customer_id" value="<?php echo $row['customer_id'] ?>">

                            <div class="form-group">
                            <label for="Firstname" class="form-label">First Name</label>
                                    <input type="text" value="<?php echo $row['firstname']  ?>" class="form-control text-capitalize" name="edit_firstname"
                                        id="firstname" placeholder="Enter your first name" readonly>
            </div>
            <div class="form-group">
            <label for="Lastname" class="form-label">Last Name</label>
                                    <input type="text"  value="<?php echo $row['lastname']  ?>"  class="form-control text-capitalize" name="edit_lastname"
                                        id="lastname" placeholder="Enter your last name" readonly>
            </div>
            <div class="form-group">
            <label for="number" class="form-label">Phone Number</label>
                                    <input type="number"  value="<?php echo $row['number']  ?>"  class="form-control text-capitalize" name="edit_number"
                                        id="number" placeholder="Phone No." readonly>
            </div>
            <div class="form-group">
            <label for="Email" class="form-label">Email address</label>
                                    <input type="email"  value="<?php echo $row['email']  ?>"  class="form-control" name="edit_email" id="Email"
                                        placeholder="Email" readonly>
            </div>
                            <a href="customer_account.php" class="btn btn-danger"> CANCEL </a>
                        </form>
                        <?php
                }
            }
        ?>
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


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
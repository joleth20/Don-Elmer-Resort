<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/scripts.php');
require "../connection.php";




if (isset($_POST['updatebtn'])) {
    $customer_id = $_POST['edit_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $cpassword = $_POST['cpassword'];

    // Check if the current password matches
    $current_password_query = "SELECT * FROM customer WHERE customer_id='$customer_id'";
    $current_password_result = mysqli_query($con, $current_password_query);

    if ($current_password_row = mysqli_fetch_assoc($current_password_result)) {
        if (!password_verify($current_password, $current_password_row['password'])) {
            $_SESSION['status'] = "Current Password is incorrect";
            $_SESSION['status_code'] = "error";
            echo '<script>window.location.href="change_password.php"</script>';
            exit();
        }
    } else {
        $_SESSION['status'] = "Error fetching current password";
        $_SESSION['status_code'] = "error";
        echo '<script>window.location.href="change_password.php"</script>';
        exit();
    }

    // Check if new password and confirm password match
    if ($new_password != $cpassword) {
        $_SESSION['status'] = "New Password and Confirm Password do not match";
        $_SESSION['status_code'] = "error";
        echo '<script>window.location.href="change_password.php"</script>';
        exit();
    }

    // Hash the new password
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the customer table with the new hashed password
    $query = "UPDATE customer SET password='$hashed_new_password' WHERE customer_id='$customer_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your Password has been Updated!";
        $_SESSION['status_code'] = "success";
        echo '<script>window.location.href="change_password.php"</script>';
        exit();
    } else {
        $_SESSION['status'] = "Your Password is not Updated!";
        $_SESSION['status_code'] = "error";
        echo '<script>window.location.href="change_password.php"</script>';
        exit();
    }
}

?>


<head>
<style>
     .sidebar-dark .nav-item #nav-link-profile {
  background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

#back{
    background-color:#4E73DF;
    color:white;
    font-size: 16px;
    text-decoration:none;
}


a:hover{
    color:none;
 
 }


    .form-group-pass{
        width:700px;
        margin:0px 0;
        display:flex;
        justify-content: flex-end;        
    }

    #eye_current{
        height: 22px;
        width: 22px;
        margin:8px 15px;;
        position:absolute;
    }

    #eyeicon{
        height: 22px;
        width: 22px;
        margin:8px 15px;;
        position:absolute;
    }

    #eyeicons{
        height: 22px;
        width: 22px;
        margin:8px 15px;;
        position:absolute;
    }

    form{
        padding:30px 60px;
    }

    .form-group{
        width:700px;
    }

</style>

</head>


<body>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Change Password</h6>
        </div>
        <div class="card-body">


        <?php

$currentUser = $_SESSION['customer_id'];

$sql = "SELECT * FROM customer WHERE customer_id = '$currentUser' ";
$customer_id = $con->query($sql) or die ($con->error);
$row = $customer_id->fetch_assoc();
   ?>

                   <form action="change_password.php" method="POST">
    <input type="hidden" name="edit_id" value="<?php echo $row['customer_id']; ?>">

    <!-- Current Password Section -->
    <label for="current_password" class="form-label">Type the current password before changing</label>
    <div class="form-group-pass">
        <input type="password" class="form-control" name="current_password" id="current_password" required>
        <img src="img/eye-close.png" alt="" id="eye_current">
    </div>

    <!-- New Password Section -->
    <label for="new_password" class="form-label">Enter the New Password</label>
    <div class="form-group-pass">
        <input type="password" class="form-control" name="new_password" id="new_password" required>
        <img src="img/eye-close.png" alt="" id="eyeicon">
    </div>

    <!-- Confirm New Password Section -->
    <label for="cpassword" class="form-label">Confirm the New Password</label>
    <div class="form-group-pass">
        <input type="password" class="form-control" name="cpassword" id="cpassword" required>
        <img src="img/eye-close.png" alt="" id="eyeicons">
    </div>
    <br>
    <a   class="btn btn-primary" id="back" href="profile.php">Back</a>
    <button type="submit" name="updatebtn" class="btn btn-primary">Update</button>
</form> 
        </div>
    </div>
</div>

</div>
<script >

// Hide and Show Password
let eyeicon = document.querySelector('#eyeicon');
let password = document.querySelector('#new_password');
let eyeicons = document.querySelector('#eyeicons');
let cpassword = document.querySelector('#cpassword');
let eye_current = document.querySelector('#eye_current');
let current_password = document.querySelector('#current_password');

eyeicon.onclick = function(){
    if(password.type === "password"){
        password.type = "text";
        eyeicon.src = "img/open-eye.png";
    } else {
        password.type = "password";
        eyeicon.src = "img/eye-close.png";
    }
}

eyeicons.onclick = function () {
    if (cpassword.type === "password") {
        cpassword.type = "text";
        eyeicons.src = "img/open-eye.png";
    } else {
        cpassword.type = "password";
        eyeicons.src = "img/eye-close.png";
    }
}

eye_current.onclick = function () {
    if (current_password.type === "password") {
        current_password.type = "text";
        eye_current.src = "img/open-eye.png";
    } else {
        current_password.type = "password";
        eye_current.src = "img/eye-close.png";
    }
}

</script>


</body>






<?php

include('includes/footer.php');
?>
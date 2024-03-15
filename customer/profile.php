<?php
include('includes/header.php');
include('includes/navbar.php');
require "../connection.php";

if (isset($_POST['updatebtn'])) {
    $customer_id = $_POST['edit_id'];
    $firstname = $_POST['edit_firstname'];
    $lastname = $_POST['edit_lastname'];
    $number = $_POST['edit_number'];
    $email = $_POST['edit_email'];

    // Check if an image is uploaded
    if (isset($_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $filetmpname = $_FILES['uploadfile']['tmp_name'];
        $filename = $_FILES['uploadfile']['name'];
        $folder = 'upload/';

        // Move the uploaded image to the specified folder
        move_uploaded_file($filetmpname, $folder . $filename);

        // Update the customer table with the new image
        $query = "UPDATE customer SET firstname='$firstname', lastname='$lastname', number='$number', email='$email', img='$filename' WHERE customer_id='$customer_id'";
    } else {
        // If no new image is uploaded, update without changing the image
        $query = "UPDATE customer SET firstname='$firstname', lastname='$lastname', number='$number', email='$email' WHERE customer_id='$customer_id'";
    }

    // Use prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $_SESSION['status'] = "Your Profile has been Updated";
        $_SESSION['status_code'] = "success";
        echo '<script>window.location.href="profile.php";</script>';
        exit(); // Stop execution after redirection
    } else {
        $_SESSION['status'] = "Your Profile is Not Updated";
        $_SESSION['status_code'] = "error";
        echo '<script>window.location.href="profile.php";</script>';
        exit(); // Stop execution after redirection
    }
}

?>



<head>
<style>
     .sidebar-dark .nav-item #nav-link-profile {
  background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}


    form{
        padding:30px 60px;
        display:flex;
        justify-content: space-between;
    }

    .form-group{
        width:450px;
    }

    form .box-1{
        width:200px;
    }


    form .box-2{
         display:flex;
         gap:20px;
         flex-direction:column;
         align-items:center;
         justify-content:center;
    }


    
    form .box-2 #profileImage{
        width:350px;
        height:350px;
    }



</style>

</head>



<body>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary text-capitalize">  Profile -   <?php echo $row['firstname']  ?>  <?php echo $row['lastname']  ?> </h6>
        </div>
        <div class="card-body">
        <?php

$currentUser = $_SESSION['customer_id'];

$sql = "SELECT * FROM customer WHERE customer_id = '$currentUser' ";
$customer_id = $con->query($sql) or die ($con->error);
$row = $customer_id->fetch_assoc();
   ?>
                        <form action="profile.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="edit_id" value="<?php echo $row['customer_id']   ?>">

            <div class="box-1">
                            <div class="form-group">
                            <label for="Firstname" class="form-label">First Name</label>
                                    <input type="text" value="<?php echo $row['firstname']  ?>" class="form-control text-capitalize" name="edit_firstname"
                                        id="firstname"  required>
            </div>
            <div class="form-group">
            <label for="Lastname" class="form-label">Last Name</label>
                                    <input type="text"  value="<?php echo $row['lastname']   ?>"  class="form-control text-capitalize" name="edit_lastname"
                                        id="lastname"  required>
            </div>
            <div class="form-group">
            <label for="number" class="form-label">Number</label>
                                    <input type="number"  value="<?php echo $row['number']   ?>"  class="form-control" name="edit_number"
                                        id="number" required>
            </div>
            <div class="form-group">
            <label for="Email" class="form-label">Email address</label>
                                    <input type="email"  value="<?php echo $row['email']   ?>"  class="form-control" name="edit_email" id="Email"
                                         required>
            </div>

            <div class="form-group">
            <label for="Email" class="form-label"><a href="change_password.php">Change Password?</a></label>

            </div>
    
                            <button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
                            </div>
                            <div class="box-2">
    <form>
        <label for="uploadfile" class="form-label">Profile Picture</label>
        <?php
        // Check if the user has a profile image
        $profileImage = !empty($row['img']) && file_exists('upload/' . $row['img']) ? 'upload/' . $row['img'] : 'img/user-img.png';
        ?>
        <img id="profileImage" class="img-profile rounded-circle" src="<?php echo $profileImage; ?>" alt="Profile Image">

        <div class="form-group">
            <input type="file" class="form-control" name="uploadfile" accept=".jpg, .jpeg, .png">
        </div>

        </div>
    </form>
</div>

<?php



include('includes/scripts.php');
include('includes/footer.php');
?>
<?php
include('includes/header.php');
include('includes/navbar.php');
require "../connection.php";

if (isset($_POST['updatebtn'])) {
    $admin_id = $_POST['edit_id'];
    $firstname = $_POST['edit_firstname'];
    $lastname = $_POST['edit_lastname'];
    $email = $_POST['edit_email'];

    // Check if an image is uploaded
    if (isset($_FILES['uploadfile']['name']) && !empty($_FILES['uploadfile']['name'])) {
        $filetmpname = $_FILES['uploadfile']['tmp_name'];
        $filename = $_FILES['uploadfile']['name'];
        $folder = 'upload/';

        // Move the uploaded image to the specified folder
        move_uploaded_file($filetmpname, $folder . $filename);

        // Update the admin table with the new image
        $query = "UPDATE admin SET firstname='$firstname', lastname='$lastname', email='$email', img='$filename' WHERE admin_id='$admin_id'";
    } else {
        // If no new image is uploaded, update without changing the image
        $query = "UPDATE admin SET firstname='$firstname', lastname='$lastname', email='$email' WHERE admin_id='$admin_id'";
    }

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['status'] = "Your Profile has been Updated";
        $_SESSION['status_code'] = "success";
        echo '<script>window.location.href="profile.php";</script>';
        exit();
    } else {
        $_SESSION['status'] = "Your Profile is Not Updated";
        $_SESSION['status_code'] = "error";
        echo '<script>window.location.href="profile.php";</script>';
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
        width:330px;
        height:330px;
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

$currentUser = $_SESSION['admin_id'];

$sql = "SELECT * FROM admin WHERE admin_id = '$currentUser' ";
$admin_id = $con->query($sql) or die ($con->error);
$row = $admin_id->fetch_assoc();
   ?>
                        <form action="profile.php" method="POST" enctype="multipart/form-data">

                        <input type="hidden" name="edit_id" value="<?php echo $row['admin_id']   ?>">

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
        $profileImage = !empty($row['img']) && file_exists('upload/' . $row['img']) ? 'upload/' . $row['img'] : 'img/admin-profile.png';
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
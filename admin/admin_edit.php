<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<head>
    <style>
 .sidebar-dark .nav-item #nav-link-admin {
    background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

.form-group-pass{
        margin:0px 0;
        display:flex;
        justify-content: flex-end;        
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
    </style>

</head>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Admin Profile </h6>
        </div>
        <div class="card-body">
        <?php
        
$con =  mysqli_connect($host, $username, $password, $dbname);

            if(isset($_POST['edit_btn']))
            {
                $admin_id = $_POST['edit_id'];
                $query = "SELECT * FROM admin WHERE admin_id ='$admin_id' ";

                $query_run = mysqli_query($con, $query);

                foreach($query_run as $row)
                {
                    ?>

                        <form action="code_admin.php" method="POST">

                            <input type="hidden" name="edit_id" value="<?php echo $row['admin_id'] ?>">

                            <div class="form-group">
                            <label for="Firstname" class="form-label">First Name</label>
                                    <input type="text" value="<?php echo $row['firstname']  ?>" class="form-control text-capitalize" name="edit_firstname"
                                        id="firstname"  required>
            </div>
            <div class="form-group">
            <label for="Lastname" class="form-label">Last Name</label>
                                    <input type="text"  value="<?php echo $row['lastname']  ?>"  class="form-control text-capitalize" name="edit_lastname"
                                        id="lastname" placeholder="Enter your last name" required>
            </div>
            <div class="form-group">
            <label for="Email" class="form-label">Email address</label>
                                    <input type="email"  value="<?php echo $row['email']  ?>"  class="form-control" name="edit_email" id="Email"
                                       required>
            </div>
            <label for="Email" class="form-label">Password</label>
            <div class="form-group-pass">
            <input type="password"  value="<?php echo $row['password']  ?>"  class="form-control" name="edit_password" id="password"  required>
            <img src="img/eye-close.png" alt="" id="eyeicon">
        </div>
        <label for="Email" class="form-label">Confirm Password</label>
<div class="form-group-pass">
    <input type="password" value="<?php echo $row['cpassword'] ?>" class="form-control" name="cpassword" id="cpassword" required>
    <img src="img/eye-close.png" alt="" id="eyeicons">
</div>
<br>

                            <a href="admin_profile.php" class="btn btn-danger"> CANCEL </a>
                            <button type="submit" name="updatebtn" class="btn btn-primary"> UPDATE </button>

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
let eyeicons = document.querySelector('#eyeicons');
let cpassword = document.querySelector('#cpassword');

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

</script>




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
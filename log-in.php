<script type="text/javascript">
function preventBack() {
    window.history.forward();
}
setTimeout("preventBack()", 0);
window.onunload = function() {
    null
};
</script>
<?php

require 'connection.php';




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Don Elmer's - Log in</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" href="img/homepage.jpg" type="image/x-icon">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/index.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">


    <style>
    .password {
        display: flex;
        justify-content: flex-end;
    }

    #eyeicon {
        height: 24px;
        width: 24px;
        margin: 0 15px;
        ;
        position: absolute;
    }

    .form-select{
    height:50px;
}

.form-control{
  height: 50px;
}

.btn.btn-dark.text-center{
    height: 50px;
}

    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="#"
                        class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <h1 class="m-0 text-primary text-uppercase">Don Elmer's </h1>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0">donelmersresort@gmail.com</p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0">093811964481</p>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                <a class="me-3" href="https://www.facebook.com/profile.php?id=100083573612681"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="index.html" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">Don Elmer's</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                            data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php" class="nav-item nav-link ">Home</a>
                                <a href="index.php#about" class="nav-item nav-link">About</a>
                                <a href="index.php#service" class="nav-item nav-link">Services</a>
                                <a href="sign-up.php" class="nav-item nav-link">Register</a>
                                <a href="log-in.php" class="nav-item nav-link" style="color:#FEA116;">Login</a>
                                <a href="index.php#contact" class="nav-item nav-link">Contact</a>
                            </div>

                        </div>
                </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Carousel Start -->

    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height:700px;">
                    <img class="w-100" src="img/homepage.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 770px;;">
                            <section class="wrapper">
                                <form action="code.php" method="post">
                                    <h2 class="fw-bolder pb-3 animated slideInDown">Log In</h2>
                                    <div class="credentials  wow fadeIn" data-wow-delay="0.1s">
                                        <div class="mb-2 ">
                                            <select class="form-select" name="role" id="role"
                                                aria-label="Select role to log in">
                                                <option value="" disabled selected hidden>Select role to log in</option>
                                                <option value="Customer">Customer</option>
                                                <option value="Admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-2" id="codeInput">
                                            <input type="text" class="form-control" name="code" id="code"
                                                placeholder="Enter the Code of Don Elmer's">
                                        </div>
                                        <div class="mb-2">
                                            <input type="email" class="form-control" name="email" id="Email"
                                                placeholder="Enter your Email" required>
                                        </div>
                                        <div class="password">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Enter your Password" required>
                                            <img src="img/eye-close.png" alt="" id="eyeicon"
                                                style="height:25px; width:34px;  margin:15px 15px;">
                                        </div>

                                        <div class="login-forgot-pass mt-2 mb-3">
                                            <a href="password-reset.php" style="color:#fff;">Forgot password?</a>
                                        </div>
                                        <button type="submit" name="LogInBtn"
                                            class="btn btn-dark text-center  w-100 mb-2">Log
                                            In</button>
                                        <div class="mt-4 d-flex justify-content-between">
                                            <a href="sign-up.php" style="color:#fff;">Don't have an account?</a>
                                        </div>
                                    </div>
                                </form>

                        </div>
                    </div>
                </div>


                <?php
                include('includes/scripts.php');
                include('js/scripts.php');

                ?>
            </div>
        </div>


        <!-- Carousel End -->


        <!-- Login -->






        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s height">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-primary rounded p-4">
                            <a href="index.php">
                                <h2 class="text-white  mb-3" style="text-align:center; ">Don Elmer's Hotel & Resort</h2>
                            </a>

                        </div>
                    </div>
                    <di class="col-md-6 col-lg-3">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Contact</h6>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Don Elmers Resort dao st . San Jose
                            Rodriguez Rizal</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>093811964481</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>donelmersresort@gmail.com</p>
                        <p class="mb-2"><i class="fab fa-facebook-f me-3"></i>Don Elmers Hotel & Resort </p>
                    </di>
                </div>
            </div>
            <div class="container">
                <div class="copyright" style="text-align:center;">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0"
                            style="display:flex; justify-content:center;">
                            &copy; <a class="border-bottom"
                                href="https://www.facebook.com/profile.php?id=100083573612681">Don Elmers Hotel &
                                Resort</a>, All Right Reserved.
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <!-- Footer End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the code input element
        var codeInput = document.getElementById("codeInput");

        // Initially hide the code input
        codeInput.style.display = "none";

        // Add an event listener to the role select element
        document.getElementById("role").addEventListener("change", function() {
            // Get the selected value
            var selectedValue = this.value;

            // Show/hide the code input based on the selected value
            if (selectedValue === "" || selectedValue === "Customer") {
                codeInput.style.display = "none";
            } else if (selectedValue === "Admin" || selectedValue === "Staff") {
                codeInput.style.display = "block";
            } else {
                codeInput.style.display = "none";
            }
        });
    });
    </script>
    <script src="js/scripts.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the code input element
        var codeinput = document.getElementById("codeInputs");

        // Initially hide the code input
        codeinput.style.display = "none";

        // Add an event listener to the role select element
        document.getElementById("role").addEventListener("change", function() {
            // Get the selected value
            var selectedValue = this.value;

            // Show/hide the code input based on the selected value
            if (selectedValue === "" || selectedValue === "Customer") {
                codeInputs.style.display = "none";
            } else if (selectedValue2 === "Admin" || selectedValue2 === "Staff") {
                codeInputs.style.display = "block";
            } else {
                codeInputs.style.display = "none";
            }
        });
    });
    </script>

</body>

</html>
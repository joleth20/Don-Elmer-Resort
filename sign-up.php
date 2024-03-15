

</script>
<?php
require 'connection.php';




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Don Elmer's - Register</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="shortcut icon" href="img/homepage.jpg" type="image/x-icon">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

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

#mb-2{
        display:flex;
        justify-content: flex-end;        
    }

    #eyeicon{
        height: 24px;
        width: 24px;
        margin:0 15px;;
        position:absolute;
    }

    #eyeicons{
        height: 24px;
        width: 24px;
        margin:0 15px;;
        position:absolute;
    }

    input[type=checkbox]{
        accent-color:#FEA116;
    }

    #myBtn{
    color: white;
    background-color: Transparent;
    background-repeat:no-repeat;
    border: none;
    cursor:pointer;
    overflow: hidden;        
}

#myBtn:hover{
    text-decoration: underline;
}


.modal-content .close:hover{
    color:#FEA116;
}

.modal-content h1{
 text-align:center;
}

.modal-content p{
    text-align: justify;
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
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
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

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0">
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="#" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
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
                                <a class="me-3" href="https://www.facebook.com/profile.php?id=100083573612681"><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <a href="index.html" class="navbar-brand d-block d-lg-none">
                            <h1 class="m-0 text-primary text-uppercase">Don Elmer's</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php" class="nav-item nav-link ">Home</a>
                                <a href="index.php#about" class="nav-item nav-link">About</a>
                                <a href="index.php#service" class="nav-item nav-link">Services</a>
                                <a href="sign-up.php" class="nav-item nav-link" style="color:#FEA116;"   >Register</a>
                                <a href="log-in.php" class="nav-item nav-link">Login</a>
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
                    <div class="carousel-item active" style="height:850px;">
                        <img class="w-100" src="img/homepage.jpg" alt="Image" >
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 770px;;">
                            <section class="wrapper" >
                            <form action="code.php" method="post" enctype="multipart/form-data">
                            <h2 class="fw-bolder pb-3 animated slideInDown">Register</h2>
                            <div class="credentials wow fadeIn" data-wow-delay="0.1s">
                                <div class="mb-2">
                                    <label for="Role" class="form-label" ></label>
                                    <select class="form-select" name="role" id="role"
                                        aria-label="Select role to register" required>
                                        <option  disabled selected hidden >Register as</option>
                                        <option value="Customer">Customer</option>
                                        <option value="Admin">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-2" id="codeInput">
                                    <input type="text" class="form-control" name="code" id="code"
                                        placeholder="Code of Don Elmer's">
                                </div>
                                <div class="mb-2">
                           
                                    <input type="text" class="form-control text-capitalize" name="firstname"
                                        id="firstname" placeholder="First name" required>
                                </div>
                                <div class="mb-2">
                             
                                    <input type="text" class="form-control text-capitalize" name="lastname"
                                        id="lastname" placeholder="Last name" required>
                                </div>
                                <div class="mb-2">
                                    <input type="number"  class="form-control text-capitalize" name="number"
                                        id="number" placeholder="Mobile Number" required>
                                </div>
                                <div class="mb-2">
                                    <input type="email" class="form-control" name="email" id="Email"
                                        placeholder="Email" required>
                                </div>
                                <div class="mb-2" id="mb-2">
                                    <input type="password" class="form-control" name="password" id="password"   placeholder="Password" required>
                                    <img src="img/eye-close.png" alt=""  id="eyeicon" style="height:25px; width:34px; margin:15px 15px; ">
                                </div>
                                <div class="mb-2" id="mb-2">
                                    <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm your Password" >
                                    <img src="img/eye-close.png" alt=""  id="eyeicons" style="height:25px; width:34px; margin:15px 15px; ">
                                </div>

                            <button type="submit" name="SignUpBtn"
                                class="btn btn-dark text-center  w-100 mb-2">Register</button>
                                <!-- checkbox -->
                                <div class="tackbox" >
                                <input type="checkbox" style="  vertical-align: middle;" required />
                                <label for="checkbox"> I agree to these &nbsp;</label><button type="button" id="myBtn">Terms and Condition</button>
                                </div>
                            <div class="mt-2 d-flex justify-content-between">
                                <a href="log-in.php" style="color:#fff;" >Already have an account? Log In here!</a>
                            </div>
                            </div>
                        </form>
     
                            </div>
                        </div>
                    </div>
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h1>Terms and Conditions</h1>
    <p>&nbsp;&nbsp;By completing the registration process, you agree to abide by these terms and conditions.
Reservation requests are subject to availability and confirmation from the resort.
The full payment or a specified deposit must be made within the stipulated time to confirm your booking.
Late cancellations or no-shows may result in forfeiture of the booking amount.
Guests are responsible for any damages to the resort property caused by them during their stay.
Any additional charges or fees incurred during the stay are the responsibility of the guest.
Guests must adhere to the resort's policies and guidelines.<br><br>
&nbsp;&nbsp;The resort reserves the right to evict guests for disruptive behavior or non-compliance with rules.
Changes to the reservation details, including dates and room types, are subject to availability and approval.
The resort is not liable for failure to perform its obligations due to unforeseen circumstances beyond its control, such as natural disasters, acts of terrorism, or government regulations.
Information provided during registration will be treated in accordance with the resort's privacy policy.
By registering, you agree to receive communications related to your reservation, including confirmation emails and updates.By completing the registration, you acknowledge that you have read, understood, and agree to these terms and conditions. The resort reserves the right to update or modify these terms at any time without prior notice.</p>
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
        <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container pb-5">
                <div class="row g-5" >
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-primary rounded p-4">
                            <a href="index.php"><h2 class="text-white  mb-3" style="text-align:center; ">Don Elmer's Hotel & Resort</h2></a>
     
                        </div>
                    </div>
                    <di class="col-md-6 col-lg-3">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Contact</h6>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Don Elmers Resort dao st . San Jose Rodriguez Rizal</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>093811964481</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>donelmersresort@gmail.com</p>
                        <p class="mb-2"><i class="fab fa-facebook-f me-3"></i>Don Elmers Hotel & Resort </p>
                    </di>       
                </div>
            </div>
            <div class="container">
                <div class="copyright" style="text-align:center;">
                    <div class="row" >
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0" style="display:flex; justify-content:center;">
                            &copy; <a class="border-bottom" href="https://www.facebook.com/profile.php?id=100083573612681">Don Elmers Hotel & Resort</a>, All Right Reserved. 
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

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

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


</body>
</html>


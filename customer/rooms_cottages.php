<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('includes/scripts.php');




$date = isset($_GET['date']) ? $_GET['date'] : '';
$_SESSION['user_authenticated'] = true;
if(isset($_GET['Date'])){
    $date = $_GET['Date'];
}

if (isset($_POST["submit"])) {
    require "../connection.php";

    if (isset($_SESSION["customer_id"]) && isset($_POST["inDate"]) && isset($_POST["outDate"]) && isset($_POST["numGuests"])) {
        $name = $_POST["name"];
        $number = $_POST["number"];
        $user_id = $_SESSION["customer_id"];
        $date = $_POST["inDate"];
        $check_out_date = $_POST["outDate"];
        $num_guests = $_POST["numGuests"];
        $paymentMethod = $_POST["paymentMethod"];
        $referenceNumber = $_POST["referenceNumber"];
        $accommodationType = $_POST["accommodationType"];

        // File Upload
        $imageProof = $_FILES["imageProof"]["name"];
        $target_dir = "upload/";  // Specify your target directory
        $target_file = $target_dir . basename($_FILES["imageProof"]["name"]);
        move_uploaded_file($_FILES["imageProof"]["tmp_name"], $target_file);

        // Prepare and execute the SQL query
        $query = "INSERT INTO reservations (name, number, user_id, DATE, check_out_date, num_guests, paymentMethod, referenceNumber, imageProof, accommodationType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "ssssssssss", $name, $number, $user_id, $date, $check_out_date, $num_guests, $paymentMethod, $referenceNumber, $imageProof, $accommodationType);

        if (mysqli_stmt_execute($stmt)) {
            // Successful query
            $_SESSION['status'] = "Your Reservation has been pending";
            $_SESSION['status_code'] = "success";
            
            // Display the uploaded image
            echo '<img src="' . $target_file . '" alt="Uploaded Image">';
            echo '<script>window.location.href="available-schedules.php"</script>';

        } else {
            // Error in the query
            $_SESSION['status'] = "There's something wrong, please try again!";
            $_SESSION['status_code'] = "error";

        }

        mysqli_stmt_close($stmt); // Close the statement
    }
}

mysqli_close($con); // Close the database connection



    

?>

<?php 
$a = mt_rand(100000,999999); 

for ($i = 0; $i<6; $i++) 
{
   $a .= mt_rand(0,9);
}?>

<head>
    
<style>
 .sidebar-dark .nav-item #nav-link-available {
  background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

header{
    height:72px;
    width:100%;
}
.gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .room {
            width: 300px;
            margin: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .slider-container {
            width: 100%;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .room img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .room-info {
            padding: 15px;
        }

        h3 {
            margin-top: 0;
        }

        p {
            color: #555;
        }

/* The Modal (background) */
.modal {
    display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* or overflow: visible; */
  background-color: rgba(0, 0, 0, 0.7);
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


.input-group>.custom-file, .input-group>.custom-select, .input-group>.form-control, .input-group>.form-control-plaintext {
    position: relative;
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    width: 350px;
    margin-bottom: 0;
}
label {
    display: inline-block;
    margin-bottom: 0.5rem;
    width: 150px;
}

#reserve{
    width: 100%;
    height:100%;
    display:grid;
    grid-auto-flow: column;
}

 #paymentMethod{
    width: 300px;
    height:100%;

}

#referenceNumber{
    width: 212px;
}

#imageProof{
    border:none;
    width: 230px;
}

footer.sticky-footer{
    display:none;
}



        @media (max-width: 768px) {
            .room {
                width: calc(50% - 40px);
            }
        }

        @media (max-width: 480px) {
            .room {
                width: calc(100% - 40px);
            }
        }
</style>
</head> 
<!-- COTTAGES -->
<header>            
    <h1 class="text-center " > Reserve for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
                <div class="row g-3 py-5 px-5 d-flex align-items-center">
                <a  href='available-schedule.php' class='btn btn-success btn-xs'> <span class='glyphicon glyphicon-ok'></span> Back</a>
</header>

<center><h1 > COTTAGES</h1></center>
<script>
    function disableButton(myBtn1) {
        var btn = document.getElementById(myBtn1);
        btn.disabled = true;
    }
</script>

<div class="gallery">
        <div class="room">
            <img src="img/cottage-1.jpg" alt="Room 1">
            <div class="room-info">
                <h3>Cottage 1</h3>
                <p>Price: ₱1,000 - maximum of 10 persons </p>
                <form onsubmit="disableButton('myBtn1')" method="post">
                <a href='#' class='btn btn-success btn-xs' id="myBtn1" onclick="document.forms[0].submit()"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </form>
            </div>
        </div>

        <div class="room">
            <img src="img/cottage-2.jpg" alt="Room 2">
            <div class="room-info">
            <h3>Cottage 2</h3>
                <p>Price: ₱1,000 - maximum of 10 persons  </p>
                <a href='#' class='btn btn-success btn-xs' id="myBtn2"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>
        <div class="room">
            <img src="img/cottage-3.jpg" alt="Room 3">
            <div class="room-info">
            <h3>Cottage 3</h3>
                <p>Price: ₱1,000 - maximum of 10 persons  </p>
                <a href='#' class='btn btn-success btn-xs'  id="myBtn3"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>  

        <div class="room">
            <img src="img/cottage-5.jpg" alt="Room 5">
            <div class="room-info">
            <h3>Cottage 4</h3>
            <p>Price: ₱1,000 - maximum of 10 persons  </p>
                <a href='#' class='btn btn-success btn-xs'  id="myBtn4"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>

        <div class="room">
            <img src="img/cottage-2.jpg" alt="Room 6">
            <div class="room-info">
            <h3>Cottage 5</h3>
            <p>Price: ₱1,000 - maximum of 10 persons  </p>
                <a href='#' class='btn btn-success btn-xs'  id="myBtn5"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>
        <div class="room">
            <img src="img/cottage-3.jpg" alt="Room 7">
            <div class="room-info">
            <h3>Cottage 6</h3>
            <p>Price: ₱1,000 - maximum of 10 persons </p>
                <a href='#' class='btn btn-success btn-xs' id="myBtn6"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>

        <div class="room">
            <img src="img/cottage-5.jpg" alt="Room 8">
            <div class="room-info">
            <h3>Cottage 7</h3>
            <p>Price: ₱1,000 - maximum of 10 persons  </p>
                <a href='#' class='btn btn-success btn-xs' id="myBtn7"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>
        <div class="room">
            <img src="img/cottage-2.jpg" alt="Room 9">
            <div class="room-info">
            <h3>Cottage 8</h3>
            <p>Price: ₱1,000 - maximum of 10 persons  </p>
                <a href='#' class='btn btn-success btn-xs' id="myBtn8"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>
        <div class="room">
        <div class="slider-container" alt="Room 9">
                <div class="slider">
                    <div class="slide"><img src="img/cottage-4.jpg" alt="Room 4 Image 1"></div>
                    <div class="slide"><img src="img/event-cottage.jpg" alt="Room 4 Image 2"></div>
                </div>
            </div>
            <div class="room-info">
            <h3> 2nd floor Cottage 9</h3>
                <p>Price: ₱1,500 - maximum of 20 persons with videoke </p>
                <a href='#' class='btn btn-success btn-xs' id="myBtn-9"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>
        <!-- ROOM -->
        <center><h1> ROOMS </h1></center>
<div class="gallery">
        <div class="room">
            <img src="img/room-1.jpg" alt="Room 10">
            <div class="room-info">
            <h3>Room 1</h3>
            <p>Price: ₱2,300 - maximum of 8 persons with TV and aircon </p>
                <a href='#' class='btn btn-success btn-xs' id="myBtn10"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>

        <div class="room">
            <img src="img/room-2.jpg" alt="Room 11">
            <div class="room-info">
            <h3>Room 2</h3>
            <p>Price: ₱2,000 - maximum of 5 persons with aircon  </p>
                <a href='#' class='btn btn-success btn-xs' id="myBtn-11"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>
        <div class="room">
            <img src="img/room-3.jpg" alt="Room 12">
            <div class="room-info">
            <h3>Room 3</h3>
            <p>Price: ₱1,500 - maximum of 3 persons small room  </p>
                <a href='#' class='btn btn-success btn-xs' id="myBtn-12"> <span class='glyphicon glyphicon-ok'></span> Reserve Now</a>
            </div>
        </div>

        
        <!-- The Modal -->
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
  <span class="close" onclick="closeModal()">&times;</span>

             <!-- Rate -->
             <div class="container-fluid border-bottom border-1 border-secondary">
             <h1 class="text-center alert alert-danger" style="background:#4e73df;border:none;color:#fff"> Reserve for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
                 <div class="row g-3 py-5 px-5 d-flex align-items-center">
                     
                     <form action="rooms_cottages.php" method="post" id="reserve" enctype="multipart/form-data">
         <div class="box-1">
                         <div class="col-xl-2 col-md-3 col-sm-12">
                             <h3 class="fw-bold text-start">RESERVATION</h3>
                         </div>
 
                         <div class="col-xl-3 col-md-3 col-sm-12">
                             <label for="name" class="form-label fw-bold">Username</label>
                             <div class="input-group">
                                 <input type="text" class="form-control" id="name" name="name" placeholder="Enter your username" required>
                             </div>
                         </div>
 
                         <div class="col-xl-3 col-md-3 col-sm-12">
                             <label for="number" class="form-label fw-bold">Phone Number</label>
                             <div class="input-group">
                                 <input type="number" class="form-control" id="number" name="number" placeholder="Enter your number" required>
                             </div>
                         </div>
 
 
                         <div class="col-xl-3 col-md-3 col-sm-12">
     <label for="basic-url" class="form-label fw-bold"></label>
     <div class="input-group">
     <input type="hidden" value="<?php echo $date; ?>" class="form-control" id="inDate" name="inDate" readonly>
     </div>
 </div>
 
 <div class="col-xl-3 col-md-3 col-sm-12">
     <label for="basic-url" class="form-label fw-bold">OUT</label>
     <div class="input-group">
         <input type="date" class="form-control" id="outDate" name="outDate" aria-describedby="Date-Out" required>
     </div>
 </div>
 
                         <div class="col-xl-3 col-md-3 col-sm-12">
                             <label for="basic-url" class="form-label fw-bold">GUEST</label>
                             <div class="input-group">
                                 <select  class="form-control"  id="numGuests" name="numGuests" aria-label="Default select example"   required>
                                     <option value="" disabled selected hidden> Number of guests here</option>
                                     <option value="1">One</option>
                                     <option  value="2">Two</option>
                                     <option value="3">Three</option>
                                     <option value="4">Four</option>
                                     <option value="5">Five</option>
                                  
                                 </select>
                             </div>
                         </div>
                         <div class="col-xl-1 col-md-3 col-sm-12 mt-5">
                             <button class="btn btn-primary" name="submit" id="btn">Submit</button>
                         </div>
 </div>
                    
 <div class="box-2">
 
 <div class="col-xl-2 col-md-3 col-sm-12">
                             <h3 class="fw-bold text-start">PAYMENT</h3>
                         </div>
        
                         <div class="col-xl-3 col-md-3 col-sm-12" id="paymentMethodField">
    <label for="paymentMethod" class="form-label fw-bold">Payment Method</label>
    <div class="input-group">
        <select class="form-control" id="paymentMethod" name="paymentMethod" onchange="showHideFields()" required>
            <option value="" disabled selected hidden>Select Payment</option>
            <option value="Gcash">Gcash</option>
            <option value="Cash">Cash</option>
            <option value="Paypal">Paypal</option>
            <option value="CreditCard">Credit Card</option>
            <option value="WalkIn">Walk-in (Not Paid)</option>
        </select>
    </div>
</div>

 
         <div class="col-xl-3 col-md-3 col-sm-12" id="referenceNumberField" style="display: none;">
             <label for="referenceNumber" class="form-label fw-bold">Reference Number</label>
             <input type="number" class="form-control" id="referenceNumber" name="referenceNumber" >
         </div>
 
         <div class="col-xl-3 col-md-3 col-sm-12" id="imageProofField" style="display: none;">
             <label for="imageProof" class="form-label fw-bold">Image Proof</label>
             <input type="file"  class="form-control" id="imageProof" name="imageProof" >
         </div>

     <br>
     <div class="col-xl-3 col-md-3 col-sm-12">

        <div class="input-group">
        <label for="roomImage" class="form-label fw-bold">Facilities type</label>
        <select id="accommodationType" name="accommodationType" class="form-control"  required>
    <option value="" disabled selected hidden>Select Facilities type</option>
    <option value="Room-1">Room 1</option>
    <option value="Room-2">Room 2</option>
    <option value="Room-3">Room 3</option>
    <option value="Cottage 1">Cottage 1</option>
    <option value="Cottage 2">Cottage 2</option>
    <option value="Cottage 3">Cottage 3</option>
    <option value="Cottage 4">Cottage 4</option>
    <option value="Cottage 5">Cottage 5</option>
    <option value="Cottage 6">Cottage 6</option>
    <option value="Cottage 7">Cottage 7</option>
    <option value="Cottage 8">Cottage 8</option>
    <option value="Cottage 9">Cottage 9</option>
    <option value="Cottage 10">Cottage 10</option>
    <option value="Cottage 11">Cottage 11</option>
    <option value="Cottage 12">Cottage 12</option>
    
</select>


 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</div>

</div>

        <script>


function showOptions() {
        var accommodationType = document.getElementById("accommodationType").value;
        var optionsContainer = document.getElementById("optionsContainer");

        // Clear previous options
        optionsContainer.innerHTML = "";

        // Add options based on the selected accommodation type
        if (accommodationType === "cottages") {
            for (var i = 1; i <= 9; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = "Cottage " + i;
                optionsContainer.appendChild(option);
            }
        } else if (accommodationType === "rooms") {
            for (var i = 1; i <= 3; i++) {
                var option = document.createElement("option");
                option.value = i;
                option.text = "Room " + i;
                optionsContainer.appendChild(option);
            }
        }
    }






// Get the modal
var btn = document.getElementById("btn")
var modal = document.getElementById("myModal");



// Get the button that opens the modal
var btn1 = document.getElementById("myBtn1");
var btn2 = document.getElementById("myBtn2");
var btn3 = document.getElementById("myBtn3");
var btn4 = document.getElementById("myBtn4");
var btn5 = document.getElementById("myBtn5");
var btn6 = document.getElementById("myBtn6");
var btn7 = document.getElementById("myBtn7");
var btn8 = document.getElementById("myBtn8");
var btn9 = document.getElementById("myBtn-9");
var btn10 = document.getElementById("myBtn10");
var btn11 = document.getElementById("myBtn-11");
var btn12 = document.getElementById("myBtn-12");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

var modal1 = document.getElementById("myModal1");
var modal2 = document.getElementById("myModal2");
var modal3 = document.getElementById("myModal3");
var modal4 = document.getElementById("myModal4");
var modal5 = document.getElementById("myModal5");
var modal6 = document.getElementById("myModal6");
var modal7 = document.getElementById("myModal7");
var modal8 = document.getElementById("myModal8");
var modal9 = document.getElementById("myModal-9");
var modal10 = document.getElementById("myModal0");
var modal11 = document.getElementById("myModal-11");
var modal12 = document.getElementById("myModal-l2");

var closeBtn = document.getElementsByClassName("close")[0]


// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
  document.body.style.overflow = "hidden"; // Disable scrolling
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  document.body.style.overflow = "hidden"; // Enable scrolling
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    document.body.style.overflow = "auto"; // Enable scrolling
  }

  
}



function openModal() {
    modal.style.display = "block";
  }


  function closeModal() {
    modal.style.display = "none";
    document.body.style.overflow = "auto";
  }


  btn1.onclick = function() {
  openModal(modal1);
};

btn2.onclick = function() {
  openModal(modal2);
};

btn3.onclick = function() {
  openModal(modal3);
};

btn4.onclick = function() {
  openModal(modal4);
};

btn5.onclick = function() {
  openModal(modal5);
};

btn6.onclick = function() {
  openModal(modal6);
};

btn7.onclick = function() {
  openModal(modal7);
};

btn8.onclick = function() {
  openModal(modal8);
};

btn9.onclick = function() {
  openModal(modal9);
};

btn10.onclick = function() {
  openModal(modal10);
};

btn11.onclick = function() {
  openModal(modal11);
};

btn12.onclick = function() {
  openModal(modal12);
};

  // Close the modal if the close button is clicked
  var closeBtn = document.getElementsByClassName("close")[0];
  closeBtn.onclick = closeModal;



function displayRoomInfo() {
        var roomSelection = document.getElementById("roomSelection");
        var roomImageField = document.getElementById("roomImageField");
        var roomImage = document.getElementById("roomImage");
        var roomInfoField = document.getElementById("roomInfoField");
        var roomInfo = document.getElementById("roomInfo");

        if (roomSelection.value !== "") {
            // You can set the image source and information dynamically based on the selected room or cottage
            // For example, if the value is "room1", set the image source and information accordingly
            if (roomSelection.value === "room1") {
                roomImage.src = "../img/DER-4.jpg";
                roomInfo.textContent = "Room 1 - ₱1,500 per night";
                var availableSlots = roomSelection.options[roomSelection.selectedIndex].getAttribute("data-available-slots");
            roomInfo.textContent = "Available Slots: " + availableSlots;

            } else if (roomSelection.value === "room2") {
                roomImage.src = "../img/DER-6.jpg";
                roomInfo.textContent = "Room 2 - ₱1,200 per night";
                var availableSlots = roomSelection.options[roomSelection.selectedIndex].getAttribute("data-available-slots");
            roomInfo.textContent = "Available Slots: " + availableSlots;

            }
            // Add more conditions for other rooms or cottages

            roomImageField.style.display = "block";
            roomInfoField.style.display = "block";
        } else {
            roomImageField.style.display = "none";
            roomInfoField.style.display = "none";
        }
    }




    function getCurrentDate() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Set the minimum date for the date input to today
    document.getElementById('outDate').min = getCurrentDate();


    function showHideFields() {
    // Get the selected payment method
    var paymentMethodSelect = document.getElementById("paymentMethod");
    var selectedValue = paymentMethodSelect.value;

    // Get the fields to be displayed or disabled
    var referenceNumberField = document.getElementById("referenceNumberField");
    var imageProofField = document.getElementById("imageProofField");

    // Show the fields based on the selected payment method
    if (selectedValue === "Gcash" || selectedValue === "Cash" || selectedValue === "Paypal" || selectedValue === "CreditCard") {
        referenceNumberField.style.display = "block";
        imageProofField.style.display = "block";
    } else if (selectedValue === "WalkIn") {
        // Disable fields for "Walk-in (Not Paid)"
        referenceNumberField.style.display = "none";
        imageProofField.style.display = "none";
        
        // Optionally, you can add logic to disable the fields here
        // referenceNumberField.disabled = true;
        // imageProofField.disabled = true;
    } else {
        // Hide or reset fields for other payment methods
        referenceNumberField.style.display = "none";
        imageProofField.style.display = "none";
        
        // Optionally, you can add logic to reset or enable the fields here
        // referenceNumberField.disabled = false;
        // imageProofField.disabled = false;
    }
}





        document.addEventListener("DOMContentLoaded", function () {
            const sliders = document.querySelectorAll(".slider");

            sliders.forEach(slider => {
                let count = 0;
                const slides = slider.querySelectorAll(".slide");
                const totalSlides = slides.length;

                function showSlide(index) {
                    if (index >= 0 && index < totalSlides) {
                        count = index;
                    } else if (index >= totalSlides) {
                        count = 0;
                    } else {
                        count = totalSlides - 1;
                    }

                    const transformValue = -count * 100 + "%";
                    slider.style.transform = `translateX(${transformValue})`;
                }

                setInterval(() => {
                    showSlide(count + 1);
                }, 3000);
            });
        });
    </script>


<?php

include('includes/footer.php');
?>
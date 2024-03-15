<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('includes/scripts.php');

?>
<?php

require '../connection.php';





$date = isset($_GET['date']) ? $_GET['date'] : '';

if(isset($_GET['Date'])){
    $date = $_GET['Date'];
}


if (isset($_POST["submit"])) {

    if (isset($_SESSION["customer_id"]) && isset($_POST["inDate"]) && isset($_POST["outDate"]) && isset($_POST["numGuests"])) {
        $name = $_POST["name"];
        $number = $_POST["number"];
        $user_id = $_SESSION["customer_id"];
        $date = $_POST["inDate"];
        $check_out_date = $_POST["outDate"];
        $num_guests = $_POST["numGuests"];


        $query = "INSERT INTO reservations (name, number, user_id, DATE, check_out_date, num_guests) VALUES ('$name', '$number', '$user_id', '$date', '$check_out_date', '$num_guests')";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['status'] = "Your Reservation has been pending";
            $_SESSION['status_code'] = "success";
            echo '<script>window.location.href="list_reservations.php"</script>';
        } else {
            $_SESSION['status'] = "There's something wrong please try again!";
            $_SESSION['status_code'] = "error";
            echo '<script>window.location.href="list_reservations.php"</script>';
        }
        
    }else {
          // Handle the case where no available slots are left
          echo '<script>alert("No available slots for the selected room.")</script>';
    }

    } 







?>

<?php 
$a = mt_rand(100000,999999); 

for ($i = 0; $i<6; $i++) 
{
   $a .= mt_rand(0,9);
}?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Don Elmer's Resort</title>
    <link href="css/styles.css" rel="stylesheet" />

       <!-- Add the datepicker.js library -->
       <link rel="stylesheet" href="https://unpkg.com/datepicker-js/dist/datepicker.min.css">

    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- Font Awesome 5 -->
    <script src="https://kit.fontawesome.com/bbf859ee9d.js" crossorigin="anonymous"></script>
    </head>


    <style>
 .sidebar-dark .nav-item #nav-link-available {
  background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
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

</style>

    <body>
     
      

    <?php
            // Assuming $date contains the date in a format like 'm/d/Y'
            $formattedDate = !empty($date) ? date('Y-m-d', strtotime($date)) : '0000-00-00';
        ?>

            <!-- Rate -->
            <div class="container-fluid border-bottom border-1 border-secondary">
            <h1 class="text-center alert alert-danger" style="background:#4e73df;border:none;color:#fff"> Reserve for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
                <div class="row g-3 py-5 px-5 d-flex align-items-center">
                    
                    <form action="reservation.php" method="post" id="reserve">
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
                    <option value="1">Gcash</option>
                    <option value="2">Cash</option>
                    <option value="3">Paypal</option>
                    <option value="4">Credit Card</option>
                    <option value="5">Walk-in (Not Paid)</option>
                </select>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 col-sm-12" id="referenceNumberField" style="display: none;">
            <label for="referenceNumber" class="form-label fw-bold">Reference Number</label>
            <input type="number" class="form-control" id="referenceNumber" name="referenceNumber" required>
        </div>

        <div class="col-xl-3 col-md-3 col-sm-12" id="imageProofField" style="display: none;">
            <label for="imageProof" class="form-label fw-bold">Image Proof</label>
            <input type="file" class="form-control" id="imageProof" name="imageProof" required>
        </div>
       <!-- Choose Rooms and Cottages Section -->
<div class="row mt-4">
    <div class="col-xl-3 col-md-3 col-sm-12">
        <label for="roomSelection" class="form-label fw-bold">Choose Room or Cottage</label>
        <select class="form-control" id="roomSelection" name="roomSelection" onchange="displayRoomInfo()" required>
            <option value="" disabled selected hidden>Select Room or Cottage</option>
            <option value="room1">Room 1</option>
            <option value="room2">Room 2</option>
            <!-- Add more rooms or cottages as needed -->
        </select>
    </div>




    <!-- Room or Cottage Image Display -->
    <div class="col-xl-3 col-md-3 col-sm-12" id="roomImageField" style="display: none;">
        <label for="roomImage" class="form-label fw-bold">Room or Cottage Image</label>
        <img id="roomImage" class="img-fluid" alt="Room or Cottage Image">
    </div>

    <!-- Room or Cottage Info Display -->
    <div class="col-xl-3 col-md-3 col-sm-12" id="roomInfoField" style="display: none;">
        <label class="form-label fw-bold">Room or Cottage Information</label>
        <p id="roomInfo"></p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- JavaScript to display room or cottage information based on selection -->
<script>
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



        // Function to show or hide fields based on the selected payment method
        function showHideFields() {
            // Get the selected value from the payment method dropdown
            var selectedValue = document.getElementById("paymentMethod").value;

            // Get the fields containers
            var referenceNumberField = document.getElementById("referenceNumberField");
            var imageProofField = document.getElementById("imageProofField");

            // Hide all fields initially
            referenceNumberField.style.display = "none";
            imageProofField.style.display = "none";

            // Show the fields based on the selected payment method
            if (selectedValue === "1" || selectedValue === "2" || selectedValue === "3" || selectedValue === "4") {
                referenceNumberField.style.display = "block";
                imageProofField.style.display = "block";
            }
        }
    </script>



               


            </div>

          
            

          

        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
 
       
 <script>





    function submitReservation() {
        var inDate = document.getElementById("inDate").value;
        var outDate = document.getElementById("outDate").value;
        var numGuests = document.getElementById("numGuests").value;

        if (!inDate || !outDate || !numGuests) {
            alert("Please fill in all fields.");
            return false;
        }

        alert("Reservation details:\nCheck-in: " + inDate + "\nCheck-out: " + outDate + "\nGuests: " + numGuests);
        return true;
    }

    document.querySelector('form').addEventListener('submit', function (event) {
        var inDateInput = document.getElementById("inDate");
        var outDateInput = document.getElementById("outDate");

        var inDate = new Date(inDateInput.value);
        var outDate = new Date(outDateInput.value);

        var bookedDates = <?php echo json_encode($bookedDates); ?>;
        for (var i = 0; i < bookedDates.length; i++) {
            var bookedStartDate = new Date(bookedDates[i]['check_in_date']);
            var bookedEndDate = new Date(bookedDates[i]['check_out_date']);

            if (
                (inDate >= bookedStartDate && inDate <= bookedEndDate) ||
                (outDate >= bookedStartDate && outDate <= bookedEndDate) ||
                (inDate <= bookedStartDate && outDate >= bookedEndDate)
            ) {
                var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
                document.getElementById('bookingAlertText').innerText = 'This date range is already booked. Please choose another date range.';
                bookingModal.show();

                // Clear the date input values
                inDateInput.value = '';
                outDateInput.value = '';

                event.preventDefault();
                return;
            }
        }
    });
</script>

    </body>

</html>
<?php 
include('../includes/footer.php');
?>





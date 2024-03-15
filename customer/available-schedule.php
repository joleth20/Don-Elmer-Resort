<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

function build_calendar($month, $year) {
    $mysqli = new mysqli('localhost', 'root', '', 'resortdb');
    $stmt = $mysqli->prepare("SELECT DATE, COUNT(*) AS booking_count FROM reservations WHERE MONTH(DATE) = ? AND YEAR(DATE) = ? GROUP BY DATE");
    $stmt->bind_param('ss', $month, $year);
    $bookings = array();
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $bookings[$row['DATE']] = $row['booking_count'];
            }
            $stmt->close();
        }
    }
  
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
  
    $datetoday = date('Y-m-d');
  
    // Limit the number of available reserving to 12
    $availableBookings = 12;
  
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar .= "<a class='btn btn-xs btn-success' href='?month=" . date('m', mktime(0, 0, 0, $month - 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month - 1, 1, $year)) . "'>Previous Month</a> ";
    $calendar .= " <a class='btn btn-xs btn-danger' href='?month=" . date('m') . "&year=" . date('Y') . "'>Current Month</a> ";
    $calendar .= "<a class='btn btn-xs btn-primary' href='?month=" . date('m', mktime(0, 0, 0, $month + 1, 1, $year)) . "&year=" . date('Y', mktime(0, 0, 0, $month + 1, 1, $year)) . "'>Next Month</a></center><br>";
  
    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th  class='header'>$day</th>";
    }
  
    $currentDay = 1;
    $calendar .= "</tr><tr>";
  
    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td  class='empty'></td>";
        }
    }
  
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
    while ($currentDay <= $numberDays) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }
  
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
  
        $dayname = strtolower(date('l', strtotime($date)));
        $today = $date == date('Y-m-d') ? "today" : "";
        
        // Check if the date has reached the maximum bookings limit
        $isFullyBooked = isset($bookings[$date]) && $bookings[$date] >= $availableBookings;
  
        if ($date < date('Y-m-d')) {
            $calendar .= "<td><h3>$currentDay</h3> <button class='btn btn-danger btn-xs' disabled>N/A</button>";
        } elseif ($isFullyBooked) {
            $calendar .= "<td class='$today'><h3>$currentDay</h3> <button class='btn btn-danger btn-xs' disabled> <span class='glyphicon glyphicon-lock'></span> Fully Reserved</button>";
        } else {
            $calendar .= "<td class='$today'><h3>$currentDay</h3> <a href='rooms_cottages.php?date=" . $date . "' class='btn btn-success btn-xs' " . (($bookings[$date] ?? 0) ? 'disabled' : '') . "> <span class='glyphicon glyphicon-ok'></span>See Available Cottages and Rooms</a>";
        }
      $calendar .= "</td>";
      $currentDay++;
      $dayOfWeek++;;
    }
  
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td class='empty'></td>";
        }
    }
  
    $calendar .= "</tr>";
    $calendar .= "</table>";
    echo $calendar;
  }
  

?>
 
 <head>

 <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    
 <style>
 .sidebar-dark .nav-item #nav-link-available {
  background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

@media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;

            }
            
            

            .empty {
                display: none;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }



            /*
		Label the data
		*/
            td:nth-of-type(1):before {
                content: "Sunday";
            }
            td:nth-of-type(2):before {
                content: "Monday";
            }
            td:nth-of-type(3):before {
                content: "Tuesday";
            }
            td:nth-of-type(4):before {
                content: "Wednesday";
            }
            td:nth-of-type(5):before {
                content: "Thursday";
            }
            td:nth-of-type(6):before {
                content: "Friday";
            }
            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }

        /* Smartphones (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        /* iPads (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }
            td {
                width: 33%;
            }
        }
        
        .row{
            margin-top: 20px;
        }
        
        .today{
            background:#eee;
        }

</style>
 </head>

 <body style="background:#eee">
    <div class="container alert alert-default" style="background:#fff">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" style="background:#4e73df;border:none;color:#fff">
                    <h1>Available Schedules</h1>
                </div>
                <?php
                    $dateComponents = getdate();
                    if(isset($_GET['month']) && isset($_GET['year'])){
                        $month = $_GET['month'];
                        $year = $_GET['year'];
                    }else{
                        $month = $dateComponents['mon'];
                        $year = $dateComponents['year'];
                    }
                    build_calendar($month, $year);
                ?>
            </div>
        </div>
    </div>
</body>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
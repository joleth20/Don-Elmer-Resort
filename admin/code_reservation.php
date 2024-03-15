<?php
session_start();
require "../connection.php";

if(isset($_POST['Approve'])){
      
    $reservation_id = $_POST['reservation_id'];

    $select = "UPDATE reservations SET status = 'Approved' WHERE reservation_id = '$reservation_id'";
    $query_run = mysqli_query($con, $select);

    if($query_run) {
        $_SESSION['status'] = "Reservation Has been Approved!";
        $_SESSION['status_code'] = "success";
        header('Location: pending.php'); 
    }

}

if(isset($_POST['Reject'])){
      
    $reservation_id = $_POST['reservation_id'];
    $select = "UPDATE reservations SET status = 'Reject' WHERE reservation_id = '$reservation_id'";
    $query_run = mysqli_query($con, $select);

    if($query_run) {
        $_SESSION['status'] = "Reservation Has been Reject!";
        $_SESSION['status_code'] = "success";
        header('Location: pending.php'); 
    }

}


?>



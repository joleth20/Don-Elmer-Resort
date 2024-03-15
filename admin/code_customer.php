
<?php

session_start();
require "../connection.php";

// Customer

// Update Customer

if(isset($_POST['updatebtn']))
{
$customer_id = $_POST['customer_id'];
$firstname = $_POST['edit_firstname'];
$number = $_POST['edit_number'];
$lastname = $_POST['edit_lastname'];
$email = $_POST['edit_email'];
$password = $_POST['edit_password'];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$query = "UPDATE customer SET firstname='$firstname', lastname='$lastname', number='$number', email='$email', password='$hashed_password' WHERE customer_id='$customer_id' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['status'] = "Your Customer Data is Updated";
    $_SESSION['status_code'] = "success";
    header('Location: customer_account.php'); 
}
else
{
    $_SESSION['status'] = "Your Customer Data is NOT Updated";
    $_SESSION['status_code'] = "error";
    header('Location: customer_account.php'); 
}
}

?>

<!-- End-update -->

<!-- Delete -->
<?php
if(isset($_POST['delete_btn']))
{
$customer_id = $_POST['delete_id'];
$query = "DELETE FROM customer WHERE customer_id='$customer_id' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['status'] = "Your Data is Deleted";
    $_SESSION['status_code'] = "success";
    header('Location: customer_account.php'); 
}
else
{
    $_SESSION['status'] = "Your Data is NOT DELETED";
    $_SESSION['status_code'] = "error";
    header('Location: customer_account.php'); 
}
}
?>






<!-- Delete expense -->
<?php
if(isset($_POST['delete_expense']))
{
$ID = $_POST['delete_id'];
$query = "DELETE FROM tblexpense WHERE ID = '$ID' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['status'] = "Expenses record successfully Deleted";
    $_SESSION['status_code'] = "success";
    header('Location: expense.php'); 
}

}
?>

<!-- Delete Income -->
<?php

if(isset($_POST['delete_income']))
{
$id = $_POST['delete_id'];
$query = "DELETE FROM tblincome WHERE id_income = '$id' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['status'] = "Income record successfully Deleted";
    $_SESSION['status_code'] = "success";
    header('Location: income.php'); 
}

}


?>


<!-- Delete Query -->
<?php

if(isset($_POST['delete_btn']))
{
$id = $_POST['delete_id'];
$query = "DELETE FROM contact WHERE id = '$id' ";
$query_run = mysqli_query($con, $query);

if($query_run)
{
    $_SESSION['status'] = "Query record successfully Deleted";
    $_SESSION['status_code'] = "success";
    header('Location: queries.php'); 
}

}


?>













<?php
require "../connection.php";
session_start();

$CurrentUser =  $_SESSION['admin_id'];

$sql = "SELECT * FROM admin WHERE admin_id = '$CurrentUser'  ";
$admin_id = $con->query($sql) or die ($con->error);
$row = $admin_id->fetch_assoc();

$date = isset($_GET['date']) ? $_GET['date'] : '';

if(isset($_GET['Date'])){
    $date = $_GET['Date'];
}

// Check if the user has a profile image
$profileImage = !empty($row['img']) && file_exists('upload/' . $row['img']) ? 'upload/' . $row['img'] : 'img/admin-profile.png';
?>
   
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="<?php echo $profileImage; ?>" type="image/x-icon">
  <meta name="description" content="">
  <meta name="author" content="">
  <title> Admin - <?php echo $row['firstname']  ?> <?php echo $row['lastname']  ?></title>



  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">




  <style>

.dropdown-list.dropdown-menu.dropdown-menu-right.shadow.animated--grow-in .dropdown-header{
font-size:15px; 
border-bottom: 1px solid rgba(255, 255, 255, 0.5);
}
 
.mark-as-all-seen{
  text-align:center;
  background-color:#4e73df;
}


.mark-as-all-seen a{
  color:#FFFF;
  text-decoration:none;
}


.mark-as-all-seen a:hover {
    background-color: rgba(255, 255, 255, 0.5); 
    border-radius:2px;
}

 
.clickable-row{
  background-color:#4e73df;
  color:#FFFF;
  padding:10px 30px;
}

.reservation-row{
  background-color:#4e73df;
  color:#FFFF;
  padding:10px 30px;
}

.reservation-row .left img{
   border-radius:100px;
   width:70px;
   height:70px;
}

.fas.fa-bell.fa-fw{
  font-size: 23px;
}

.count{
  background-color: red; 
  color:#FFFF;
  text-align: center;
  width:20px; 
  font-size:15px; 
  border-radius:50px; 
  margin-left:-15px;
}


.no-notifications{
  background-color:#4e73df;
  color:#FFFF;
  text-align:center;
  padding:10px 30px;
}

  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

error_reporting(0);


if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $account = $_POST['account'];
  $amount = $_POST['amount'];
  $date_income = $_POST['date_income'];
          
  $query = "INSERT INTO tblincome (name, account, amount, date_income) VALUES ('$name','$account','$amount','$date_income')";

       $query_run = mysqli_query($con, $query);

  if ($query_run) {
      $_SESSION['status'] = "Income has been added!";
      $_SESSION['status_code'] = "success";
      header('Location: add_income.php');
  
  } else {
    $_SESSION['status'] = 'Something went wrong. Please try again';
      $_SESSION['status_code'] = "error";
      header('Location: add_income.php');
      
  }


}



?>


<head>


    <style>
 .sidebar-dark .nav-item #nav-link-income {
    background-color: #00308F;
  color: rgba(255, 255, 255, 0.8);
}

form{
        padding:30px 60px;
    }

    .form-group{
        width:700px;
    }


    </style>



</head>

<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Income</h6>
            <form role="form" method="post" action="add_income.php">
								<div class="form-group">

                <div class="form-group">
									<label>Name</label>
									<input class="form-control" type="text" value="" required="true" name="name" >
								</div>
                <div class="form-group">
									<label>Account Category</label>
                  <select name="account" class="form-control" required="true">
                  <option  >GCash</option>
                  <option >Paypal</option>
                  <option >Credit Card</option>
                  </select>
								</div>
                
                <div class="form-group">
									<label>Amount</label>
									<input class="form-control" type="number" value="" required="true" name="amount" >
								</div>
									<label>Date of Income</label>
									<input class="form-control" type="date" value="" name="date_income" required="true">
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add Income</button>
								</div>
								
								
								</div>
								
							</form>
              <div>

</div>
</div>
</div>


<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
<?php
include('includes/header.php'); 
include('includes/navbar.php'); 

error_reporting(0);
if(isset($_POST['submit']))
  {
    $dateexpense=$_POST['dateexpense'];
     $item=$_POST['item'];
     $costitem=$_POST['costitem'];
    $query=mysqli_query($con, "INSERT into tblexpense(ExpenseDate,ExpenseItem,ExpenseCost) value('$dateexpense','$item','$costitem')");

    
    // your code...
    
    if ($query) {
         $_SESSION['status'] = 'Expense has been added';
        $_SESSION['status_code'] = 'success';
        header('Location: add_income.php');
    } else{
      $_SESSION['status'] = 'Something went wrong. Please try again';
      $_SESSION['status_code'] = 'error';
      header('Location: add_income.php');
    }
}


    

?>


<head>


    <style>
 .sidebar-dark .nav-item #nav-link-expense {
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
            <h6 class="m-0 font-weight-bold text-primary">Expense</h6>
            <form role="form" method="post" action="add_expense.php">
								<div class="form-group">

                <div class="form-group">
									<label>Amount</label>
									<input class="form-control" type="number" value="" required="true" name="costitem">
								</div>

                <div class="form-group">
									<label>Expense Category</label>
                  <select name="item" id="" class="form-control" required="true">
                  <option  >Water Bill</option>
                  <option >Electricity</option>
                  <option >Gas</option>
                  <option >Maintenace and repairs</option>
                  <option >Property Taxes</option>
                  <option >Supplies and inventory</option>
                  <option >Salaries and wages</option>
                  </select>
								</div>
									<label>Date of Expense</label>
									<input class="form-control" type="date" value="" name="dateexpense" required="true">
								</div>
																
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="submit">Add Expense</button>
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
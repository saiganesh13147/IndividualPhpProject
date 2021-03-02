<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Mobi Shop</title>
  </head>
  <body>
  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Mobi Shop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="store.php">Store</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="checkout.php">Checkout  <span class="sr-only">(current)</span></a>
      </li>
    
    </ul>
  </div>
</nav>

<div class="container-fluid mt-4 mb-5">
    <h1 class="text-center">Checkout Store</h1>
</div>

<?php

require("mysqli_connect.php");

$mobileID = $_GET['mobileid'];

if(empty($mobileID)){

    header("Location: store.php");

}
else {

$query = "select * from MobileStoreDetails where mobileid = ?";

$stmt = mysqli_prepare($dbc, $query);

mysqli_stmt_bind_param($stmt,'s',$mobileID);

mysqli_stmt_execute($stmt);

$result =  mysqli_stmt_get_result($stmt);

while($row = mysqli_fetch_assoc($result)){

    echo "<div class='container'><h3 class='text-center'>
    You have selected " . $row['mobilename'] . " for Checkout Option<h3></div>";
    $price = $row['price'];
    $quantityinstock = $row['quantitystock'];
    
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $errors = [];

    if(empty($firstname)){
        $errors[] = "Error 1";
        echo "<div class='container'><p class='alert-danger'>Please Enter your First Name </p></div>";
         
     }
     if(empty($lastname)){
        $errors[] = "Error 2";
        echo "<div class='container'><p class='alert-danger'>Please Enter your Last Name </p></div>";
         
     }
     if(empty($errors)){
     
        $quantityinstock = $quantityinstock - 1; 

        //INSERT to MobileStoreDetailsOrder Table

        $query1 = "INSERT INTO MobileStoreDetailsOrder (mobileid,customer_firstname,customer_lastname) VALUES (?, ?, ?)";
        
        $istmt = mysqli_prepare($dbc, $query1);

        mysqli_stmt_bind_param($istmt,'sss',$mobileID, $firstname , $lastname );

        mysqli_stmt_execute($istmt);

        $query2 = "UPDATE MobileStoreDetails SET quantitystock = ? where mobileid = ?";

        $ustmt = mysqli_prepare($dbc, $query2);

        mysqli_stmt_bind_param($ustmt,'is', $quantityinstock , $mobileID);

        mysqli_stmt_execute($ustmt);

        if(mysqli_error($dbc)){

            echo "<div class='container'><p class='alert-danger'>Order Not Placed  </p></div>";        
        }
        else {

            echo "<div class='container'><p class='alert-success'>Order Placed!! Redirecting..</p></div>";
            mysqli_close($dbc);
        
            header("Location: index.php");

        }

     }
   
    

}

    
}


?>
<div class='container'>
<form method='post'>
  <div class="form-group">
    <label for="fname">FirstName</label>
    <input type="text" class="form-control" name="fname" placeholder="Enter First Name" value="<?php if(isset($_POST['fname'])){echo $_POST['fname'];}  ?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your Details with anyone else.</small>
  </div>

  <div class="form-group">
    <label for="lname">Last Name</label>
    <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php if(isset($_POST['lname'])){echo $_POST['lname']; }  ?>" >
  </div>

<div><label for="payment">Payment Method: </label>
<div>
<input type="radio" name="payment" value="Debit"<?php if(isset($_POST['payment']) && $_POST['payment'] == "Debit" ){ echo 'checked="checked"'; } ?>> Debit/Credit Card
<input type="radio" name="payment" value="Cash"<?php if(isset($_POST['payment']) && $_POST['payment'] == "Cash" ){ echo 'checked="checked"'; } ?>> Cash</div>
</div>

<button type="submit" class="btn btn-secondary">Order</button>
  
</form>
</div>
</body>
  
</html>
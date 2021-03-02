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
        <a class="nav-link" href="index.php">Home </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="store.php">Store<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="checkout.php">Checkout</a>
      </li>
    
    </ul>
  </div>
</nav>

<div class="container-fluid mt-4 mb-5">
    <h2 class="text-center">Mobi Store Products</h2>
</div>

<?php

require("mysqli_connect.php");
session_start();

$query = "select * from MobileStoreDetails";

$result = mysqli_query($dbc, $query);
echo "<div class='d-flex justify-content-around flex-row bd-highlight mb-3'>";
 
while ($row = mysqli_fetch_assoc($result)) {

   echo "<div class='p-4 border border-light bd-highlight'>";
   echo "<div class='card h-100' style='width: 18rem;'>";
   echo "<img class='card-img-top' src='". $row['imgsrc'] ."' alt='Card image cap'>";
   echo "<div class='card-body'>";
   echo "<h5 class='card-title'>". $row['mobilename'] ."</h5>";
   echo "<p class='card-text'>". $row['company'] ."</p>";
   echo "<p class='card-text font-weight-bold'>$". $row['price'] ."</p>";
   echo "<p class='card-text'>". $row['manufactureryear'] ."</p>";

   echo "<a href='checkout.php?mobileid=". $row['mobileid'] ."' class='btn btn-primary'>Go to Checkout</a>";
   echo "</div></div></div>";

}

echo "</div>";

?>


 
  </body>
  
</html>
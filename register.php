<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input from the registration form
    $username = mysqli_real_escape_string($con, $_POST['user']);
    $email = mysqli_real_escape_string($con, $_POST['Email']);
    $password = mysqli_real_escape_string($con, $_POST['Password']);
    $address = mysqli_real_escape_string($con, $_POST['Address']);
    $address2 = mysqli_real_escape_string($con, $_POST['Address2']);
    $city = mysqli_real_escape_string($con, $_POST['inputCity']);
    $zipcode = mysqli_real_escape_string($con, $_POST['inputZipCode']);
    $payment_method = mysqli_real_escape_string($con, $_POST['paymentOption']);

    // SQL query to insert user data into the capyusers table (i copied it from the database to avoid any errors)
    $sql = "INSERT INTO `capyusers`(`username`, `password`, `email`, `address1`, `address2`, `city`, `zipcode`, `payment_method`) 
            VALUES ('$username', '$password', '$email', '$address', '$address2', '$city', '$zipcode', '$payment_method')";

    // Execute the insert query
    $result = mysqli_query($con, $sql);

    if ($result) {
        header("Location: register.php");
    } else {
        echo "Data insertion failure";
        die(mysqli_error($con));
    }
}
?>




<!DOCTYPE html>
<html>


<head>
  <meta charset="UTF-8">
  <meta name="capybara" content="capybara registration page">
  <title>register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="CapyImages/favicon.png">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/register.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> <!-- google fonts --> 
  <script src="https://kit.fontawesome.com/2315d357ec.js" crossorigin="anonymous"></script> <!-- for icons - fontawesome -->
</head>


<body>
  <header class="my-header">
    <nav class="navbar bg-body-tertiary ">
      <a href="index.php">
        <img src="CapyImages/logoo.png" alt="capybara logo">
      </a>
      <h1> HAPPYCAPY </h1>
      <div class="container-fluid">
        <a class="navbar-brand" href="login.php">Login</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">HAPPYCAPY</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.ph">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Categories
                </a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="products.php">clothing</a></li>
                  <li><a class="dropdown-item" id="stickers" href="">stickers</a></li>
                  <li><a class="dropdown-item" id="plushies" href="">plushies</a></li>
                  <!--  the only category added is the clothing category  -->
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <main>
  <form action="" method="POST">  <!-- (method="POST") specifies the HTTP POST method will be used to send the data -->
   <!-- (action="")the PHP code for form processing is in the same file -->
      <br>
      <div class="name">
        <div class="username">
          <label for="user">username</label>
          <input type="text" id="user"  name="user" placeholder="ramamia" required>
        </div>
      </div>
      <br>
      <div class="details">
        <div class="EmailPass">
          <label for="Email">Email</label>
          <input type="email" id="Email" name="Email"  placeholder="ramaselwadi@gmail.com"required>
        </div>
        <br>
        <div class="EmailPass">
          <label for="Password">Password</label>
          <input type="password" id="Password" name="Password"  placeholder="sV12@j#4t" required>
        </div>
      </div>
      <br>
      <div class="address">
        <label for="Address">Address</label>
        <input type="text" id="Address"  name="Address" placeholder="1234 Main St" required>
      </div>
      <br>
      <div class="address">
        <label for="Address2">Address 2</label>
        <input type="text" id="Address2" name="Address2" placeholder="Apartment, studio, or floor" >
        <!-- another address doesnt need to be added -->
      </div>
      <br>
      <div class="place">
        <div class="city">
          <label for="inputCity">City</label>
          <input type="text" id="inputCity" name="inputCity" placeholder="Newyork city"  required>
        </div>
        <br>
        <div class="zipcode">
          <label for="inputZipCode">Zip Code</label>
          <input type="text" id="inputZipCode" name="inputZipCode" placeholder="10005 (only 5 digits)"  required>
        </div>
      </div>

      <br>
      <div class="paymentDetalis">
        <legend>payment method</legend>
        <div class="payment">
          <div class="payment1">
            <input class="payment1" type="radio" name="paymentOption" id="gridRadios1" value="Debit card" checked>
            <label class="payment1" for="gridRadios1">
              Debit card
            </label>
          </div>
          <div class="payment2">
            <input class="payment2" type="radio" name="paymentOption" id="gridRadios2" value="PayPal">
            <label class="payment2" for="gridRadios2">
              PayPal
            </label>
          </div>
        </div>
        <!-- By setting the name attribute to the same
         value ("paymentOption"), i created a radio button group, to ensure
         that usres can only choose one option from the group. -->
      </div>
      <br>
      <div class="lastStep">
        <div class="checkTerms">
          <input type="checkbox" id="gridCheck" required>
          <label class="checkForm" for="gridCheck">
            terms and conditions
          </label>
        </div>
      </div>
      <br>
      <button type="submit" class="submitBtn">Sign in</button>
    </form>


  </main>

  <footer>
    <hr>
    <p> <i class="fa-regular fa-face-smile-wink"></i> capybara is the coolest animal <i
        class="fa-regular fa-face-laugh-wink"></i> </p>
    <div class="containerFooter">
      <img src="CapyImages/1.jpg" alt="capybara pic1" width="170" height="190">
      <img src="CapyImages/2.jpg" alt="capybara pic2" width="170" height="190">
      <img src="CapyImages/3.jpg" alt="capybara pic3" width="170" height="190">
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
    <script src="javascript/register.js"></script>
</body>

</html>

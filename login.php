<?php
require("connect.php");
session_start();

// Initialize $arr as an empty array
$arr = [];

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM capyusers WHERE username='$username' AND password='$password';";
    $capydetails = mysqli_query($con, $sql);

    // Check if any rows are returned
    if (mysqli_num_rows($capydetails) > 0) {
        // User is authenticated
        $_SESSION['privilleged'] = $username;
        header("Location: cart.php");  // Redirect to the cart page or any other page you want
        exit();
    } else {
        echo "Invalid username or password";
    }
}

//add $hashedPassword = password_hash($password, PASSWORD_DEFAULT); for security
?>



<!DOCTYPE html>
<html>


<head>
  <meta charset="UTF-8">
  <meta name="capybara" content="width=device-width, intitial-scale=1.0">
  <title>login</title>
  <link rel="icon" type="image/x-icon" href="CapyImages/favicon.png">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> <!-- googlefonts -->
  <script src="https://kit.fontawesome.com/2315d357ec.js" crossorigin="anonymous"></script>  <!-- fontawesome-icons -->
</head>


<body>
  <header class="my-header">
    <nav class="navbar bg-body-tertiary ">
      <a href="index.php">
        <img src="CapyImages/logoo.png" alt="capybara logo">
      </a>
      <h1> HAPPYCAPY </h1>
      <div class="container-fluid">
      <?php

    if (isset($_SESSION['privilleged'])) {
        // If user is logged in, display a greeting and a logout link
        echo '<a class="navbar-brand" href="#">user logged in: <span class="user-greeting">' . $_SESSION['privilleged'] . '</span></a>';
        echo '<a class="navbar-brand" href="signout.php">Logout</a>';
    }/* else{
      echo '<a class="navbar-brand" href="login.php">Login</a>';
    } */
    ?>
        
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
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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

    <section class="input">

      <form action="" method="POST">
        <h1>Login</h1>
        <div class="BoxIn">
          <label for="username">Username</label>
          <input type="text"  name="username"  placeholder="ex.Ramamia" id="username"required />
          <i class="fa-solid fa-user"></i>
        </div>

        <div class="BoxIn">
          <label for="password">Password</label>
          <input type="password"  name="password"  placeholder="ex.ya7s6ake" id="password" required />
          <i class="fa-solid fa-lock"></i>
        </div>

        <div class="Remember">
          <label><input type="checkbox" checked> Remember me!!</label>
        </div>

        <button type="submit" class="MyBtn" name="login"> Login </button>
        <div class="Register">
          <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
      </form>
    </section>
    <br>

  </main>

  <footer>
    <hr>
    <p> <i class="fa-regular fa-face-smile-wink"></i> capybara is the coolest animal <i
        class="fa-regular fa-face-laugh-wink"></i> </p>
    <div class="containerFooter">
      <img src="CapyImages/4.jpg" alt="capybara pic1" width="170" height="190">
      <img src="CapyImages/5.jpg" alt="capybara pic2" width="170" height="190">
      <img src="CapyImages/6.jpg" alt="capybara pic3" width="170" height="190">
    </div>
  </footer>

  <script src="javascript/login.js"></script>
</body>



</html>

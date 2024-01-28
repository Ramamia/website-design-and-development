<?php
include("connect.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['privilleged'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['privilleged'];

// get user's orders from the database
$sql = "SELECT o.id, o.product_title, o.product_price, o.product_image, o.product_quantity
        FROM orders o
        JOIN capyusers u ON o.username = u.username
        WHERE u.username = ?";

$stmt = mysqli_prepare($con, $sql);

// Bind the parameter
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


?> 
 


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, intitial-scale=1.0">
  <title>cart </title>
  <!--  the little icon at the top beside the website's title -->
  <link rel="icon" type="image/x-icon" href="CapyImages/favicon.png">
  <link rel="stylesheet" href="css/reset.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/cart.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!--google fonts -->
  <script src="https://kit.fontawesome.com/2315d357ec.js" crossorigin="anonymous"></script> <!-- for the icons -->
  <script src="cart.js"></script>
</head>

<body>
  <header class="my-header">
    <nav class="navbar bg-body-tertiary ">
      <!-- i got the navbar from bootstrap -->
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
}else{
  echo '<a class="navbar-brand" href="login.php">Login</a>';
}
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

  <div class="HahaContainer">
  <form action="updateproduct.php" method="post">

    <table>
      <tr>
        <!-- main row at the top -->
        <th scope="col">Product</th> <!-- product title + remove link to remove the product from the cart -->
        <th scope="col">Quantity</th> <!-- the quantity for the selected product -->
        <th scope="col">Update</th> <!-- update button when the customer updates the quantity -->
        <th scope="col">Subtotal</th> <!-- each product's price -->
      </tr>
    
      </tr>

<?php
$subtotal = 0;
$total = 0;
$tax = 8.27;
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $product_name = $row['product_title'];
    $product_quantity = $row['product_quantity'];
    $product_price = $row['product_price'] * $product_quantity;
    $subtotal += $product_price;
    $total = $subtotal + $tax ;
?>
   <tr>
      
        <td>
       
          <div class="CartInfo">
            <img src="<?php echo $row['product_image']; ?>" alt="<?php echo $product_name; ?>" width="160" height="160">
            <div>
              <p><?php echo $product_name; ?></p>
              <a class="remove" href="deleteproduct.php?id=<?php echo $id; ?>">Remove</a>
            </div>
          </div>
        </td>
        <td><input type="number" name="product_quantity[<?php echo $id; ?>]" value="<?php echo $product_quantity; ?>" min="1" max="10"></td>
        <td>
        
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                        <button type="submit" class="update" name="update_product">Update</button>
                    </form>
        </td>
        <td>$<?php echo number_format($product_price, 2); ?></td>
      </tr>

      
      <?php
            }
            ?>
     <!--  
        
    <tr>
      
        <td>
          <div class="CartInfo">
            <img src="CapyImages/product3.png" alt="product3" width="160" height="160">
            <div>
              <p>Capybara rodent Hoodie</p>
              <a class="remove" href="">Remove</a>
            </div>
          </div>
        </td>
        <td><input type="number" value="1"></td>
        <td>
          <button class="update">Update</button>
        </td>
        <td>$31.99</td>
      </tr>

      <tr>
        
        <td>
          <div class="CartInfo">
            <img src="CapyImages/product4.png" alt="product4" width="160" height="160">
            <div>
              <p>Capybara pijama onesie</p>
              <a class="remove" href="">Remove</a>
            </div>
          </div>
        </td>
        <td><input type="number" value="1"></td>
        <td>
          <button class="update">Update</button>
        </td>
        <td>$46.99</td>
      </tr>

      <tr>
       
        <td>
          <div class="CartInfo">
            <img src="CapyImages/product8.png" alt="product8" width="160" height="160">
            <div>
              <p>Capybara colorful socks</p>
              <a class="remove" href="">Remove</a>
            </div>
          </div>
        </td>
        <td><input type="number" value="1"></td>
        <td>
          <button class="update">Update</button>
        </td>
        <td>$9.48</td>
      </tr> 
  -->
    </table>

    <div class="TotalPrice">
      <table>
        <tr>
          <br>
          <td>Subtotal</td>
          <td><?php echo "<p> $subtotal $<p/>"; ?></td>
        </tr>
        <tr>
          <!-- subtotal + tax -->
          <td>Total</td>
          <td><?php echo "<p> $total $<p/>"; ?></td>
        </tr>
      </table>
    </div>

  </div>

  <footer>
    <section class="footer-container">
      <!-- each pdf is filled with meaningful information for the website -->
      <div>
        <h3 id="information-menu">INFORMATION</h3>
        <ul class="menu1">

          <li class="menu1-item1">
            <a href="pdfs needed/about us.pdf">About us</a>
          </li>
          <li class="menu1-item2">
            <a href="pdfs needed/company profile.pdf">Company profile</a>
          </li>
          <li class="menu1-item3">
            <a href="pdfs needed/FAQs.pdf">FAQs</a>
          </li>

        </ul>
      </div>


      <div>
        <h3 id="policy-menu">POLICIES</h3>
        <ul class="menu2">

          <li class="menu2-item1">
            <a href="pdfs needed/privacy policy.pdf">privacy policy</a>
          </li>
          <li class="menu2-item2">
            <a href="pdfs needed/shipping policy.pdf">shipping policy</a>
          </li>
          <li class="menu2-item3">
            <a href="pdfs needed/return and exchange policy.pdf">return & exchange policy</a>
          </li>

        </ul>
      </div>


      <div>
        <h3 id="contact-menu">STAY CONNECTED</h3>
        <ul class="menu3">
          <!-- i used fontawesome for the icons -->
          <li class="menu3-item1">
            <a href="https://www.youtube.com/channel/UCjEXbtopxOQZgqlUJhF2E7w"> <i class="fa-brands fa-youtube"></i></a>
          </li>
          <li class="menu3-item2">
            <a href="https://www.instagram.com/happy._.capyy/"><i class="fa-brands fa-instagram"></i></a>
          </li>
          <li class="menu3-item3">
            <a href="https://twitter.com/ThaHappyCapy"><i class="fa-brands fa-twitter"></i></a>
          </li>

        </ul>

      </div>
    </section>
  </footer>
  <!-- the following cdn links are used for the elemnts that i took from bootstrap and require javascript to work better >>navbar -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
    <script src="javascript/cart.js"></script>
</body>

</html>

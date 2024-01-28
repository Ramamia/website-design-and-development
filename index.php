<?php
include("connect.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST['add_to_cart'] )){
if(isset($_SESSION['privilleged'])){
  $name= $_POST['product_title'];
  $price = $_POST['product_price'];
  $image = $_POST['product_image'];
  $quantity = $_POST['quantity'];
  $user = $_SESSION['privilleged'];

  // Updated SQL query for the `orders` table
  $sql = "INSERT INTO `orders`(`id`, `username`, `product_title`, `product_price`, `product_image`, `product_quantity`) 
  VALUES ('','$user', '$name', $price, '$image', $quantity)";
  
  $result = mysqli_query($con, $sql);

  if (!$result) {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
  }
} else {
  echo '<script>alert("Please sign in first")</script>';
}
}
?>

<!DOCTYPE html>
<html>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
  <!--  the little icon at the top beside the website's title -->
  <link rel="icon" type="image/x-icon" href="CapyImages/favicon.png">
  <link rel="stylesheet" href="css/reset.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/homepage.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!--google fonts -->
  <script src="https://kit.fontawesome.com/2315d357ec.js" crossorigin="anonymous"></script> <!-- for the icons -->
</head>

<body>
  <header class="my-header">
    <!-- i got the navbar from bootstrap but i added my style to it by defining the elements more specifically
    for example:- instead of .nav-item .nav-link{ my style } 
    i did .offcanvas-body .navbar-nav .nav-item .nav-link{my style} -->
    <nav class="navbar bg-body-tertiary ">
      <a href="index.php">
        <img src="CapyImages/logoo.png" alt="capybara logo">
      </a>
      <h1> HAPPYCAPY </h1>
      <div class="container-fluid">
      <?php
    if (isset($_SESSION['privilleged'])) {
        $user = $_SESSION['privilleged']; 
            echo '<a class="navbar-brand" href="#">user logged in: <span class="user-greeting">' . $_SESSION['privilleged'] . '</span></a>';
            echo '<a class="navbar-brand" href="cart.php">My Cart</a>';
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

  <main>
    <section id="slider">
      <br><br>
      <!-- i used bootstrap here for the slider-->
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <!-- each slide was designed using canva -->
          <div class="carousel-item active">
            <img class="d-block w-100" src="CapyImages/slider1.png" alt="First capy slide" width="180" height="300">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="CapyImages/slider2.png" alt="Second capy slide" width="180" height="300">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="CapyImages/slider3.png" alt="Third capy slide" width="180" height="300">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

    </section>

    <section id="popular-items">
      <h2 class="text-center">Popular Items</h2>
      <div class="container">
        <!-- product 1 -->
        <div class="item1">
          <div class="custom-item-listing">
            <img src="CapyImages/plushies1.jpg" alt="capybara plushies image">
            <p class="item1-description">Meet our huggable Capybara Plushies _ cuddly companions that capture the gentle
              spirit of capybaras. Perfect for all ages, these plush toys bring comfort and joy into your life with
              their soft fur and lovable expressions.</p>
            <div class="quantityBtnPrice">
              <p class="item1-price">$9.99</p>
              <label class="quantity" for="quantity2">Quantity:</label>
              <form method="post" action="">
              <input type="hidden" name="product_id" value="13">
                <input type="hidden" name="product_title" value="plushies">
              <input type="hidden" name="product_image" value="https://i.etsystatic.com/19110971/r/il/68bed2/5499705591/il_794xN.5499705591_dw3f.jpg"> 
    <input type="hidden" name="product_price" value="9.99">
    <input type="number"  name="quantity" value="1" min="1" max="10">
    <button type="submit" class="add-to-cart-btn" name="add_to_cart">Add to Cart</button>
</form>          
            </div>
          </div>
        </div>

        <!-- product 2 -->
        <div class="item2">
          <div class="custom-item-listing">
            <img src="CapyImages/blanket1.jpg" alt="capybara blanket image">
            <p class="item2-description">Wrap up in cozy cuteness with our Capybara Blanket. Soft and inviting, this
              blanket features adorable capybara illustrations, adding warmth and charm to your relaxation time.</p>
            <div class="quantityBtnPrice">
              <p class="item2-price">$14.59</p>
              <label class="quantity" for="quantity2">Quantity:</label>
              <form method="post" action="">
              <input type="hidden" name="product_id" value="14">
                <input type="hidden" name="product_title" value="capybara blanket">
              <input type="hidden" name="product_image" value="https://i.etsystatic.com/44377772/r/il/4f26b3/5576520161/il_1140xN.5576520161_avf1.jpg"> 
    <input type="hidden" name="product_price" value="14.59">
    <input type="number"  name="quantity" value="1" min="1" max="10">
    <button type="submit" class="add-to-cart-btn" name="add_to_cart">Add to Cart</button>
</form> 
            </div>
          </div>
        </div>

        <!-- product 3 -->
        <div class="item3">
          <div class="custom-item-listing">
            <img src="CapyImages/stickers1.jpg" alt="capybara stickers">
            <p class="item3-description">Personalize your world with our Capybara Sticker Pack. This set of 50 stickers
              showcases cute capybara poses, ideal for adding a playful touch to laptops, notebooks, and more. Spread
              the charm of these adorable creatures wherever you go!</p>
            <div class="quantityBtnPrice">
              <p class="item3-price">$6.28</p>
              <label class="quantity" for="quantity2">Quantity:</label>
              <form method="post" action="">
              <input type="hidden" name="product_id" value="15">
                <input type="hidden" name="product_title" value="capystickers">
              <input type="hidden" name="product_image" value="https://i.etsystatic.com/36870692/r/il/579927/4930368440/il_794xN.4930368440_fb7e.jpg"> 
    <input type="hidden" name="product_price" value="6.28">
    <input type="number"  name="quantity" value="1" min="1" max="10">
    <button class="add-to-cart-btn" type="submit" name="add_to_cart">Add to Cart</button>
</form> 
            </div>
          </div>
        </div>


      </div>


    </section>
    <hr>
   

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
          <!-- i didnt have time to create a youtube chanel for the website -->
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

 <!-- the following cdn links are used for the elemnts that i took from bootstrap and require javascript to work better >>slider +navbar -->
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
    <script src="javascript/homepage.js"></script>
</body>


</html>

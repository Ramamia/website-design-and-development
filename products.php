<?php
include("connect.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['privilleged'])) {
        $name = $_POST['product_title'];
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
  <meta name="capybara" content="width=device-width, intitial-scale=1.0">
  <title>products</title>
    <!--  the little icon at the top beside the website's title -->
  <link rel="icon" type="image/x-icon" href="CapyImages/favicon.png">
  <link rel="stylesheet" href="css/reset.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="css/products.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> <!--google fonts -->
  <script src="https://kit.fontawesome.com/2315d357ec.js" crossorigin="anonymous"></script> <!-- for the icons -->
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
    <br><br>
    <h1>Clothing</h1>
    <div class="mainContainer">
      <section class="productsCon1">

        <div class="product1">
           <img src="CapyImages/product1.png" alt="Capybara Plush Slippers" width="190" height="190">
          <h3>Capybara plush slippers</h3>
          <p>Indulge in coziness with these adorable Capybara Plush Slippers. Ideal for keeping your feet stylishly warm
            during chilly nights. Crafted for maximum comfort, these slippers are a perfect choice for relaxation.</p>
          <p class="price">Price: $11.69</p> 

         <!-- hidden form + add to cart button -->
         <form method="post" action="">
    <input type="hidden" name="product_id" value="1">
    <input type="hidden" name="product_title" value="Capybara Plush Slippers">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/37524066/r/il/71d44e/5607516471/il_340x270.5607516471_b0o8.jpg"> 
    <input type="hidden" name="product_price" value="11.69">
    <input type="number"  name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
</div>

        <div class="product2">
          <img src="CapyImages/product2.png" alt="FunkySocks" width="190" height="190">
          <h3>Funky Capybara socks</h3>
          <p>Infuse your outfit with capybara charm using these Funky Capybara Socks. Made from breathable fabric, they
            blend comfort with style. Express your love for capybaras in a uniquely fun way.</p>
          <p class="price">Price: $8.99</p>

           <!-- hidden form + add to cart button -->
          <form method="post" action="">
    <input type="hidden" name="product_id" value="2">
    <input type="hidden" name="product_title" value="FunkySocks">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/44239437/r/il/081536/5018924746/il_794xN.5018924746_j3n6.jpg"> 
    <input type="hidden" name="product_price" value="8.99">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

        <div class="product3">
          <img src="CapyImages/product3.png" alt="CookingShirt" width="190" height="190">
          <h3>Capybara Cooking Shirt</h3>
          <p>Unleash your inner chef with our Capybara Cooking Shirt! that adds a delightful addition to your wardrobe
            but also a perfect companion for your culinary adventures with an adorable capybara design with a touch of
            humor.</p>
          <p class="price">Price: $24.699</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="3">
    <input type="hidden" name="product_title" value="CookingShirt">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/9386458/r/il/595946/5698061525/il_794xN.5698061525_e60j.jpg"> 
    <input type="hidden" name="product_price" value="24.69">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

        <div class="product4">
          <img src="CapyImages/product4.png" alt="pijamaOnesie" width="190" height="190">
          <h3>Capybara pijama onesie</h3>
          <p>Embrace ultimate comfort with the Capybara Pajama Onesie. Perfect for lounging or cozy sleepovers. Crafted
            from soft, breathable fabric, this onesie seamlessly combines cuteness and comfort.</p>
          <p class="price">Price: $31.99</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="4">
    <input type="hidden" name="product_title" value="pijamaOnesie">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/37524066/r/il/3fd485/5607475375/il_794xN.5607475375_dy1k.jpg"> 
    <input type="hidden" name="product_price" value="31.99">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

      
      </section>
      <section class="productsCon2">
        <div class="product5">
          <img src="CapyImages/product5.png" alt="Capy christmas sweater" width="190" height="190">
          <h3>Capy christmas sweater</h3>
          <p>Spread holiday cheer with the Capy Christmas Sweater. Featuring an adorable capybara design, this sweater
            is festive and cozy. Embrace the holiday spirit in this delightful Christmas sweater.</p>
          <p class="price">Price: $22.89</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="5">
    <input type="hidden" name="product_title" value="ChristmaSweater">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/48371179/r/il/827edb/5634371989/il_794xN.5634371989_c0uv.jpg"> 
    <input type="hidden" name="product_price" value="22.89">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

        <div class="product6">
          <img src="CapyImages/product6.png" alt="Capybara sweatshirt" width="190" height="190">
          <h3>Capybara rodent sweatshirt</h3>
          <p>Elevate your casual look with the Capybara Rodent Sweatshirt. Designed for comfort and style, this
            sweatshirt is a must-have for capybara enthusiasts. Whether you're heading out or staying in, this
            sweatshirt makes a statement.</p>
          <p class="price">Price: $21.99</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="6">
    <input type="hidden" name="product_title" value=" CapybaraSweatshirt">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/16591606/c/1360/1080/324/210/il/e17b5a/5582119892/il_340x270.5582119892_1usy.jpg"> 
    <input type="hidden" name="product_price" value="21.99">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

        <div class="product7">
          <img src="CapyImages/product7.png" alt="embroideredCrewneck" width="190" height="190">
          <h3>Capybara embroidered crewneck</h3>
          <p>Add a touch of sophistication to your wardrobe with the Capybara Embroidered Crewneck. Featuring intricate
            embroidery and a classic design, this crewneck is versatile and stylish. </p>
          <p class="price">Price: $23.38</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="7">
    <input type="hidden" name="product_title" value="embroideredCrewneck">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/21874361/r/il/201269/5312092078/il_794xN.5312092078_6ccp.jpg"> 
    <input type="hidden" name="product_price" value="23.38">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

        <div class="product8">
          <img src="CapyImages/product8.png" alt="colorfulSocks" width="190" height="190">
          <h3>Capybara colorful socks</h3>
          <p>Step into comfort and vibrancy with these Capybara Colorful Socks. The playful design and vibrant colors
            add a cheerful touch to your outfit. Made with quality materials, these socks are a delightful addition to
            your sock collection.</p>
          <p class="price">Price: $9.48</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="8">
    <input type="hidden" name="product_title" value="colorfulSocks">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/17981695/r/il/ce2e28/5002986195/il_340x270.5002986195_e4hz.jpg"> 
    <input type="hidden" name="product_price" value="9.48">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>
      </section>

      <section class="productsCon3">
        <div class="product9">
          <img src="CapyImages/product9.png" alt="EmbroideredBeanie" width="190" height="190">
          <h3>Capybara Embroidered Beanie</h3>
          <p>Elevate your winter style with our Capybara Embroidered Beanie! This cozy and stylish beanie features a
            beautifully embroidered capybara design, adding a touch of charm to your cold-weather wardrobe. Crafted for
            comfort and warmth!</p>
          <p class="price">Price: $7.99</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="9">
    <input type="hidden" name="product_title" value="EmbroideredBeanie">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/25401748/r/il/3324fb/4697838177/il_794xN.4697838177_adjl.jpg"> 
    <input type="hidden" name="product_price" value="7.99">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

        <div class="product10">
          <img src="CapyImages/product10.png" alt="Sweatpants" width="190" height="190">
          <h3>Cute Capybara Men's Sweatpants Casual Joggers</h3>
          <p>Introducing our Cute Capybara Men's Sweatpants, the perfect blend of comfort and style for your casual
            wardrobe. Ideal for lounging or running errands, these sweatpants add a playful touch to your look.</p>
          <p class="price">Price: $16.73</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="10">
    <input type="hidden" name="product_title" value="Cute Capybara Men\'s Sweatpants Casual Joggers">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/42894511/r/il/97e1e9/4891256419/il_794xN.4891256419_1mtb.jpg"> 
    <input type="hidden" name="product_price" value="16.73">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

        <div class="product11">
          <img src="CapyImages/product11.png" alt="BrownHoodie" width="190" height="190">
          <h3>brown Capybara Cute hoodie</h3>
          <p>Introducing our adorable Brown Capybara Cute Hoodie! stay cozy and stylish with this cute hoodie featuring
            a charming capybara design. Crafted with comfort in mind, it's perfect for everyday wear, adding a touch of
            cuteness to your outfit.</p>
          <p class="price">Price: $13.48</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="11">
    <input type="hidden" name="product_title" value="BrownHoodie">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/36131078/r/il/328ed3/4675800992/il_794xN.4675800992_jn2y.jpg"> 
    <input type="hidden" name="product_price" value="13.48">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>

        <div class="product12">
          <img src="CapyImages/product12.png" alt="HawaiianShirt" width="190" height="190">
          <h3>Capybara Printed Hawaiian Shirt</h3>
          <p>Elevate your summer style with the Capybara Printed Hawaiian Shirt. Infused with humor and tropical vibes,
            this shirt is perfect for beach days or casual outings. A great gift for rodent animal lovers to showcase
            their aloha spirit.</p>
          <p class="price">Price: $19.78</p>
          
           <!-- hidden form + add to cart button -->
           <form method="post" action="">
    <input type="hidden" name="product_id" value="12">
    <input type="hidden" name="product_title" value="HawaiianShirt">
    <input type="hidden" name="product_image" value="https://i.etsystatic.com/17203559/r/il/9a75e8/5118504279/il_794xN.5118504279_oe1u.jpg"> 
    <input type="hidden" name="product_price" value="19.78">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
        </div>
      </section>

    </div>
  </main>
  <hr>
  <footer>
  <section class="footer-container">
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
  <script src="javascript/products.js"></script>
</body>



</html>

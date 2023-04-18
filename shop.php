<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="manifest" href="manifest.json" />
  <link rel="icon" href="assets/images/favicon/2.png" type="image/x-icon" />
  <link rel="apple-touch-icon" href="assets/images/favicon/4.png" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/4138468106.js" crossorigin="anonymous"></script>

  <title>The Farmer's Market</title>
</head>

<body>
  <!-- Header start -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/logo.png" style="width: 120px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <?php if (isset($_SESSION['username'])): ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Log In</a>
            </li>
            
          <?php endif ?>
          <li class="nav-item">
            <a class="nav-link" href="admin/login.php">Admin Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="farmer/login.php">Farmer Dashboard</a>
          </li>
          
        </ul>
      </div>
      <!-- Add this new div with the cart icon -->
      <div class="justify-content-end">
        <a class="nav-link" href="cart.php">
          <i class="fas fa-cart-plus" style="font-size: 25px;"></i> 
        </a>
      </div>
    </div>
  </nav>
  <!-- Header end -->

  <!-- Hero section  -->
  <section class="hero-section" style="background-image: url('assets/farm-3.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <img src="assets/logo.jpg" style="width: 250px; border-radius: 125px;">
          <h1 style="color: #fff; margin-top: 10%;">SHOP WITH US !</h1>
        </div>
      </div>
    </div>
  </section>


  <!-- Products section -->
  <section class="products-section mt-5">
    <div class="container">
      <div class="row ">
        <?php 
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
           ?>
           <div class="col-sm-4 mb-3 text-center">
            <!-- <img src="assets/milk.jpg"> -->
            <img src="admin/assets/product_images/<?php echo $row['image']; ?>">
            <p><?php echo $row['name']; ?> | $<?php echo $row['price']; ?></p>
            <form action="cart.php" method="POST">
             <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
             <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
             <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
             <button type="submit" name="add_to_cart" class="btn btn_submit">
               <i class="fas fa-cart-plus"></i>
             </button>
           </form>
         </div>
       <?php }} ?>
       <!-- <div class="col-sm-4 mb-3 text-center">
        <img src="assets/butter.jpg">
        <p>Butter | $14.00</p>
        <form action="cart.php" method="POST">
          <input type="hidden" name="product_id" value="2">
          <input type="hidden" name="product_name" value="Butter">
          <input type="hidden" name="product_price" value="14.00">
          <button type="submit" name="add_to_cart" class="btn btn_submit">
            <i class="fas fa-cart-plus"></i>
          </button>
        </form>
      </div> -->
     <!--  <div class="col-sm-4 mb-3 text-center">
        <img src="assets/eggs.jpg">
        <p>Eggs | $7.00</p>
        <form action="cart.php" method="POST">
          <input type="hidden" name="product_id" value="3">
          <input type="hidden" name="product_name" value="Eggs">
          <input type="hidden" name="product_price" value="7.00">
          <button type="submit" name="add_to_cart" class="btn btn_submit">
            <i class="fas fa-cart-plus"></i>
          </button>
        </form>
      </div> -->
    </div>
    <!-- <div class="row mt-3">
      <div class="col-sm-4 mb-3 text-center">
        <img src="assets/chicken.jpg">
        <p>Chicken | $15.00</p>
        <form action="cart.php" method="POST">
          <input type="hidden" name="product_id" value="4">
          <input type="hidden" name="product_name" value="Chicken">
          <input type="hidden" name="product_price" value="15.00">
          <button type="submit" name="add_to_cart" class="btn btn_submit">
            <i class="fas fa-cart-plus"></i>
          </button>
        </form>
      </div>
      <div class="col-sm-4 mb-3 text-center">
        <img src="assets/milk.jpg">
        <p>Milk | $5.00</p>
        <form action="cart.php" method="POST">
          <input type="hidden" name="product_id" value="1">
          <input type="hidden" name="product_name" value="Milk">
          <input type="hidden" name="product_price" value="5.00">
          <button type="submit" name="add_to_cart" class="btn btn_submit">
            <i class="fas fa-cart-plus"></i>
          </button>
        </form>
      </div>
      <div class="col-sm-4 mb-3 text-center">
        <img src="assets/butter.jpg">
        <p>Butter | $14.00</p>
        <form action="cart.php" method="POST">
          <input type="hidden" name="product_id" value="2">
          <input type="hidden" name="product_name" value="Butter">
          <input type="hidden" name="product_price" value="14.00">
          <button type="submit" name="add_to_cart" class="btn btn_submit">
            <i class="fas fa-cart-plus"></i>
          </button>
        </form>

      </div>
    </div> -->

  </div>
  <!-- Start of LiveChat (www.livechat.com) code -->
<script>
    window.__lc = window.__lc || {};
    window.__lc.license = 15338403;
    ;(function(n,t,c){function i(n){return e._h?e._h.apply(null,n):e._q.push(n)}var e={_q:[],_h:null,_v:"2.0",on:function(){i(["on",c.call(arguments)])},once:function(){i(["once",c.call(arguments)])},off:function(){i(["off",c.call(arguments)])},get:function(){if(!e._h)throw new Error("[LiveChatWidget] You can't use getters before load.");return i(["get",c.call(arguments)])},call:function(){i(["call",c.call(arguments)])},init:function(){var n=t.createElement("script");n.async=!0,n.type="text/javascript",n.src="https://cdn.livechatinc.com/tracking.js",t.head.appendChild(n)}};!n.__lc.asyncInit&&e.init(),n.LiveChatWidget=n.LiveChatWidget||e}(window,document,[].slice))
</script>
<noscript><a href="https://www.livechat.com/chat-with/15338403/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
<!-- End of LiveChat code -->
</section>


<!-- Footer start -->
<footer>
  <div class="container py-4 mt-5">
    <div class="row mb-5">
      <div class="col-md-12 text-center">
        <a class="navbar-brand" href="index.php"><img src="assets/logo.png" style="width: 120px;"></a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <h5>Shop</h5>
        <p><a href="">Fresh Crops</a></p>
        <p><a href="">Dairy Products</a></p>
        <p><a href="">Poultry</a></p>
        <p><a href="">Live Stock</a></p>
      </div>
      <div class="col-md-4">
        <h5>About</h5>
        <p><a href="">About Us</a></p>
        <p><a href="">Farm Management</a></p>
        <p><a href="">Contact Us</a></p>
        <p><a href="">Learn More</a></p>
        <p><a href="">Stores</a></p>
      </div>
      <div class="col-md-4">
        <h5>Contact Us</h5>
        <p><a href="mailto:group5@farmmngmnt.com">group5@farmmngmnt.com</a></p>
        <p><a href="tel:226 754 6785">226 754 6785</a></p>
        <p><a href="">Kitchener, ON.</a></p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12 text-center pt-4">
        <p><b>&copy; Copyright 2023 Farm Management System.</b></p>
      </div>
    </div>
  </div>
</footer>

</body>


</html>


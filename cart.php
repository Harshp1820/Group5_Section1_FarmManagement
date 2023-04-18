<?php
include 'config.php'; 

if(isset($_POST['add_to_cart'])) {
  // Create an array to store product details
  $product = array(
    'id' => $_POST['product_id'],
    'name' => $_POST['product_name'],
    'price' => $_POST['product_price'],
    'quantity' => 1 // Initialize quantity to 1
  );

  // Check if the cart is already set in the session
  if(isset($_SESSION['cart'])) {
    // Check if the selected product already exists in the cart
    $index = -1; // Initialize index to -1
    foreach($_SESSION['cart'] as $key => $value) {
      if($value['id'] == $_POST['product_id']) {
        $index = $key;
        break;
      }
    }
    if($index == -1) {
      // Add the selected product to the cart
      $_SESSION['cart'][] = $product;
      // Display an alert that the product was added to the cart
      echo "<script>alert('Product added to cart!')</script>";
    } else {
      // Update the quantity of the selected product in the cart
      $_SESSION['cart'][$index]['quantity']++;
      // Display a warning that the product is already in the cart
      echo "<script>alert('Product is already in the cart!')</script>";
    }
  } else {
    // Create a new cart in the session and add the selected product to it
    $_SESSION['cart'][] = $product;
    // Display an alert that the product was added to the cart
    echo "<script>alert('Product added to cart!')</script>";
  }
}

?>
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
            <li class="nav-item">
              <a class="nav-link" href="login.php">Log In</a>
            </li>
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
          <a class="nav-link" href="cart.php" active>
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
    

 <!-- Cart section -->
 <section class="cart-section mt-5">
   <div class="row mt-5" style="margin-left: 30px;">
     <div class="col-sm-8">
       <h2>Your Cart</h2>
       <table class="table">
         <thead>
           <tr>
             <th>Product</th>
             <th>Price</th>
             <th>Quantity</th>
             <th>Total</th>
             <th></th>
           </tr>
         </thead>
         <tbody id="cart-items">
           <?php
           $total = 0;
           if(isset($_SESSION['cart'])) {
             foreach($_SESSION['cart'] as $key => $value) {
               $product_name = $value['name'];
               $product_price = $value['price'];
               $product_quantity = $value['quantity'];
               $product_total = $product_price * $product_quantity;
               $total += $product_total;
               ?>
               <tr>
                 <td><?php echo $product_name; ?></td>
                 <td class="product-price"><?php echo '$'.$product_price; ?></td>
                 <td>
                   <input type="number" class="product-quantity" value="<?php echo $product_quantity; ?>" min="1">
                   <input type="hidden" class="product-id" value="<?php echo $key; ?>">
                 </td>
                 <td class="product-total"><?php echo '$'.$product_total; ?></td>
                 <td><a href="remove_from_cart.php?id=<?php echo $key; ?>"><i class="fa fa-trash"></i></a></td>
               </tr>
               <?php
             }
           }
           ?>
         </tbody>
       </table>
     </div>
     <div class="col-sm-4">
       <div class="card">
         <div class="card-body">
           <h5 class="card-title">Cart Summary</h5>
           <p class="card-text">Total: <span id="cart-total"><?php echo '$'.$total; ?></span></p>
           <a href="checkout.php">
             <button class="btn checkout" type="submit">Checkout</button>
           </a>
         </div>
       </div>
     </div>
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

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

      <script>
      $(document).ready(function() {
        // Update cart item quantity and totals on input change
        $(".product-quantity").change(function() {
          var quantity = $(this).val();
          var price = $(this).closest("tr").find(".product-price").text().replace("$", "");
          var total = quantity * price;
          var id = $(this).closest("tr").find(".product-id").val();

          // Update cart item total
          $(this).closest("tr").find(".product-total").text("$" + total);

          // Update cart total
          var cartTotal = 0;
          $(".product-total").each(function() {
            cartTotal += parseFloat($(this).text().replace("$", ""));
          });
          $("#cart-total").text("$" + cartTotal);

          // Send AJAX request to update cart item quantity
          $.ajax({
             type: 'POST',
             url: 'update_cart_item.php',
             data: { product_id: id, quantity: quantity },
             dataType: 'json',
             success: function(data) {
               // Update cart items and totals using jQuery
             },
             error: function(xhr, status, error) {
               console.log('Error updating cart item: ' + error);
             }
           });
        });
      });
      </script>


</body>
</html>


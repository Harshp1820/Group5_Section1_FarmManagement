<?php
include 'config.php';
include 'invoice.php';


$total = 0;
// set default timezone
date_default_timezone_set('UTC');

if (isset($_POST['checkout'])) {
  if (!isset($_SESSION['customer_id'])) {
    $name = $_POST['firstName'] . ' ' . $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    // Prepare insert statement for customer table
    $insert_customer_query = "INSERT INTO customer (`name`, `email`, `address`, `phone`) VALUES (?, ?, ?, ?)";

    $stmt0 = mysqli_prepare($conn, $insert_customer_query);
    mysqli_stmt_bind_param($stmt0, "ssss", $name, $email, $address, $phone);

    // Execute prepared statement and get customer_id
    if (mysqli_stmt_execute($stmt0)) {
      $_SESSION['customer_id'] = mysqli_insert_id($conn);
      mysqli_stmt_close($stmt0);
    } else {
      echo '<div class="alert alert-danger" role="alert">Error adding customer details. Please try again later.</div>';
      exit();
    }

    // insert order data into order table
    $date = date('Y-m-d H:i:s');
    $status = 'pending';
    $customer_id = $_SESSION['customer_id'];

    // Prepare insert statement for orders table
    $order_status = "pending";
    $order_date = date("Y-m-d H:i:s");
    $insert_order_query = "INSERT INTO orders (`customer_id`, `date`, `status`) VALUES (?, ?, ?)";
    $stmt1 = mysqli_prepare($conn, $insert_order_query);
    mysqli_stmt_bind_param($stmt1, "iss", $customer_id, $order_date, $order_status);

    //Execute Statements
    mysqli_stmt_execute($stmt1);

    // Prepare insert statement for order_details table
    // Get the last inserted id
    $order_id = mysqli_insert_id($conn);
    $insert_order_details_query = "INSERT INTO order_details (order_id, product_id, product_qty, customer_id) VALUES (?, ?, ?, ?)";
    $stmt2 = mysqli_prepare($conn, $insert_order_details_query);
    mysqli_stmt_bind_param($stmt2, "iiii", $order_id, $product_id, $product_qty, $customer_id);

    foreach ($_SESSION['cart'] as $key => $value) {
      $product_id = $key;
      $product_qty = $value['quantity'];
      $product_price = $value['price'];
      $product_quantity = $value['quantity'];
      $product_total = $product_price * $product_quantity;
      $total += $product_total;

      mysqli_stmt_execute($stmt2);
    }

    // Prepare insert statement for payment table
    $payment_method = "Paypal";
    $payment_amount = $total;
    $insert_payment_query = "INSERT INTO payment (payment_method, amount, order_id, customer_id) VALUES (?, ?, ?, ?)";
    $stmt3 = mysqli_prepare($conn, $insert_payment_query);
    mysqli_stmt_bind_param($stmt3, "sdii", $payment_method, $payment_amount, $order_id, $customer_id);

    mysqli_stmt_execute($stmt3);

    // Close prepared statements and database connection
    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt3);
    generate_pdf();
  } else {
    $name = $_POST['firstName'] . ' ' . $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    // insert order data into order table
    $date = date('Y-m-d H:i:s');
    $status = 'pending';
    $customer_id = $_SESSION['customer_id'];

    // Prepare insert statement for orders table
    $order_status = "pending";
    $order_date = date("Y-m-d H:i:s");
    $insert_order_query = "INSERT INTO orders (`customer_id`, `date`, `status`) VALUES (?, ?, ?)";
    $stmt1 = mysqli_prepare($conn, $insert_order_query);
    mysqli_stmt_bind_param($stmt1, "iss", $customer_id, $order_date, $order_status);

    //Execute Statements
    mysqli_stmt_execute($stmt1);

    // Prepare insert statement for order_details table
    // Get the last inserted id
    $order_id = mysqli_insert_id($conn);
    $insert_order_details_query = "INSERT INTO order_details (order_id, product_id, product_qty, customer_id) VALUES (?, ?, ?, ?)";
    $stmt2 = mysqli_prepare($conn, $insert_order_details_query);
    mysqli_stmt_bind_param($stmt2, "iiii", $order_id, $product_id, $product_qty, $customer_id);

    foreach ($_SESSION['cart'] as $key => $value) {
      $product_id = $key;
      $product_qty = $value['quantity'];
      $product_price = $value['price'];
      $product_quantity = $value['quantity'];
      $product_total = $product_price * $product_quantity;
      $total += $product_total;

      mysqli_stmt_execute($stmt2);
    }

    // Prepare insert statement for payment table
    $payment_method = "Paypal";
    $payment_amount = $total;
    $insert_payment_query = "INSERT INTO payment (payment_method, amount, order_id, customer_id) VALUES (?, ?, ?, ?)";
    $stmt3 = mysqli_prepare($conn, $insert_payment_query);
    mysqli_stmt_bind_param($stmt3, "sdii", $payment_method, $payment_amount, $order_id, $customer_id);

    mysqli_stmt_execute($stmt3);

    // Close prepared statements and database connection
    mysqli_stmt_close($stmt1);
    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt3);
    generate_pdf();
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
            <a class="nav-link" href="#">Contact Us</a>
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


  <!-- Cart section -->
  <section class="products-section">
    <div class="row g-5" style="margin-left: 40px; margin-right: 40px;">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary" style="color:#000 !important; font-family: 'NK57MonospaceScRg-Bold';">Your cart</span>
          <span class="badge bg-primary rounded-pill" style="background-color: #CAD95E !important"><?php echo count($_SESSION['cart']); ?></span>
        </h4>
        <ul class="list-group mb-3">
          <?php
          $total = 0;
          foreach ($_SESSION['cart'] as $key => $item) {
            $product_name = $item['name'];
            // $product_description = $item['description'];
            $product_price = $item['price'];
            $product_quantity = $item['quantity'];
            $product_total = $product_price * $product_quantity;
            $total += $product_total;
          ?>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0"><?php echo $product_name; ?></h6>
                <!-- <small class="text-muted"><?php echo $product_description; ?></small> -->
              </div>
              <span class="text-muted"><?php echo '$' . $product_price; ?></span>
            </li>
          <?php
          }
          ?>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (CAD)</span>
            <strong><?php echo '$' . $total; ?></strong>
          </li>
        </ul>


        <!-- <form class="card p-2">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Promo code">
                  <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
              </form> -->
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3" style="font-family: 'NK57MonospaceScRg-Bold'; color: #000;">Billing address</h4>
        <form class="checkout-form" novalidate="" method="post">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <?php
              if (isset($_SESSION['name'])) {
                $fullName = $_SESSION['name'];
                $firstName = explode(' ', $fullName)[0];
                $lastName = explode(' ', $fullName)[1];
                $username = $_SESSION['username'];
              } else {
                $firstName = '';
                $lastName = '';
                $username = '';
                $phone = '';
              }

              ?>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="<?php echo $firstName; ?>" required="">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="<?php echo $lastName; ?>" required="">
              <div class="invalid-feedback">
                Valid last name is required.
              </div>
            </div>

            <div class="col-6">
              <label for="username" class="form-label">Phone</label>
              <div class="input-group has-validation">
                <span class="input-group-text">📱</span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Phone number" required="" value="<?php echo $phone; ?>">
                <div class="invalid-feedback">
                  Your Phone is required.
                </div>
              </div>
            </div>

            <div class="col-6">
              <label for="username" class="form-label">Username</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="" value="<?php echo $username; ?>">
                <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?php echo $username; ?>">
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment or suite">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Country</label>
              <select class="form-select" id="country" name="country" required="">
                <option value="">Choose...</option>
                <option value="Canada">Canada</option>
              </select>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">State</label>
              <select class="form-select" id="state" name="state" required="">
                <option value="">Choose...</option>
                <option value="Ontario">Ontario</option>
              </select>
              <div class="invalid-feedback">
                Please provide a valid state.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Zip</label>
              <input type="text" class="form-control" id="zip" name="zip" placeholder="" required="">
              <div class="invalid-feedback">
                Zip code required.
              </div>
            </div>
          </div>

          <!-- <hr class="my-4"> -->

          <!--  <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="same-address" name="same-address">
                  <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                </div>
      
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="save-info" name="save-info">
                  <label class="form-check-label" for="save-info">Save this information for next time</label>
                </div>
              -->
          <hr class="my-4">

          <h4 class="mb-3">Payment</h4>



          <div class="my-3">
            <div id="smart-button-container">
              <div style="text-align: center;">
                <div id="paypal-button-container"></div>
              </div>
            </div>
            <script src="https://www.paypal.com/sdk/js?client-id=AXlViC4S7VkOPFoNMis2UvGsjRG6HeU_QrEisAgcEWwL9znIIRXUVtyGHXCA8qOur193ViSsyQ_u1ENO" data-sdk-integration-source="button-factory"></script>
            <script>
              function initPayPalButton(total) {
                paypal.Buttons({
                  style: {
                    shape: 'rect',
                    color: 'gold',
                    layout: 'vertical',
                    label: 'paypal',

                  },

                  createOrder: function(data, actions) {
                    return actions.order.create({
                      purchase_units: [{
                        "amount": {
                          "currency_code": "USD",
                          "value": total
                        }
                      }]
                    });
                  },

                  onApprove: function(data, actions) {
                    return actions.order.capture().then(function(orderData) {

                      // Full available details
                      console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                      // Show a success message within this page, e.g.
                      const element = document.getElementById('paypal-button-container');
                      element.innerHTML = '';
                      element.innerHTML = '<h3>Thank you for your payment!</h3>';

                      // Or go to another URL:  actions.redirect('thank_you.html');

                    });
                  },

                  onError: function(err) {
                    console.log(err);
                  }
                }).render('#paypal-button-container');
              }
              let total = <?php echo $total; ?>;
              initPayPalButton(total);
            </script>
            <div class="row gy-3">

              <hr class="my-4">

              <button class="w-100 btn btn-primary btn-lg" type="submit" name="checkout">Place Order</button>
        </form>
      </div>
    </div>
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
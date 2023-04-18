<?php include 'config.php'; ?> 
<?php
    // Initialize variables with empty values
$name = $phone = $email = $password = "";
$name_err = $phone_err = $email_err = $password_err = "";
$success_message = "";
$error_message = "";

// Code for Registeration
if (isset($_POST['register'])) {

        // Validate name
  if (empty(trim($_POST["name"]))) {
    $error_message = "Please enter your name.";
  } else {
     $name = trim($_POST["name"]);
  }

  // Validate User type
  if (empty(trim($_POST["user_type"]))) {
    $error_message = "Please Choose User type.";
  } else {
     $user_type = trim($_POST["user_type"]);
  }

        // Validate phone
  if (empty(trim($_POST["phone"]))) {
    $error_message = "Please enter your phone number.";
  } elseif (!preg_match("/^[0-9]{10}$/", trim($_POST["phone"]))) {
    $error_message = "Please enter a valid 10-digit phone number.";
  } else {
     $phone = trim($_POST["phone"]);
  }

        // Validate email
  if (empty(trim($_POST["email"]))) {
    $error_message = "Please enter your email address.";
  } else {
            // Check if the email is already registered
    $sql = "SELECT customer_id FROM customer WHERE email = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
      mysqli_stmt_bind_param($stmt, "s", $param_email);
      $param_email = trim($_POST["email"]);

      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $error_message = "This email is already registered.";
        } else {
          $email = trim($_POST["email"]);
        }
      } else {
        $error_message =  "Oops! Something went wrong. Please try again later.";
      }
    }
    
            // Close statement
    mysqli_stmt_close($stmt);
  }

        // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have at least 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

        // Check if there are no validation errors
  if (empty($name_err) && empty($phone_err) && empty($email_err) && empty($password_err)) {

    if($user_type=='Farmer' || $user_type=='farmer')
    {
      $sql = "INSERT INTO user (username, email, password,user_type) VALUES (?, ?, ?, ?)";
    }
    else if ($user_type=='User' || $user_type=='user')
    {
      $sql = "INSERT INTO customer (name, phone, email, password) VALUES (?, ?, ?, ?)";
    }
    else
    {
      $error_message = "Wrong User type";
    }
            // Prepare an insert statement
    

    if ($stmt = mysqli_prepare($conn, $sql)) {

      if ($user_type=='farmer' ||$user_type=='Farmer') 
      {
        mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_password,$user_type);
      }
      else
      {
        mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_phone, $param_email, $param_password);
      }
      

                // Set parameters
      $param_name = $name;
      $param_phone = $phone;
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT);

                // Attempt to execute the statement
      if (mysqli_stmt_execute($stmt)) {
        $success_message = "You have successfully registered!";
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

                // Close statement
      mysqli_stmt_close($stmt);
    }
  }

        // Close connection
  mysqli_close($conn);
}


// Initialize variables for form inputs and error messages
$username = $password = "";
$username_err = $password_err = "";

    // Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

    // Check if username/email is empty
  if (empty($_POST["username"])) {
    $username_err = "Please enter your username or email.";
  } else {
    $username = $_POST["username"];
  }

    // Check if password is empty
  if (empty($_POST["password"])) {
    $password_err = "Please enter your password.";
  } else {
    $password = $_POST["password"];
  }

  // If no validation errors, proceed to check credentials
  if (empty($username_err) && empty($password_err)) {
    // Prepare SQL statement to check for matching username/email and password
    $stmt = mysqli_prepare($conn, "SELECT * FROM customer WHERE email=?");
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute SQL statement and check for errors
    if (!mysqli_stmt_execute($stmt)) {
      die("Error executing SQL statement: " . mysqli_error($conn));
    }

    // Fetch result from query
    $result = mysqli_stmt_get_result($stmt);

    // Check if result set has exactly one row
    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $hashed_password = $row["password"];
      $name = $row["name"];
      $customer_id = $row["customer_id"];
      $_SESSION['customer_id'] = $customer_id;
      $_SESSION['username'] = $username;
      $_SESSION['name'] = $name;
      $_SESSION['loggedin'] = true;
      header("Location: index.php");
      // if ($row['user_type'] == 'admin') {
      //   // Redirect to admin dashboard
      //   header("Location: admin/dashboard.php");
      //   exit();
      // } else if ($row['user_type'] == 'farmer') {
      //   // Redirect to farmer dashboard
      //   header("Location: farmer/dashboard.php");
      //   exit();
      // } else {
      //   // Invalid user type
      //   $login_err = "Invalid user type.";
      // }
    } else {
      // Check user table if data not found in customer table
      $stmt = mysqli_prepare($conn, "SELECT * FROM user WHERE email=?");
      mysqli_stmt_bind_param($stmt, "s", $username);

      if (!mysqli_stmt_execute($stmt)) {
        die("Error executing SQL statement: " . mysqli_error($conn));
      }

      $result = mysqli_stmt_get_result($stmt);

      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row["password"];
        if (password_verify($password, $hashed_password)){
          $user_type = $row["user_type"];
          $_SESSION['user_id'] = $row["user_id"];
          $_SESSION['username'] = $username;
          $_SESSION['user_type'] = $user_type;
          $_SESSION['loggedin'] = true;
          if ($user_type == 'admin') {
          // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
          } else if ($user_type == 'farmer') {
          // Redirect to farmer dashboard
            header("Location: farmer/dashboard.php");
            exit();
          } else {
          // Invalid user type
            $login_err = "Invalid user type.";
          }
        }
        else
        {
          $login_err = "Invalid  password."; 
        }
      } else {
        // Login unsuccessful, display error message
        $login_err = "Invalid username/email or password.";
      }

      mysqli_stmt_close($stmt);
    }

    // Close database connection
    mysqli_close($conn);
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
  <section class="hero-section" style="background-image: url('assets/farm-2.jpg');">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
          <img src="assets/logo.jpg" style="width: 250px; border-radius: 125px;">
          <h1 style="color: #fff; margin-top: 10%;">LOGIN / REGISTER HERE</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Login / Register form section -->
  <section class="form-section">
    <div class="container mt-5">
      <div class="row mb-3">
        <div class="col text-center">
          <a href="javascript:none()" class="d-inline-block font-style" id="login-link" style="margin-right: 30px;"> <h2>LOGIN</h2></a>
          <a href="javascript:none()" class="d-inline-block font-style" id="register-link" style="color: rgb(105, 102, 102)"> <h2>REGISTER</h2></a>
        </div>
      </div>
      <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-6 text-center form-div" style="background-color: #DDDCC8">

          <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php if (isset($error_message)): ?>
              <div style='color: red;'><?php echo $error_message; ?></div>
              <?php if (isset($success_message)): ?>
                <div style='color: green;'><?php echo $success_message; ?></div>
              <?php endif ?>
            <?php endif ?>
            <p>Enter your username or password to login.</p>
            <input type="text" placeholder="Username or Email" required value="<?php echo htmlspecialchars($username); ?>" name="username"><br>
            <span style="color: red;"><?php echo $username_err; ?></span>
            <input type="password" placeholder="Password" required name="password"><br>
            <span style="color: red;"><?php echo $password_err; ?></span>
            <button type="submit" name="login">Login</button>
          </form>

          <?php if (!empty($login_err)) echo "<div style='color: red;'>$login_err</div>"; ?>
          <form action="" method="post" class="register-form" style="display: none;">
            <?php if (isset($error_message)): ?>
              <div style='color: red;'><?php echo $error_message; ?></div>
              <?php if (isset($success_message)): ?>
                <div style='color: green;'><?php echo $success_message; ?></div>
              <?php endif ?>
            <?php endif ?>
            <p>Enter details to register yourself.</p>
            <div class="form-row justify-content-center">
              <div class="form-group col-md-12">
                <input type="text" class="form-group" placeholder="Full Name" name="name" required>
              </div>
              <div class="form-group col-md-12">
                <input type="text" class="form-group" placeholder="Phone Number" name="phone" required>
              </div>
              <div class="form-group select-group col-md-12 mx-auto p-1" style="width: 70%;">
                <select class="form-select" name="user_type">
                  <option value="farmer">Farmer</option>
                  <option value="user">User</option>
                </select>
              </div>

              <div class="form-group col-md-12">
                <input type="text" class="form-group" placeholder="Username or Email" name="email" required>
              </div>
              <div class="form-group col-md-12">
                <input type="password" class="form-group" placeholder="Password" name="password" required>
              </div>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Register</button>
          </form>


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
</body>

<script>
  const loginForm = document.querySelector('.login-form');
  const registerForm = document.querySelector('.register-form');
  const loginLink = document.getElementById('login-link');
  const registerLink = document.getElementById('register-link');

  loginLink.addEventListener('click', () => {
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
    registerLink.style.color= 'rgb(105, 102, 102)';
    loginLink.style.color= '#000';
  });

  registerLink.addEventListener('click', () => {
    loginForm.style.display = 'none';
    registerForm.style.display = 'block';
    loginLink.style.color= 'rgb(105, 102, 102)';
    registerLink.style.color= '#000';
  });
</script>

</html>
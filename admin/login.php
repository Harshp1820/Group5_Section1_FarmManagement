<?php require_once '../config.php'; ?>
<?php 


if (isset($_SESSION['user'])) {

    header('Location: dashboard.php');
    exit;
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email and password from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute a SELECT statement to get the user with the given email and password
    $stmt = $conn->prepare('SELECT * FROM user WHERE email = ? AND password = ?');
    $stmt->bind_param('ss', $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

       // Check if the user exists
    if ($result->num_rows === 1) {
               // Get the user from the result set
     $user = $result->fetch_assoc();

               // Check if the user is an admin
     if ($user['user_type'] === 'admin' || $user['user_type'] === 'Admin') {
                   // Store the user in the session
        $_SESSION['user_type'] = $user['user_type'];
        $_SESSION['user_id'] = $user['user_id'];

                   // Redirect the user to the admin dashboard
         header('Location: dashboard.php');
         exit;
     } else {
                   // Show an error message
         $error = 'You are not authorized to access the admin dashboard.';
     }
 } else {
               // Show an error message
     $error = 'Invalid email or password.';
 }

           // Close the statement and the connection
 $stmt->close();
 $conn->close();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login -Admin Dashboard</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header"><h3 class="text-center font-weight-light my-4">Admin Login</h3>
                                <?php if (isset($error)): ?>
                                     <div class="alert alert-danger"><?php echo $error; ?></div>
                                 <?php endif; ?></div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com" />
                                            <label for="email">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" id="password" type="password" placeholder="Password" />
                                            <label for="password">Password</label>
                                        </div>
                                        <!-- <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div> -->
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <?php include 'includes/footer.php' ?>

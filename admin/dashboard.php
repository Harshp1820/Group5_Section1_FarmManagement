<?php
require_once 'includes/header.php';
require_once 'includes/navbar.php';
require_once 'includes/sidebar.php';

$query = "SELECT
  (SELECT COUNT(*) FROM products) AS total_products,
  (SELECT COUNT(*) FROM customer) AS total_customers,
  (SELECT COUNT(*) FROM orders) AS total_orders;
";

// Execute the query and fetch the results
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$total_products =  $row['total_products'];
$total_customers =  $row['total_customers'];
$total_orders =  $row['total_orders'];

?>


<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Home</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Home</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Total Customers</h4>
                        <h1><span class="badge badge-primary" id="total-customers"><?php echo $total_customers; ?></span></h1>
                    </div>

                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="view-customers.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Total Products</h4>
                        <h1><span class="badge badge-warning" id="total-products"><?php echo $total_products; ?></span></h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="view-products.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Total Orders</h4>
                        <h1><span class="badge badge-success" id="total-products"><?php echo $total_orders; ?></span></h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="view-orders.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">

                        <h4 class="card-title">Total Production</h4>
                        <h1><span class="badge badge-danger" id="total-customers">0</span></h1>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
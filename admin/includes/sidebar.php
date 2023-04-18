<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>

                    <!-- Products -->
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Menu</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Products
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="add-product.php">Add Product</a>
                            <a class="nav-link" href="view-products.php">View Products</a>
                        </nav>
                    </div>

                    <!-- Customers -->
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomers" aria-expanded="false" aria-controls="collapseCustomers">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Customers
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseCustomers" aria-labelledby="headingtwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="view-customers.php">View Customers</a>
                        </nav>
                    </div>
                    
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: Admin</div>
               <?php if (isset($_SESSION['username'])): ?>
                <p><?php echo $_SESSION['username']; ?></p>
                   
               <?php endif ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        
       
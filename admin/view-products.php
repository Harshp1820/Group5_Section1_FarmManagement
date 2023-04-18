<?php
ob_start();

require_once 'includes/header.php';
require_once 'includes/navbar.php';
require_once 'includes/sidebar.php';


if (isset($_GET['id']) && isset($_GET['action'])) {
	$product_id = $_GET['id'];

	// Prepare and execute a DELETE statement to remove the product with the given ID from the table
	$stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
	$stmt->bind_param("i", $product_id);
	if ($stmt->execute() === TRUE) {

		$alert_type = "success";
		$success_message = "Product deleted successfully.";
	} else {
		$alert_type = "warning";
		$error_message = "Error deleting product: " . $stmt->error;
	}
	$stmt->close();

	// Redirect to the same page with cleared parameters
	header("Location: " . $_SERVER['PHP_SELF']);
	exit();
}





?>

<main>
	<div class="container-fluid px-4">
		<h1 class="mt-4">Products</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">View Product</li>
		</ol>

		<div class="row">

			<!-- Show success message -->
			<?php if (isset($success_message)) : ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<?php echo $success_message; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif ?>

			<!-- Show error message -->
			<?php if (isset($error_message)) : ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?php echo $error_message; ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif ?>

			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Product Name</th>
							<th>Description</th>
							<th>Category</th>
							<th>Price</th>
							<th>Image</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM products";
						$result = mysqli_query($conn, $query);
						if (mysqli_num_rows($result) > 0) {
							$i = 1;
							while ($row = mysqli_fetch_assoc($result)) {
						?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['description']; ?></td>
									<td><?php echo $row['category']; ?></td>
									<td><?php echo $row['price']; ?></td>
									<td><img src="assets/product_images/<?php echo $row['image']; ?>" width="50px" height="50px"></td>
									<td>
										<!-- <a href="edit-product.php?action=edit&product_id=<?php echo $row['product_id']; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a> -->
										<a href="edit-product.php?action=edit&product_id=<?php echo $row['product_id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
										<!-- <a href="view-products.php?action=delete&id=<?php echo $row['product_id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a> -->
										<a href="view-products.php?action=delete&id=<?php echo $row['product_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')" class="delete-icon" title="Delete"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
							<?php
								$i++;
							}
						} else {
							?>
							<tr>
								<td colspan="7">No products found.</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>


		</div>
</main>



<?php
ob_end_flush();
require_once 'includes/footer.php'; ?>
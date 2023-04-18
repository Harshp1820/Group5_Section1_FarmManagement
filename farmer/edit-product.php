<?php 
require_once 'includes/header.php'; 
require_once 'includes/navbar.php'; 
require_once 'includes/sidebar.php'; 


// Check if product_id is set
if (!isset($_GET['product_id'])) {
	header("Location: view-products.php");
	exit;
}

// Get product details
$product_id = $_GET['product_id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
	header("Location: view-products.php");
	exit;
}
$product = $result->fetch_assoc();

// Handle form submission
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Update product in database
	$name = $_POST['name'];
	$description = $_POST['description'];
	$category = $_POST['category'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$product_id = $_POST['product_id'];

  // Check if a new image file was uploaded
	if (!empty($_FILES['image']['name'])) {
    // Get the image file details
		$image_name = $_FILES['image']['name'];
		$image_tmp_name = $_FILES['image']['tmp_name'];
		$image_size = $_FILES['image']['size'];
		$image_error = $_FILES['image']['error'];
		$image_type = $_FILES['image']['type'];

    // Check if the file is an image
		$image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
		$allowed_exts = array('jpg', 'jpeg', 'png', 'gif');
		if (in_array($image_ext, $allowed_exts)) {
      // Move the image file to the product images folder
			$image_path = 'assets/product_images/' . $image_name;
			move_uploaded_file($image_tmp_name, $image_path);

      // Update the image path in the database
			$stmt = $conn->prepare("UPDATE products SET name=?, description=?, category=?, price=? , quantity=?, image=? WHERE product_id=?");
			$stmt->bind_param("ssssssi", $name, $description, $category, $price, $quantity, $image_path, $product_id);
		} else {
			$error = "Invalid image file type. Please upload a JPEG, PNG, or GIF file.";
		}
	} else {
    // No new image file was uploaded, update product without changing image path
		$stmt = $conn->prepare("UPDATE products SET name=?, description=?, category=?, price=? WHERE product_id=?");
		$stmt->bind_param("ssssi", $name, $description, $category, $price, $product_id);
	}

	if (empty($error) && $stmt->execute() === TRUE) {
    // Product updated successfully
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		Product updated successfully.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
		
	} else {
    // Error updating product
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		Error: ' . $stmt->error . '
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
	}
}







?>

<main>
	<div class="container-fluid px-4">
		<h1 class="mt-4">Products</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">Edit Product</li>
		</ol>


		<div class="row">
			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Products Edit</h1>

				</div>
			</div>

			<div class="row">
				<div class="col-md-12 ">
					<div class="card">
						<div class="card-body">
							<h3>Edit Product</h3>
							<form  method="post" enctype="multipart/form-data">
								<input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
								<div class="form-group">
									<label for="product_title">Product Title:</label>
									<input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
								</div>
								<div class="form-group">
									<label for="product_description">Product Description:</label>
									<textarea class="form-control" id="description" name="description" rows="3" required><?php echo $product['description']; ?></textarea>
								</div>
								<div class="form-group">
									<label for="product_category">Product Category:</label>
									<select class="form-control" id="category" name="category" required>
										<option value="">-- Select a category --</option>
										<option value="Pottery"<?php if ($product['category'] == 'Pottery') { echo ' selected'; } ?>>Pottery</option>
										<option value="Fruits"<?php if ($product['category'] == 'Fruits') { echo ' selected'; } ?>>Fruits</option>
										<option value="Vegetable"<?php if ($product['category'] == 'Vegetable') { echo ' selected'; } ?>>Vegetable</option>
									</select>

								</div>
								<div class="form-group">
									<label for="product_price">Product Price:</label>
									<input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" step="0.01" required>
								</div>
								<div class="form-group">
									<label for="product_price">Product Quantity:</label>
									<input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" step="1" required>
								</div>
								<div class="form-group">
									<label for="product_image">Product Image:</label>
									<input type="file" class="form-control-file form-control" id="image" name="image" accept="image/*">
								</div>
								<button type="submit" class="btn btn-primary m-2">Update Product</button>
							</form>
						</div>
					</div>
				</div>
			</div>


		</div>



	</div>
</main>



<?php require_once 'includes/footer.php'; ?>
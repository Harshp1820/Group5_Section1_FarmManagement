<?php 
require_once 'includes/header.php'; 
require_once 'includes/navbar.php'; 
require_once 'includes/sidebar.php'; 



if (isset($_POST['add_product'])) 
{
	
	// Get form input values
	$title = $_POST['title'];
	$description = $_POST['description'];
	$category = $_POST['category'];
	$price = $_POST['price'];
	$quantity = $_POST['quantity'];
	$image = $_FILES['image']['name'];

	// Validate input data
	if (empty($title) || empty($description) || empty($category) || empty($price) || empty($image)) {
		echo "All fields are required.";
		exit();
	}


	// Prepare and bind the statement
	$stmt = $conn->prepare("INSERT INTO products (name, description, category, price,quantity, image) VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("ssssss", $title, $description, $category, $price,$quantity, $image);

	// Upload image to server directory
	$target_dir = "assets/product_images/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);
	move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

	
	if ($stmt->execute() === TRUE) {
	  // Success alert
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		Product added successfully.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
	} else {
	  // Warning alert
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		Error: ' . $stmt->error . '
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>';
	}
	


	// Close the connection
	$stmt->close();
	$conn->close();
	

}


?>

<main>
	<div class="container-fluid px-4">
		<h1 class="mt-4">Products</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">Add Product</li>
		</ol>

		<div class="row">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-12">
						<form  method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="title">Product Title:</label>
								<input type="text" class="form-control" id="title" name="title" required>
							</div>
							<div class="form-group">
								<label for="description">Product Description:</label>
								<textarea class="form-control" id="description" name="description" required></textarea>
							</div>
							<div class="form-group">
								<label for="category">Product Category:</label>
								<select class="form-control" id="category" name="category" required>
									<option value="">-- Select a category --</option>
									<option value="POULTRY FARMING">POULTRY FARMING</option>
									<option value="CATTLE FARMING">CATTLE FARMING</option>
									<option value="DAIRY FARMING">DAIRY FARMING</option>
									<option value="BROILER CHICKEN">BROILER CHICKEN</option>
									<option value="Other">Other</option>
								</select>
							</div>
							<div class="form-group">
								<label for="price">Product Price:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">$</span>
									</div>
									<input type="number" class="form-control" id="price" name="price" min="0" step="0.01" required>
								</div>
							</div>
							<div class="form-group">
								<label for="price">Product Quantity:</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text">+/-</span>
									</div>
									<input type="number" class="form-control" id="quantity" name="quantity" min="1" step="1" required>
								</div>
							</div>
							<div class="form-group">
								<label for="image">Product Image:</label>
								<div class="custom-file">
									<input type="file" class="form-control custom-file-input" id="image" name="image" accept="image/*" required>
								</div>
							</div>
							<div class="form-group m-2">
								<button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
							</div>



						</form>
					</div>
				</div>
			</div>

		</div>



	</div>
</main>



<?php require_once 'includes/footer.php'; ?>
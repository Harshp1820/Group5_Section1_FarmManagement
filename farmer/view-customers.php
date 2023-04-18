<?php
ob_start();
require_once 'includes/header.php'; 
require_once 'includes/navbar.php'; 
require_once 'includes/sidebar.php'; 

?>

<main>
	<div class="container-fluid px-4">
		<h1 class="mt-4">Customers</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item active">View Customers</li>
		</ol>

		<div class="row">

			<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<h1 class="display-4">Customers List</h1>
				</div>
			</div>

			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email/Username</th>
							<th>Phone</th>
							<th>Address</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM customer";
						$result = mysqli_query($conn, $query);
						if(mysqli_num_rows($result) > 0) {
							$i = 1;
							while($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['phone']; ?></td>
									<td><?php echo $row['address']; ?></td>
								</tr>
								<?php
								$i++;
							}
						} else {
							?>
							<tr>
								<td colspan="7">No Customers found.</td>
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
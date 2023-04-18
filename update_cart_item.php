<?php
session_start();

if(isset($_POST['product_id']) && isset($_POST['quantity'])) {
  $product_id = $_POST['product_id'];
  $quantity = (int) $_POST['quantity'];

  // Check if product exists in cart
  if(isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id]['quantity'] = $quantity;

    // Calculate new price and total
    $product_price = $_SESSION['cart'][$product_id]['price'];
    $product_total = $product_price * $quantity;
    $_SESSION['cart'][$product_id]['total'] = $product_total;

    // Return updated cart items as JSON
    echo json_encode($_SESSION['cart']);
  }
}

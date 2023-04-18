<?php 
// session_start();
function generate_pdf()
{
	require('fpdf/fpdf.php');

    // Get form input values
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$phone = $_POST['username'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$address2 = $_POST['address2'];
	$country = $_POST['country'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];

	


    // Create a new PDF instance
	$pdf = new FPDF();

    // Add a new page
	$pdf->AddPage();

    // Set font and text color
	$pdf->SetFont('Arial','B',16);
	$pdf->SetTextColor(50,50,50);

    // Add invoice title
	$pdf->Cell(0,10,'Invoice',1,1,'C');

    // Add invoice information
	$pdf->SetFont('Arial','',12);
	$pdf->Cell(30,10,'Name:',1,0);
	$pdf->Cell(0,10,$firstName.' '.$lastName,1,1);
	$pdf->Cell(30,10,'Phone:',1,0);
	$pdf->Cell(0,10,$phone,1,1);
	$pdf->Cell(30,10,'Email:',1,0);
	$pdf->Cell(0,10,$email,1,1);
	$pdf->Cell(30,10,'Address:',1,0);
	$pdf->Cell(0,10,$address,1,1);
	$pdf->Cell(30,10,'Address 2:',1,0);
	$pdf->Cell(0,10,$address2,1,1);
	$pdf->Cell(30,10,'Country:',1,0);
	$pdf->Cell(0,10,$country,1,1);
	$pdf->Cell(30,10,'State:',1,0);
	$pdf->Cell(0,10,$state,1,1);
	$pdf->Cell(30,10,'Zip:',1,0);
	$pdf->Cell(0,10,$zip,1,1);


	

    // Add product details
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,10,'Product Details',1,1,'C');
	$pdf->SetFont('Arial','',10);

         // Get product details
	$productDetails = '';
	$total = 0;
         // print_r($_SESSION['cart']);
	foreach ($_SESSION['cart'] as $key => $value) {
	    $product_id = $key;
	    $product_qty = $value['quantity'];
	    $product_price = $value['price'];
	    $product_quantity = $value['quantity'];
	    $product_name = $value['name'];
	    $product_total = $product_price * $product_quantity;
	    $total += $product_total;

	    // Add product details headers to the PDF table
	    $pdf->SetFont('Arial','B',12);
	    $pdf->Cell(20,10,'Qty',1,0,'C');
	    $pdf->Cell(80,10,'Product',1,0,'C');
	    $pdf->Cell(30,10,'Price',1,0,'C');
	    $pdf->Cell(30,10,'Quantity',1,0,'C');
	    $pdf->Cell(30,10,'Total',1,1,'C');

	    // Add product details to the PDF table
	    $pdf->SetFont('Arial','',10);
	    $pdf->Cell(20,10,$product_qty,1,0,'C');
	    $pdf->Cell(80,10,$product_name,1,0,'C');
	    $pdf->Cell(30,10,'$'.$product_price,1,0,'C');
	    $pdf->Cell(30,10,$product_quantity,1,0,'C');
	    $pdf->Cell(30,10,'$'.$product_total,1,1,'C');
	}


        // Add total to the PDF table
	$pdf->Cell(160,10,'Total',1,0,'R');
	$pdf->Cell(30,10,'$'.$total,1,1,'C');
	
	$pdf->MultiCell(0, 5, $productDetails, 1);

    // Add total
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,10,'Total: $' . $total,1,1,'R');

    // Output the PDF
	$pdf->Output();
}



?>
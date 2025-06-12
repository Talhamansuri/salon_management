<?php

require_once 'vendor/autoload.php'; // Include Composer autoloader for Dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

$connection = mysqli_connect("localhost", "root", "", "projectdb");

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['ProductCategory'];
    $sortOption = $_POST['sortOption'];
    $productStock = $_POST['ProductStock'];

    $sql = "SELECT * FROM tbl_product JOIN tbl_product_category ON tbl_product.category_id=tbl_product_category.category_id WHERE 1=1";

    if (!empty($category)) {
        $sql .= " AND tbl_product_category.category_name = '$category'";
    }
    if (!empty($productStock)) {
        $sql .= " AND tbl_product.stock = '$productStock'";
    }

    // Default sorting if no option selected
    $orderBy = "ORDER BY tbl_product.product_id DESC";

    if (!empty($sortOption)) {
        if ($sortOption === 'price-status-asc') {
            $orderBy = "ORDER BY tbl_product.product_price ASC";
        } elseif ($sortOption === 'price-status-desc') {
            $orderBy = "ORDER BY tbl_product.product_price DESC";
        }
    }

    $sql .= " $orderBy";

    $query = mysqli_query($connection, $sql);
} else {
    // Default query
    $query = mysqli_query($connection, "SELECT * FROM tbl_product JOIN tbl_product_category ON tbl_product.category_id=tbl_product_category.category_id ORDER BY tbl_product.product_id DESC");
}

// Configure Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true); // Allow Dompdf to load remote resources like images

// Instantiate Dompdf
$dompdf = new Dompdf($options);

// Load HTML content
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Report</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="table-responsive text-nowrap">
            <table class="table" id="myTable">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Product name</th>
                        <th>Category</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    ';
while ($products = mysqli_fetch_array($query)) {
    $html .= "
                    <tr>
                        <td>#{$products['product_id']}</td>
                        <td>{$products['product_name']}</td>
                        <td>{$products['category_name']}</td>
                        <td>{$products['product_quantity']}</td>
                        <td>{$products['product_price']}</td>
                        <td>{$products['stock']}</td>
                    </tr>";
}
$html .= '
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
';

// Load HTML into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render PDF (output as attachment)
$dompdf->render();

// Output PDF to the browser
$dompdf->stream('product_report.pdf', ['Attachment' => 0]);

?>

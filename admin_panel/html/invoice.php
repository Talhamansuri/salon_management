<?php

require "connection.php";

if (isset($_GET['oid'])) {

  $oid = $_GET['oid'];
  $order_query = mysqli_query($connection, "SELECT * FROM tbl_order WHERE order_id=$oid");
  $order_details_query = mysqli_query($connection, "SELECT * FROM tbl_order_details WHERE order_id=$oid");
  $order = mysqli_fetch_array($order_query);
}
else{
  header("location:order_list.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom styles for this template */
    body {
      font-family: Arial, sans-serif;
      font-size: 14px;
      padding-bottom: 5rem;
    }

    .invoice-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 30px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #fff;
    }

    .invoice-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .invoice-logo {
      max-width: 150px;
    }

    .invoice-title {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }

    .invoice-details {
      margin-top: 30px;
    }

    .invoice-details p {
      margin: 5px 0;
    }

    .invoice-table {
      margin-top: 30px;
    }

    .invoice-table th,
    .invoice-table td {
      vertical-align: middle !important;
    }

    .invoice-footer {
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #ccc;
    }

    .text-right {
      text-align: right;
    }
  </style>
</head>

<body>
  <div class="invoice-container">
    <div class="invoice-header">
      <img src="images/logo2.png" style="height: 150px; width:fit-content" alt="Company Logo" class="invoice-logo">
      <div>
        <h1 class="invoice-title">Invoice</h1>
        <p>Date: <?php echo $order['order_date']; ?></p>
      </div>
    </div>
    <div class="invoice-details">
      <div>
        <h4>Bill To:</h4>
        <p>Customer Name: <?php echo "{$order['first_name']} {$order['last_name']} "; ?></p>
        <p>Email: <?php echo $order['email']; ?></p>
        <p>Address: <?php echo "{$order['order_add']},<br/>{$order['city']} - {$order['pin_code']},<br/> {$order['state']} <br/>"; ?></p>
      </div>
      <div>
        <h4>Order Details:</h4>
        <p>Invoice Number: INV-<?php echo $oid; ?></p>
      </div>
    </div>
    <div class="invoice-table">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Item</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $grand_total = 0;
          while ($order_details = mysqli_fetch_array($order_details_query)) {
            $pid = $order_details['product_id'];
            $product_query = mysqli_query($connection, "select * from `tbl_product` where product_id='$pid'");
            $product = mysqli_fetch_array($product_query);
            $sub_total = $order_details['quantity'] * $product['product_price'];
            $grand_total += $sub_total;
            echo "<tr>
            <td>{$product['product_name']}</td>
            <td>{$product['description']}</td>
            <td>{$order_details['quantity']}</td>
            <td>&#8377;{$product['product_price']}</td>
            <td>&#8377;{$sub_total}</td>
          </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="invoice-footer">
      <div class="row">
        <div class="col text-right">
          <p><strong>Subtotal:</strong> &#8377;<?php echo $grand_total; ?></p>
          <p><strong>Total:</strong> &#8377;<?php echo $grand_total; ?></p>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center mt-4">
      <button class="btn btn-primary" onclick="window.print()">Print Invoice</button>
    </div>
</body>

</html>
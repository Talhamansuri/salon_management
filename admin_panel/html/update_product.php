<?php

$connection = mysqli_connect("localhost", "root", "", "projectdb");

$id = $_GET['uid'];
$query = mysqli_query($connection, "select * from tbl_product where product_id=$id");
$data = mysqli_fetch_array($query);

$product_id = $data['product_id'];
$name = $data['product_name'];
$sub_category = $data['sub_category_id'];
$description = $data['description'];
$price = $data['product_price'];
$discount = $data['discount_price'];
$quantity = $data['product_quantity'];
$vendor = $data['vendor'];

if (isset($_POST['btn_submit'])) {
    $name = $_POST['product_name'];
    $sub_category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];
    $quantity = $_POST['quantity'];
    $vendor = $_POST['vendor'];
    $query = mysqli_query($connection, "UPDATE `tbl_product` SET `product_name`='$name',`description`='$description',`product_quantity`='$quantity',`vendor`='$vendor',`product_price`='$price',`discount_price`='$discount',`sub_category_id`='$sub_category' where product_id=$id");
    if ($query) {
        echo "<script>alert('Record Updated successfully...!');</script>";
        echo "<script>window.location.href='product_list.php';</script>";
    } else {
        mysqli_error($connection);
    }
}
?>
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Update product</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/materialdesignicons.css" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="../assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <?php
            include "sidebar.php";
            ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <?php
                include "navbar.php";
                ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Update Product</h4>

                        <!-- Basic Layout -->
                        <div class="row">
                            <!-- Merged -->
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Update Products</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="frm1" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="text" value="#<?php echo $product_id; ?>" class="form-control" id="floatingInput" aria-describedby="floatingInputHelp" disabled/>
                                                <label for="floatingInput">Product ID</label>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="text" value="<?php echo $name; ?>" name="product_name" class="form-control" id="floatingInput" placeholder="Product name (require)" aria-describedby="floatingInputHelp" required />
                                                <label for="floatingInput">Product Name</label>
                                                <div class="invalid-feedback">
                                                    Please enter Product name
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <textarea name="description" class="form-control h-px-100" id="exampleFormControlTextarea1" placeholder="Write Description here..." required><?php echo $description; ?></textarea>
                                                <label for="exampleFormControlTextarea1">Description</label>
                                                <div class="invalid-feedback">Please enter Description</div>
                                                <div class="invalid-feedback">
                                                    Please enter Description
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <select class="form-select" id="exampleFormControlSelect1" name="category" aria-label="Default select example" required>
                                                            <?php
                                                            $query = mysqli_query($connection, "select * from tbl_product_category");
                                                            while ($row = mysqli_fetch_array($query)) {
                                                                echo "<option value='$row[0]'";
                                                                if ($sub_category == $row[0]) {
                                                                    echo 'selected';
                                                                }
                                                                echo ">$row[1]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <label for="exampleFormControlSelect1">Select sub-category</label>
                                                        <div class="invalid-feedback">Please Select sub-category of product</div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <select class="form-select" id="exampleFormControlSelect1" name="vendor" aria-label="Default select example" required>
                                                            <option value="Loreal" <?php if($vendor=="Loreal"){echo "selected";}?> >Loreal</option>
                                                            <option value="Wella" <?php if($vendor=="Wella"){echo "selected";}?>>Wella</option>
                                                            <option value="Schwarzcopf" <?php if($vendor=="Schwarzcopf"){echo "selected";}?>>Schwarzcopf</option>
                                                            <option value="Beardo" <?php if($vendor=="Beardo"){echo "selected";}?>>Beardo</option>
                                                        </select>
                                                        <label for="exampleFormControlSelect1">Select Vendor</label>
                                                        <div class="invalid-feedback">Please select vendor</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-floating form-floating-outline mb-4">
                                                <input type="number" value="<?php echo $quantity; ?>" name="quantity" class="form-control" id="floatingInput" placeholder="Quantity" aria-describedby="floatingInputHelp" required />
                                                <label for="floatingInput">Quantity</label>
                                                <div class="invalid-feedback">
                                                    Please enter quantity
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <input type="number" value="<?php echo $price; ?>" name="price" class="form-control" id="floatingInput" placeholder="Price" aria-describedby="floatingInputHelp" required />
                                                        <label for="floatingInput">Price</label>
                                                        <div class="invalid-feedback">
                                                            Please enter price name
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-floating form-floating-outline mb-4">
                                                        <input type="number" value="<?php echo $discount; ?>" name="discount" class="form-control" id="floatingInput" placeholder="Discount" aria-describedby="floatingInputHelp" required />
                                                        <label for="floatingInput">Discount Price</label>
                                                        <div class="invalid-feedback">
                                                            Please Enter Discount Price
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php
                    include "footer.php";
                    ?>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
<?php
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
    if (!empty($sortOption)) {
        if ($sortOption === 'price-status-asc') {
            $sql .= " ORDER BY tbl_product.product_price ASC";
        } elseif ($sortOption === 'price-status-desc') {
            $sql .= " ORDER BY tbl_product.product_price DESC";
        }
    }

    $query = mysqli_query($connection, $sql);
} else {
    // Default query
    $query = mysqli_query($connection, "SELECT * FROM tbl_product JOIN tbl_product_category ON tbl_product.category_id=tbl_product_category.category_id");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Report</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/report.css" />

    <!-- jsPDF and jsPDF-AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h2 class="title">Product Report</h2>
            <div class="subtitle">Date <?php echo date('Y-m-d'); ?></div>
        </div>

        <!-- Filtering Form -->
        <div class="card-header">
            <h2 class="card-title">Filter</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-3 product_category">
                        <select name="ProductCategory" class="form-select text-capitalize">
                            <option value="">Category</option>
                            <?php
                            $category_query = mysqli_query($connection, "SELECT * FROM `tbl_product_category`");
                            while ($category = mysqli_fetch_array($category_query)) {
                                echo "<option value='{$category['category_name']}'>{$category['category_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="sortOption" class="form-select">
                            <option value="">Sort By</option>
                            <option value="price-status-asc">Price (Low to High)</option>
                            <option value="price-status-desc">Price (High to Low)</option>
                        </select>
                    </div>
                    <div class="col-md-3 product_stock">
                        <select name="ProductStock" class="form-select text-capitalize">
                            <option value="">Stock</option>
                            <option value="Out of stock">Out of stock</option>
                            <option value="In stock">In stock</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary" style="width: 100%; background-color:#9055fd">Apply changes</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="table-responsive text-nowrap">
            <table class="table" id="myTable">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>QTY</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-1">
                    <?php
                    while ($products = mysqli_fetch_array($query)) {
                        echo "<tr>
                                    <td>#{$products['product_id']}</td>
                                    <td>{$products['product_name']}</td>
                                    <td>{$products['category_name']}</td>
                                    <td>{$products['product_quantity']}</td>
                                    <td>{$products['product_price']}</td>
                                    <td>{$products['stock']}</td>
                                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Buttons -->
        <div class="row" style="padding-top: 2rem; padding-bottom: 5rem;">
            <div class="col-md-6">
                <button class="btn btn-primary" id="downloadPdf">Download Report (PDF)</button>
            </div>
            <div class="col-md-6 text-end">
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const downloadPdfButton = document.getElementById("downloadPdf");
            const {
                jsPDF
            } = window.jspdf;

            if (!jsPDF) {
                console.error("jsPDF is not loaded");
                return;
            }

            downloadPdfButton.addEventListener("click", function() {
                const doc = new jsPDF();

                // Header information
                const companyName = "Glam salon"; // Modify with your company name
                const reportTitle = "Product Report";
                const currentDate = new Date().toISOString().slice(0, 10);

                // Add header content
                doc.setFont("Helvetica", "bold");
                doc.setFontSize(18);
                doc.text(companyName, 14, 20);
                doc.setFontSize(14);
                doc.text(reportTitle, 14, 30);
                doc.text("Date: " + currentDate, 150, 30); // Align to the right side

                // Extract table data
                const tableData = [];
                const rows = document.querySelectorAll("#myTable tbody tr");

                rows.forEach((row) => {
                    const cells = row.children;
                    const rowData = Array.from(cells).map((cell) => cell.innerText);
                    tableData.push(rowData);
                });

                // Adding the AutoTable
                doc.autoTable({
                    head: [
                        ["#ID", "Product Name", "Category", "QTY", "Price", "Stock"]
                    ],
                    body: tableData,
                    startY: 40,
                });

                // Get total page count
                const totalPages = doc.internal.getNumberOfPages();

                // Add footer and page numbers to each page
                for (let i = 1; i <= totalPages; i++) {
                    doc.setPage(i); // Set the page to add footer
                    doc.setFont("Helvetica", "italic");
                    doc.setFontSize(8);

                    const pageWidth = doc.internal.pageSize.getWidth();

                    // Page number text aligned to the right
                    doc.text(`Page ${i} of ${totalPages}`, pageWidth - 15, doc.internal.pageSize.getHeight() - 10, {
                        align: "right",
                    });

                    // Copyright information at the center
                    const copyrightText = `© ${new Date().getFullYear()} ${companyName}. All rights reserved.`;
                    doc.text(copyrightText, pageWidth / 2, doc.internal.pageSize.getHeight() - 5, {
                        align: "center",
                    });
                }

                // Save the PDF
                doc.save(`Product_Report_${currentDate}.pdf`);
            });
        });
    </script>


</body>

</html>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <?php
    require_once('../db_connect.php');

    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'empty_fields') {
            echo "<p class='error'>Please fill in all fields.</p>";
        } elseif ($_GET['error'] == 'invalid_points') {
            echo "<p class='error'>Points required must be a positive number.</p>";
        } elseif ($_GET['error'] == 'invalid_quantity') {
            echo "<p class='error'>Quantity must be a positive number.</p>";
        }
    }

    $productname = $_GET['product'];
    $product_sql = "SELECT * FROM PRODUCT_GP1 WHERE ProductName = '$productname'";
    $product = $conn->query($product_sql);

    if ($product && $product->num_rows > 0) {
        $product = mysqli_fetch_array($product);
        
        echo "<h1>Edit Product</h1>";
        echo "<form action='process_edit_product.php' method='post'>";
        echo "<label for='productname'>Product Name:</label>";
        echo "<input type='text' name='productname' value='" . $product['ProductName'] . "'><br>";
        echo "<input type='hidden' name='original_name' value='" . $product['ProductName'] . "'>";
        echo "<label for='pointsrequired'>Points Required:</label>";
        echo "<input type='text' name='pointsrequired' value='" . $product['PointsRequired'] . "'><br>";
        echo "<label for='quantity'>Quantity:</label>";
        echo "<input type='text' name='quantity' value='" . $product['Quantity'] . "'><br>";
        echo "<button type='submit'>Edit Product</button>";
        echo "</form>";
    } else {
        echo "<p class='error'>Error: Product not found or query failed.</p>";
    }
    $conn->close();
    ?>
    <div class="nav-links">
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>
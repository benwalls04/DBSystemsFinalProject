<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addProduct($productName, $pointsRequired, $quantity){
    global $conn;

    if (empty($productName) || empty($pointsRequired) || empty($quantity)) {
        header("Location: add_product.php?error=empty_fields");
        exit;
    }

    if (!is_numeric($pointsRequired) || $pointsRequired <= 0) {
        header("Location: add_product.php?error=invalid_points");
        exit;
    }

    if (!is_numeric($quantity) || $quantity <= 0) {
        header("Location: add_product.php?error=invalid_quantity");
        exit;
    }

    $sql = "INSERT INTO PRODUCT_GP1 (ProductName, PointsRequired, Quantity) VALUES (TRIM('$productName'), '$pointsRequired', '$quantity')";
    $result = $conn->query($sql);
    
    if ($result) {
        header("Location: home.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['submit'])){
    addProduct($_POST['ProductName'], $_POST['PointsRequired'], $_POST['Quantity']);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>  
    <h1>Add Product</h1>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'empty_fields') {
            echo "<p class='error'>Please fill in all fields.</p>";
        } elseif ($_GET['error'] == 'invalid_points') {
            echo "<p class='error'>Points required must be a positive number.</p>";
        } elseif ($_GET['error'] == 'invalid_quantity') {
            echo "<p class='error'>Quantity must be a positive number.</p>";
        }
    }
    ?>
    
    <form action="add_product.php" method="POST">
        <label for="productName">Product Name:</label>
        <input type="text" name="ProductName" id="productName" required>
        <br>
        
        <label for="pointsRequired">Points Required:</label>
        <input type="number" name="PointsRequired" id="pointsRequired" required min="1">
        <br>
        
        <label for="quantity">Quantity:</label>
        <input type="number" name="Quantity" id="quantity" required min="1">
        <br>
        
        <button type="submit" name="submit">Add Product</button>
    </form>

    <div class="nav-links">
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>


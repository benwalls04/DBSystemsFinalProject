<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addProduct($productName, $pointsRequired, $quantity){
    global $conn;
    $sql = "INSERT INTO PRODUCT_GP1 (ProductName, PointsRequired, Quantity) VALUES ('$productName', '$pointsRequired', '$quantity')";
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
</head>
<body>  
    <h1>Add Product</h1>
    <form action="add_product.php" method="POST">
        <label for="productName">Product Name:</label>
        <input type="text" name="ProductName" id="productName" required>
        <br>
        <br>
        <label for="pointsRequired">Points Required:</label>
        <input type="number" name="PointsRequired" id="pointsRequired" required>
        <br>
        <br>
        <label for="quantity">Quantity:</label>
        <input type="number" name="Quantity" id="quantity" required>
        <br>
        <br>
        <button type="submit" name="submit">Add Product</button>
        <br>
        <br>
    </form>
</body>
</html>

<br>
<a href="home.php">Back to Home</a>


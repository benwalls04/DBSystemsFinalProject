<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$productname = $_GET['product'];
$sql = "SELECT * FROM PRODUCT_GP1 WHERE ProductName = '$productname'";
$product = $conn->query($sql);
$product = mysqli_fetch_array($product);

echo "<h1>Edit Product</h1>";
echo "<form action='process_edit_product.php' method='post'>";
echo "<label for='productname'>Product Name:</label>";
echo "<input type='text' name='productname' value='" . $product['ProductName'] . "'><br>";
echo "<input type='hidden' name='original_name' value='" . $product['ProductName'] . "'>";
echo "<label for='pointsrequired'>Points Required:</label>";
echo "<input type='text' name='pointsrequired' value='" . $product['PointsRequired'] . "'><br>";
echo "<label for='quantity'>Quantity:</label>";
echo "<input type='text' name='quantity' value='" . $product['Quantity'] . "'><br><br>";
echo "<input type='submit' value='Edit Product'>";
echo "</form>";
?>

<a href="home.php">Back to Home</a>
<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');

$originalProductName = $_POST['original_name'];
$newProductName = $_POST['productname'];
$pointsrequired = $_POST['pointsrequired'];
$quantity = $_POST['quantity'];

if (empty($newProductName) || empty($pointsrequired) || empty($quantity)) {
  header("Location: edit_product.php?error=empty_fields&product=$originalProductName");
  exit;
}

if (!is_numeric($pointsrequired) || $pointsrequired <= 0) {
  header("Location: edit_product.php?error=invalid_points&product=$originalProductName");
  exit;
}

if (!is_numeric($quantity) || $quantity <= 0) {
  header("Location: edit_product.php?error=invalid_quantity&product=$originalProductName");
  exit;
}

if ($quantity > 0){
  $update_sql = "UPDATE PRODUCT_GP1 SET ProductName = '$newProductName', PointsRequired = '$pointsrequired', Quantity = '$quantity' WHERE ProductName = '$originalProductName'";
  $conn->query($update_sql);
} else {
  $delete_sql = "DELETE FROM PRODUCT_GP1 WHERE ProductName = '$originalProductName'";
  $conn->query($delete_sql);
}

$conn->close();
header("Location: home.php");
?>
<?php
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');

$originalProductName = $_POST['original_name'];
$newProductName = $_POST['productname'];
$pointsrequired = $_POST['pointsrequired'];
$quantity = $_POST['quantity'];

if ($quantity > 0){
  $sql = "UPDATE PRODUCT_GP1 SET ProductName = '$newProductName', PointsRequired = '$pointsrequired', Quantity = '$quantity' WHERE ProductName = '$originalProductName'";
  $conn->query($sql);
} else {
  $sql = "DELETE FROM PRODUCT_GP1 WHERE ProductName = '$originalProductName'";
  $conn->query($sql);
}

header("Location: home.php");
$conn->close();
?>
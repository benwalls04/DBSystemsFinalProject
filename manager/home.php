<!DOCTYPE html>
<html>
<head>
    <title>Manager Home</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php
session_start();
require_once('../db_connect.php');

$sql1 = "SELECT * FROM MANAGER_GP1 WHERE MANAGER_GP1.UserID = '" . $_SESSION['userID'] . "'";
$userinfo = $conn->query($sql1);

$header = mysqli_fetch_array($userinfo);
echo "<h1>Welcome, " . $header['MgrName'] . "!" . "</h1>";
echo "<div class='nav-links'>";
echo "<a href='employees.php'>View Employees</a>";
echo "</div>";

$sql2 = "SELECT * FROM PRODUCT_GP1";
$products = $conn->query($sql2);

function deleteProduct($productName){
  global $conn;
  $delete_product_sql = "DELETE FROM PRODUCT_GP1 WHERE ProductName = '$productName'";
  $conn->query($delete_product_sql);
  $conn->close();
  header("Location: home.php");
}

function logout(){
  global $conn;
  $_SESSION['userID'] = Null;
  $conn->close();
  header("Location: ../index.php");
}

if (isset($_GET['delete'])) {
  deleteProduct($_GET['delete']);
  exit;
}

if (isset($_GET['logout'])) {
  logout();
  exit;
}

if ($products->num_rows > 0) {
  echo "<div class='transactions'>";
  echo "<h2>Products</h2>";
  echo "<table>";
  echo "<tr><th>Product Name</th><th>Points Required</th><th>Quantity</th><th></th><th></th></tr>";
  while ($row = mysqli_fetch_array($products)) {
    echo "<tr>
      <td>" . $row['ProductName'] . "</td>
      <td>" . $row['PointsRequired'] . "</td>
      <td>" . $row['Quantity'] . "</td>
      <td><a href='edit_product.php?product=" . $row['ProductName'] . "'>Edit</a></td>
      <td><a href='home.php?delete=" . $row['ProductName'] . "'>Delete</a></td></tr>";
  }
  echo "</table>";
  echo "</div>";
} else {
  echo "<p>No products found.</p>";
}

$conn->close();
?>
<div class="nav-links">
    <a href="add_product.php">Add Product</a>
    <a href="home.php?logout=1" class="logout-btn">Logout</a>
</div>
</body>
</html>
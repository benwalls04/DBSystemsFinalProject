<?php
session_start();
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');

$sql1 = "SELECT * FROM MANAGER_GP1 WHERE MANAGER_GP1.UserID = '" . $_SESSION['userID'] . "'";
$userinfo = $conn->query($sql1);

$header = mysqli_fetch_array($userinfo);
echo "<h1>Welcome, " . $header['MgrName'] . "!" . "</h1>";
echo "<a href='employees.php'>View Employees</a> <br>";

$sql2 = "SELECT * FROM PRODUCT_GP1";
$products = $conn->query($sql2);

function deleteProduct($productName){
  global $conn;
  $sql = "DELETE FROM PRODUCT_GP1 WHERE ProductName = '$productName'";
  $conn->query($sql);
  header("Location: home.php");
}

function logout(){
  global $conn;
  $_SESSION['userID'] = Null;
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
  echo "</table><br>";
}

$conn->close();
?>
<a href="add_product.php">Add Product</a><br><br>
<a href="home.php?logout=1">Logout</a>
</body>
</html>
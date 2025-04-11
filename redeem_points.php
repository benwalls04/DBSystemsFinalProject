<?php
session_start();
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
$userID = $_SESSION['userID'];

if (isset($_GET['error']) && $_GET['error'] == 'insufficient_points') {
  echo "<div style='color: red;'>You do not have enough points to redeem this product.</div>";
}

$sql = "SELECT * FROM PRODUCT_GP1";
$products = $conn->query($sql);
$sql2 = "SELECT * FROM BALANCE_GP1 WHERE UserID = '$userID'";
$balance = $conn->query($sql2);
$balance = mysqli_fetch_array($balance);

if ($products->num_rows > 0) {
  echo "<h1>Redeem Your Points</h1>";
  echo "Your balance is " . $balance['Balance'] . "<br><br>";
  echo "<table>";
  echo "<tr><th>Product Name</th><th>Points</th><th></th></tr>";
  while ($row = mysqli_fetch_array($products)) {
    if ($row['Quantity'] > 0) {
      echo "<tr><td>" . $row['ProductName'] . "</td><td>" . $row['PointsRequired'] . "</td><td><a href='process_redeem.php?product=" . $row['ProductName'] . "&points=" . $row['PointsRequired'] . "'>Select</a></td></tr>";
    };
  }
  echo "</table><br>";
  echo "<a href='employee_home.php'>Back to Home</a> <br>";
}
?>

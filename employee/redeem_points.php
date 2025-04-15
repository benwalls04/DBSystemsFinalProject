<!DOCTYPE html>
<html>
<head>
    <title>Redeem Points</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php
session_start();
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
$userID = $_SESSION['userID'];

$sql2 = "SELECT * FROM BALANCE_GP1 WHERE UserID = '$userID'";
$balanceResult = $conn->query($sql2);
$balance = mysqli_fetch_array($balanceResult);

if (isset($_GET['error']) && $_GET['error'] == 'insufficient_points') {
    echo "<p class='error'>You do not have enough points to redeem this product.</p>";
}

echo "<h1>Redeem Your Points</h1>";
echo "<p>Your balance is " . $balance['Balance'] . "</p>";

$sql = "SELECT * FROM PRODUCT_GP1";
$products = $conn->query($sql);

if ($products->num_rows > 0) {
    echo "<div class='transactions'>";
    echo "<table>";
    echo "<tr><th>Product Name</th><th>Points</th><th></th></tr>";
    while ($row = mysqli_fetch_array($products)) {
        if ($row['Quantity'] > 0) {
            echo "<tr><td>" . $row['ProductName'] . "</td><td>" . $row['PointsRequired'] . "</td><td><a href='process_redeem.php?product=" . $row['ProductName'] . "&points=" . $row['PointsRequired'] . "'>Select</a></td></tr>";
        };
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<p>No products available</p>";
}
?>
<div class="nav-links">
    <a href="home.php">Back to Home</a>
</div>
</body>
</html>

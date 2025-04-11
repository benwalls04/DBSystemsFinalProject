<?php
session_start();
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');

$sql1 = "SELECT * FROM EMPLOYEE_GP1, BALANCE_GP1 WHERE EMPLOYEE_GP1.UserID = BALANCE_GP1.UserID AND EMPLOYEE_GP1.UserID = '" . $_SESSION['userID'] . "'";
$userinfo = $conn->query($sql1);

$sql2 = "SELECT * FROM TRANSACTION_GP1 WHERE UserID = '" . $_SESSION['userID'] . "'";
$transactions = $conn->query($sql2);

$header = mysqli_fetch_array($userinfo);
echo "<h1>Welcome, " . $header['EmpName'] . "!" . "</h1>";
echo "Your balance is " . $header['Balance'] . " | "; 
echo "<a href='redeem_points.php'>Redeem Your Points</a> <br>";

if ($transactions->num_rows > 0) {
  echo "<h2>Transactions</h2>";
  echo "<table>";
  echo "<tr><th>Date</th><th>Points</th><th>Item</th></tr>";
  while ($row = mysqli_fetch_array($transactions)) {
    echo "<tr><td>" . $row['TransactionDate'] . "</td><td>" . $row['TransactionPoints'] . "</td><td>" . $row['TransactionItem'] . "</td></tr>";
  }
  echo "</table>";
}
?>
<br>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Home</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<?php
session_start();
require_once('../db_connect.php');

$user_sql = "SELECT * FROM EMPLOYEE_GP1, BALANCE_GP1 WHERE EMPLOYEE_GP1.UserID = BALANCE_GP1.UserID AND EMPLOYEE_GP1.UserID = '" . $_SESSION['userID'] . "'";
$userinfo = $conn->query($user_sql);

function logout(){
    global $conn;
    $_SESSION['userID'] = Null;
    $conn->close();
    header("Location: ../index.php");
}

if (isset($_GET['logout'])) {
    logout();
    exit;
}

if (isset($_GET['error'])){
  if ($_GET['error'] == "invalid_date") {
    echo "<p class='error'>Error: Invalid date</p>";
  }
  if ($_GET['error'] == "invalid_date_range") {
    echo "<p class='error'>Error: Invalid date range</p>";
  }
}

$header = mysqli_fetch_array($userinfo);
echo "<h1>Welcome, " . $header['EmpName'] . "!" . "</h1>";
echo "Your balance is " . $header['Balance'] . " | "; 
echo "<a href='redeem_points.php'>Redeem Your Points</a> <br>";
echo "<h2>Transactions</h2>";

$date_selected = false;

if (isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['start_date']) {
  if ($_GET['start_date'] == '' || $_GET['end_date'] == '') {
    header("Location: home.php?error=invalid_date");
    exit;
  } if (strtotime($_GET['start_date']) > strtotime($_GET['end_date'])) {
    header("Location: home.php?error=invalid_date_range");
    exit;
  }
  $date_selected = true;
}

if ($date_selected) {
  $start_date = $_GET['start_date'];
  $end_date = $_GET['end_date'];
  echo "from " . $start_date . " to " . $end_date;
} else {
  echo "All Transcations";
}

echo " | <a href='select_dates.php'>Select Dates</a>";

$transaction_sql = "SELECT * FROM TRANSACTION_GP1 WHERE UserID = '" . $_SESSION['userID'] . "'";
if ($date_selected) {
  $transaction_sql = "SELECT * FROM TRANSACTION_GP1 WHERE UserID = '" . $_SESSION['userID'] . "' AND TransactionDate BETWEEN '$start_date' AND '$end_date'";
}
$transactions = $conn->query($transaction_sql);

if ($transactions->num_rows > 0) {
  echo "<div class='transactions'>";
  echo "<h2>Transactions</h2>";
  echo "<table>";
  echo "<tr><th>Date</th><th>Points</th><th>Item</th></tr>";
  while ($row = mysqli_fetch_array($transactions)) {
    echo "<tr><td>" . $row['TransactionDate'] . "</td><td>" . $row['TransactionPoints'] . "</td><td>" . $row['TransactionItem'] . "</td></tr>";
  }
  echo "</table>";
  echo "</div>";
} else {
  echo "<p>No transactions found</p>";
}

$conn->close();
?>
<br>
<a href="home.php?logout=1" class="logout-btn">Logout</a>
</body>
</html>
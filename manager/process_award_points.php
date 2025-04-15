<?php
session_start();
$conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$points = $_POST['points'];

if (!is_numeric($points) || $points <= 0) {
    echo "Please enter a valid number of points.";
    exit();
}

$userIDs = [];
if (isset($_POST['employees']) && !empty($_POST['employees'])) {
    $userIDs = $_POST['employees'];
} 

if (isset($_POST['group']) && !empty($_POST['group'])) {
    $groupNo = $_POST['group'];
    
    if (!is_numeric($groupNo)) {
        echo "Invalid group number.";
        exit();
    }
    
    $sql = "SELECT UserID FROM EMPLOYEE_GP1 WHERE GroupNo = $groupNo";
    $result = $conn->query($sql);
    
    while ($row = $result->fetch_assoc()) {
        if (!in_array($row['UserID'], $userIDs)) {
            $userIDs[] = $row['UserID'];
        }
    }
}

if (empty($userIDs)) {
    header("Location: award_points_form.php?error=no_employees_selected");
    exit();
}

foreach ($userIDs as $userID) {
    $escapedUserID = $conn->real_escape_string($userID);
    $balance_sql = "UPDATE BALANCE_GP1 SET Balance = Balance + $points WHERE UserID = '$escapedUserID'";
    $transaction_sql = "INSERT INTO TRANSACTION_GP1 (UserID, TransactionDate, TransactionType, TransactionPoints, TransactionItem) VALUES ('$escapedUserID', NOW(), 'Award', '$points', 'Points Awarded')";

    $balance_result = $conn->query($balance_sql);
    if ($balance_result === false) {
        echo "Error updating balance for user $userID";
    }

    $transaction_result = $conn->query($transaction_sql);
    if ($transaction_result === false) {
        echo "Error recording transaction for user $userID";
    }
}

header("Location: employees.php");
echo "$points points successfully awarded to " . count($userIDs) . " employees.<br>";

$conn->close();
?>
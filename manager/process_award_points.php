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
    echo "Please select at least one employee or group.";
    exit();
}

foreach ($userIDs as $userID) {
    $escapedUserID = $conn->real_escape_string($userID);
    $sql = "UPDATE BALANCE_GP1 SET Balance = Balance + $points WHERE UserID = '$escapedUserID'";
    $result = $conn->query($sql);
}

header("Location: employees.php");
echo "$points points successfully awarded to " . count($userIDs) . " employees.<br>";

$conn->close();
?>
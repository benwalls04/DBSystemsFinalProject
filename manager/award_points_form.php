<!DOCTYPE html>
<html>
<head>
    <title>Award Points</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Award Points</h1>
    <?php
    $conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
    $sql = "SELECT * FROM EMPLOYEE_GP1, BALANCE_GP1 WHERE EMPLOYEE_GP1.UserID = BALANCE_GP1.UserID";
    $result = $conn->query($sql);

    $sql2 = "SELECT DISTINCT GroupNo FROM EMPLOYEE_GP1";
    $groups = $conn->query($sql2);

    if (isset($_GET['error']) && $_GET['error'] == 'no_employees_selected') {
        echo "<p class='error'>Please select at least one employee or group.</p>";
    }
    ?>

    <form action='process_award_points.php' method='POST'>
        <label for='points'>Points to Award:</label>
        <input type='number' name='points' id='points' min='1' required>
        <br><br>
        
        <h2>Select Employees</h2>
        <div class="checkbox-group">
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<div class='checkbox-item'>";
                echo "<input type='checkbox' name='employees[]' value='" . $row['UserID'] . "' id='emp" . $row['UserID'] . "'>";
                echo "<label for='emp" . $row['UserID'] . "'>" . $row['EmpName'] . " (Balance: " . $row['Balance'] . ")</label>";
                echo "</div>";
            }
            ?>
        </div>

        <h2>Or Select a Group</h2>
        <select name='group' id='group'>
            <option value=''>-- Select a Group --</option>
            <?php
            while ($row = mysqli_fetch_array($groups)) {
                echo "<option value='" . $row['GroupNo'] . "'>Group " . $row['GroupNo'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <button type='submit'>Award Points</button>
    </form>

    <div class="nav-links">
        <a href='employees.php'>Back to Employees</a>
    </div>
</body>
</html>

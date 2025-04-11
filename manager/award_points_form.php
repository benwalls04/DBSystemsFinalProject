<?php
    $conn = new mysqli('localhost', 'root', 'Bg053104!', 'GP25');
    $sql = "SELECT * FROM EMPLOYEE_GP1, BALANCE_GP1 WHERE EMPLOYEE_GP1.UserID = BALANCE_GP1.UserID";
    $result = $conn->query($sql);

    $sql2 = "SELECT DISTINCT GroupNo FROM EMPLOYEE_GP1";
    $groups = $conn->query($sql2);
    
    echo "<h1>Award Points</h1>";
    echo "<form action='process_award_points.php' method='POST'>";
    
    echo "<label for='points'>Points to Award: </label>";
    echo "<input type='number' name='points' id='points' min='1' required><br><br>";
    
    echo "<label>Select Employees to Award Points:</label><br>";
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<input type='checkbox' name='employees[]' value='" . $row['UserID'] . "' id='emp" . $row['UserID'] . "'>";
        echo "<label for='emp" . $row['UserID'] . "'>" . $row['EmpName'] . " (Current Balance: " . $row['Balance'] . ")</label>";
        echo "<br>";
    }

    // Replace group checkboxes with a dropdown
    echo "<br><label for='group'>Or Select a Group to Award Points:</label>";
    echo "<select name='group' id='group'>";
    echo "<option value=''>-- Select a Group --</option>";
    
    while ($row = mysqli_fetch_array($groups)) {
        echo "<option value='" . $row['GroupNo'] . "'>Group " . $row['GroupNo'] . "</option>";
    }
    
    echo "</select><br><br>";
    
    echo "<input type='submit' value='Award Points'>";
    echo "</form>";
    echo "<a href='employees.php'>Back to Employees</a>";

    $conn->close();
?>

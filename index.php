<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>  
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials') {
        echo "<p class='error'>Invalid username or password</p>";
    }
    ?>
    <h1>Login to your account</h1>
    <form action="process_login.php" method="POST">
        <label for="usertype">User Type:</label>
        <select name="UserType" id="usertype">
            <option value="Employee">Employee</option>
            <option value="Manager">Manager</option>
        </select>
        <br>
        <br>
        <label for="userid">User ID:</label>
        <input type="text" name="UserId" id="userid">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="Password" id="password">
        <br>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Select Dates</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Select Date Range</h1>
    <form action="home.php" method="GET">
        <label for='start_date'>Start Date:</label>
        <input type='date' id='start_date' name='start_date'>
        <br>
        <label for='end_date'>End Date:</label>
        <input type='date' id='end_date' name='end_date'>
        <br>
        <input type='submit' value='Submit'>
    </form>
    <div class="nav-links">
        <a href="home.php">Back to Home</a>
    </div>
</body>
</html>

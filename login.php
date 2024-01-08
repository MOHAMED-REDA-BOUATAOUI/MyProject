<?php
// Replace these variables with your actual database credentials
$dbhost = "Localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "jul_car_db";

// Create a connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Function to display error message and redirect
function showError($message) {
    echo "<script>alert('$message'); window.location.href='login.php';</script>";
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = sanitize($_POST["Username"]);
    $password = sanitize($_POST["password"]);

    // Query to check if the user exists in the database
    $query = "SELECT * FROM Clients WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // User exists, redirect to the home page or another secure page
        header("Location: car_listing.php");
    } else {
        // User does not exist, show error message
        showError("Username or password incorrect");
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>JulCar Login</title>
</head>
<body>
    <div class="login-container">
        <form action="" method="post">
            <h2>Login</h2>
            <input type="text" name="Username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
    </div>

</body>
</html>


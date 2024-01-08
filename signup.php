<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jul_car_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $permis = $_POST['Permis'];
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $phone = $_POST['Phone'];
    $username = $_POST['Username'];
    $password = $_POST['password'];

    // Example: Insert user into the 'users' table
    $sql = "INSERT INTO Clients (Permis, firstname, lastname, phone, username, password) VALUES ('$permis','$firstname', '$lastname', '$phone','$username','$password')";

    if ($conn->query($sql) === TRUE) {
        echo "User '$username' registered successfully";
        header("Location: login.php");
    } else {
        echo "Error registering user: " . $conn->error;
    }
}

$conn->close();




?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sign Up</title>
    <script src="validatefform.js"></script>
</head>
<body>
  
    <div class="signup-container">
        <form action="" method="post">
            <h2>Sign Up</h2>
             <input type="text" name="Permis" placeholder="Permis" required> <br>
             <input type="text" name="FirstName" placeholder="FirstName" required> <br>
             <input type="text" name="LastName" placeholder="LastName" required><br>
             <input type="text" name="Phone" placeholder="Phone" required><br>
             <input type="text" name="Username" placeholder="Username" required><br>
             <input type="password" name="password" placeholder="Password" required><br>
            
            <input type="submit" value="Sign Up">
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
    <style>
        background-image: url("background.jpg");
    </style>
</body>
</html>

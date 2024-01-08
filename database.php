<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = " jul_car_db";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS jul_car_db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

 $conn->close();

// Connect to the newly created database
 $conn = new mysqli($servername, $username, $password, "jul_car_db");

// Check connection
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create users table
$query = "
CREATE TABLE Clients (
 Permis INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 firstname VARCHAR(30) NOT NULL,
 lastname VARCHAR(30) NOT NULL,
 phone VARCHAR(30) NOT NULL,
 email VARCHAR(50) UNIQUE,
 password VARCHAR(80)
 )
";
if (mysqli_query($conn, $query)) {
 echo "Table Clients created successfully";
} else {
 echo "Error creating table: " . mysqli_error($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cars Management</title>
    <!-- Add any additional styles or scripts here -->

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('background.jpg'); /* Replace 'background.jpg' with your image file */
            background-size: cover;
            background-position: center;
            color: #fff; /* Text color */
        }

        h1 {
            text-align: center;
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background for better readability */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        label {
            display: block;
            margin: 10px 0;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50; /* Green */
            color: white;
            border: none;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1>Cars Management</h1>

<form action="cars_management.php" method="post" enctype="multipart/form-data">
    <label for="matricule">Matricule:</label>
    <input type="text" name="matricule" required><br>

    <label for="marque">Marque:</label>
    <input type="text" name="marque" required><br>

    <label for="model">Model:</label>
    <input type="text" name="model" required><br>

    <label for="carburant_type">Carburant Type:</label>
    <select name="type_carburant" required>
        <option value="essence">Essence</option>
        <option value="diesel">Diesel</option>
    </select><br>

    <label for="image">Car Image:</label>
    <input type="file" name="image" accept="image/*" required><br>

    <input type="submit" name="add_car" value="Add Car">
</form>

<?php

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_car"])) {
    // Get form data
    $matricule = $_POST["matricule"];
    $marque = $_POST["marque"];
    $model = $_POST["model"];
    $type_carburant = $_POST["type_carburant"];
    $imagePath = $_POST["image"];

    // Handle image upload
    $imagePath = "uploads/" . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

    // Insert data into the database
    $insertQuery = "INSERT INTO cars (matricule, marque, model, type_carburant, image_path) VALUES ('$matricule', '$marque', '$model', '$type_carburant', '$imagePath')";
    if ($conn->query($insertQuery) === TRUE) {
        echo "Car added successfully.";
    } else {
        echo "Error adding car: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

</body>
</html>


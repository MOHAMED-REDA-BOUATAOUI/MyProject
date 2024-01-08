<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Listing</title>
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

<h1>Car Listing</h1>

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

// Query to retrieve car information
$query = "SELECT * FROM Cars";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Display each car
    while ($row = $result->fetch_assoc()) {
        $matricule = $row['Matricule'];
        $marque = $row['Marque'];
        $model = $row['Model'];
        $typedecarburant = $row['Energy_type'];
        $imagePath = $row['image_path'];

        echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 20px;'>";
        echo "<img src='$imagePath' alt='$model' style='max-width: 200px;'><br>";
        echo "Model: $model<br>";
        echo "Matricule: $matricule<br>";
        echo "Energy Type: $energyType<br>";
        echo "<button onclick='reserveCar(\"$model\")'>Reserve</button>";
        echo "</div>";
    }
} else {
    echo "No cars available.";
}

// Close the database connection
$conn->close();
?>

<script>
    // JavaScript function to handle car reservation
    function reserveCar(model) {
        // You can implement the reservation logic here, such as showing a confirmation message or redirecting to a reservation page.
        alert("Car reserved: " + model);
    }
</script>

</body>
</html>

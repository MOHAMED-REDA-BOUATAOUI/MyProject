
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-image: url('background.jpg'); /* Replace 'your-background-image.jpg' with your image file */
            background-size: cover;
            background-position: center;
            color: #fff; /* Set the text color to contrast with the background */
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        select, input[type="date"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Reservation</h2>

<form action="reserve.php" method="post">
    <label for="permis">Client Permit:</label>
    <select name="permis" required>
        <?php
        // Replace these variables with your actual database credentials
        $dbhost = "Localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "jul_car_db";

        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch permit data from the clients table
        $permisQuery = "SELECT permis FROM clients";
        $permisResult = $conn->query($permisQuery);

        if ($permisResult->num_rows > 0) {
            while ($row = $permisResult->fetch_assoc()) {
                echo "<option value='" . $row['permis'] . "'>" . $row['permis'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No clients available</option>";
        }

        $conn->close();
        ?>
    </select>

    <label for="marque">Marque:</label>
    <select name="model" required>
        <?php
        // Replace these variables with your actual database credentials
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch car model data from the cars table
        $modelQuery = "SELECT DISTINCT model FROM cars";
        $modelResult = $conn->query($modelQuery);

        if ($modelResult->num_rows > 0) {
            while ($row = $modelResult->fetch_assoc()) {
                echo "<option value='" . $row['model'] . "'>" . $row['model'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No car models available</option>";
        }

        $conn->close();
        ?>
    </select>

    <label for="model">Model:</label>
    <select name="marque" required>
        <?php
        // Replace these variables with your actual database credentials
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch car brand data from the cars table
        $marqueQuery = "SELECT DISTINCT marque FROM cars";
        $marqueResult = $conn->query($marqueQuery);

        if ($marqueResult->num_rows > 0) {
            while ($row = $marqueResult->fetch_assoc()) {
                echo "<option value='" . $row['marque'] . "'>" . $row['marque'] . "</option>";
            }
        } else {
            echo "<option value='' disabled>No car brands available</option>";
        }
       
        $conn->close();

        

        ?>
    </select>

    <label for="date_sortie">Date Sortie:</label>
    <input type="date" name="date_sortie" required>

    <label for="date_entree">Date Sortie:</label>
    <input type="date" name="date_entree" required>

    <input type="submit" name="submit_reservation" value="Submit Reservation">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_reservation"])) {
    // Replace these variables with your actual database credentials
    $dbhost = "Localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "jul_car_db";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Retrieve form data
        $permis = $_POST["permis"];
        $model = $_POST["model"];
        $marque = $_POST["marque"];
        $date_sortie = $_POST["date_sortie"];
        $date_entree = $_POST["date_entree"];
    
        // Your validation and sanitation code goes here
    
        // Insert data into the reservation table
        $insertQuery = "INSERT INTO reservation (permis, model, date_sortie, date_entrée)
                        VALUES ('$permis', '$model', '$date_sortie', '$date_entree')";
    
        if ($conn->query($insertQuery) === TRUE) {
            // Redirect to the Thank You page after successful submission
            header("Location: thanks.php");
            exit();
        } else {
            echo "<p style='color: red; text-align: center;'>Error: " . $conn->error . "</p>";
        }
    
        $conn->close();
    }
    
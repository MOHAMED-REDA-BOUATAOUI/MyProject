<?php

$dbhost = "Localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "jul_car_db";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "student";

// connection
$conn = mysqli_connect($hostname, $username, $password, $database);

// check
if (!$conn) {
    die("Error :" . mysqli_connect_error());
}

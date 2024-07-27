<?php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "latihanapppenggajian"; // Your database name

// Create connection
$konek = mysqli_connect("localhost", "root", "", "latihanapppenggajian");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>

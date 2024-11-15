<?php
$host = 'localhost';
$db = 'recipe_sharing';
$user = 'root'; 
$pass = ''; 

// Create a connection
$connection = mysqli_connect($host, $user, $pass, $db);

// Check the connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

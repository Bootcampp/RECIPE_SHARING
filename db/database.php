<?php
$host = 'localhost';
$db = 'webtech_fall2024_afia_asante';
$user = 'root'; 
$pass = 'setumte3'; 

// Create a connection
$connection = mysqli_connect($host, $user, $pass, $db);

// Check the connection
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
return $connection;

?>

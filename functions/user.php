<?php
include '../db/database.php';
include '../db/config.php';

// Function to fetch logged-in user's name
function getLoggedInUserName($user_id) {
    global $connection;
    
    // Query to get user's name from the database (assuming a 'users' table with 'name' column)
    $query = "SELECT fname FROM users WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($user_name);
    $stmt->fetch();
    $stmt->close();
    
    return $user_name;
}

// Fetch logged-in user name based on session user_id
$user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login
$user_name = getLoggedInUserName($user_id);
?>

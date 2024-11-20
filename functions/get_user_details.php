<?php
include_once '../db/database.php';
include_once '../functions/user_functions.php';

header('Content-Type: application/json');

// Check if the ID is provided
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Get user details
    $user = getUserById($connection, $userId);

    if ($user) {
        echo json_encode($user);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid ID']);
}
?>

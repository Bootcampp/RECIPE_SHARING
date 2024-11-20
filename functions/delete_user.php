<?php
include_once '../db/database.php';
include_once '../functions/user_functions.php';

header('Content-Type: application/json');

// Check if user ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'] ?? null;

    if ($userId) {
        // Delete user
        $result = deleteUser($connection, $userId);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to delete user']);
        }
    } else {
        echo json_encode(['error' => 'User ID is required']);
}
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>

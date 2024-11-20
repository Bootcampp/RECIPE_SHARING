<?php
include_once '../db/database.php';
include_once '../functions/user_functions.php';

header('Content-Type: application/json');

// Check if required fields are present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'] ?? null;
    $firstName = $_POST['firstName'] ?? null;
    $lastName = $_POST['lastName'] ?? null;
    $email = $_POST['email'] ?? null;
    $role = $_POST['role'] ?? null;

    if ($userId && $firstName && $lastName && $email && $role) {
        // Update user
        $result = updateUser($connection, $userId, $firstName, $lastName, $email, $role);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to update user']);
        }
    } else {
        echo json_encode(['error' => 'Invalid input data']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>

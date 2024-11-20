<?php
require_once __DIR__ . '/../db/database.php';

/**
 * Fetch all users from the database.
 */
function getAllUsers($connection) {
    $query = "SELECT user_id, fname, lname, email, role FROM users ORDER BY user_id";
    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        return [];
    }
    
    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
    
    return $users;
}

/**
 * Get a single user's details by their ID.
 */
function getUserById($connection, $userId) {
    $query = "SELECT user_id, fname, lname, email, role, created_at, updated_at FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}

/**
 * Update user information.
 */
function updateUser($connection, $userId, $fname, $lname, $email, $role) {
    $query = "UPDATE users SET fname = ?, lname = ?, email = ?, role = ?, updated_at = NOW() WHERE user_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'sssii', $fname, $lname, $email, $role, $userId);
    return mysqli_stmt_execute($stmt);
}

/**
 * Delete a user by their ID.
 */
function deleteUser($connection, $userId) {
    $query = "DELETE FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    return mysqli_stmt_execute($stmt);
}

/**
 * Get the role name based on the role ID.
 */
function getRoleName($role) {
    switch ($role) {
        case 1:
            return 'Super Admin';
        case 2:
            return 'Admin';
        default:
            return 'User';
    }
}

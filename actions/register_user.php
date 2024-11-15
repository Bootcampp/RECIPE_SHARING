<?php
// Include the database connection
include '../db/database.php';
include '../db/config.php';

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $fname = isset($_POST['fname']) ? trim($_POST['fname']) : '';
    $lname = isset($_POST['lname']) ? trim($_POST['lname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $role =  2; // Default to 'user' role if not specified

    // Validate the inputs
    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
        // Check if the email already exists
        $stmt = mysqli_prepare($connection, "SELECT user_id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // If the email already exists, redirect with an error message
        if (mysqli_stmt_num_rows($stmt) > 0) {
            header("Location: ../view/register.php?msg=Email already exists.");
            exit;
        }

        // Close the statement
        mysqli_stmt_close($stmt);

        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to insert the new user
        $stmt = mysqli_prepare($connection, "INSERT INTO users (fname, lname, email, password, role) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssssi", $fname, $lname, $email, $hashed_password, $role);

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to login page with a success message
            header("Location: ../view/login.php?msg=Registration successful. Please login.");
        } else {
            // If there is an error during insertion, redirect with an error message
            header("Location: ../view/register.php?msg=Error during registration. Please try again.");
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Redirect with an error message if any field is empty
        header("Location: ../view/register.php?msg=Please fill in all fields.");
    }
} else {
    // Redirect with an error message if the request is not POST
    header("Location: ../view/register.php?msg=Invalid access method.");
}

// Close the database connection
mysqli_close($connection);
?>

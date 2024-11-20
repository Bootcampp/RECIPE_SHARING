<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        // No user logged in, redirect to login page
        header("Location: ../view/login.php?msg=Please Login first!");
        exit();
    }
}


function redirectBasedOnRole() {
    // Check user role
    $role = $_SESSION['role'];

    if ($role == 1) {
        // Super Admin
        header("Location: ../view/admin/dashboard.php");
        exit();
    } elseif ($role == 2) {
        // Regular Admin
        header("Location: ../view/userdashboard.php");
        exit();
    } else {
        // Unknown role, log out the user
        header("Location: ../actions/logout.php?msg=Invalid Role!");
        exit();
    }
}
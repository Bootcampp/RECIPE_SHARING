<?php
session_start();

function checkLogin() {
    if (!isset($_SESSION['user_id'])) {
        // No user logged in, redirect to login page
        header("Location: ../view/login.php?msg=Please Login first!");
        exit();
    }
}
<?php
header('Content-Type: application/json');

// Error reporting to help diagnose issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db/database.php';
include '../functions/user.php';

try {
    // Check login
    checkLogin();
    $userId = $_SESSION['user_id'];

    // Get submissions by month for the past 6 months
    $query = "SELECT 
        DATE_FORMAT(created_at, '%Y-%m') AS month, 
        COUNT(*) AS recipe_count 
    FROM foods 
    WHERE created_by = ? AND created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 6 MONTH)
    GROUP BY month 
    ORDER BY month";

    $stmt = $connection->prepare($query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $connection->error);
    }

    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $labels = [];
    $values = [];

    // Populate labels and values
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['month'];
        $values[] = intval($row['recipe_count']);
    }

    // Ensure we have data
    if (empty($labels)) {
        $labels = ['No Data'];
        $values = [0];
    }

    // Return JSON response
    echo json_encode([
        'labels' => $labels,
        'values' => $values
    ]);

    $stmt->close();
    $connection->close();
} catch (Exception $e) {
    // Send error as JSON
    http_response_code(500);
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
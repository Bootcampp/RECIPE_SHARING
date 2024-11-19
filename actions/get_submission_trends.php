<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db/database.php';
include '../functions/user.php';

try {
    checkLogin();
    $userId = $_SESSION['user_id'];

    // Modify query to get more comprehensive data
    $query = "SELECT 
        DATE_FORMAT(created_at, '%b %Y') AS month, 
        COUNT(*) AS recipe_count 
    FROM foods 
    WHERE created_by = ?
    GROUP BY month 
    ORDER BY created_at";

    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $labels = [];
    $values = [];

    // Fetch ALL rows
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['month'];
        $values[] = intval($row['recipe_count']);
    }

    // Ensure we have some data or default
    if (empty($labels)) {
        $labels = ['No Data'];
        $values = [0];
    }

    echo json_encode([
        'labels' => $labels,
        'values' => $values,
        'debug' => [
            'total_rows' => count($labels),
            'first_label' => $labels[0] ?? 'N/A',
            'first_value' => $values[0] ?? 'N/A'
        ]
    ]);

    $stmt->close();
    $connection->close();
} catch (Exception $e) {
    echo json_encode([
        'error' => $e->getMessage()
    ]);
}
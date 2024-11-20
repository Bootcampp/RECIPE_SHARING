<?php
ob_clean();
header('Content-Type: application/json; charset=utf-8');
error_reporting(0);

include '../db/database.php';
include '../db/config.php';

if ($connection->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Database connection failed']));
}

if (!isset($_GET['recipe_id']) || !is_numeric($_GET['recipe_id'])) {
    http_response_code(400);
    die(json_encode(['error' => 'Invalid recipe ID']));
}

$recipe_id = intval($_GET['recipe_id']);

$query = "
    SELECT 
        f.name AS recipe_name,
        f.instructions,
        f.origin,
        n.protein, 
        n.carbohydrates, 
        n.fat,
        f.image_url AS recipe_image
    FROM foods f
    LEFT JOIN nutritionfacts n ON f.food_id = n.food_id
    WHERE f.food_id = ?
";

$stmt = $connection->prepare($query);
if (!$stmt) {
    http_response_code(500);
    die(json_encode(['error' => 'Failed to prepare statement']));
}

$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode([
        'name' => $row['recipe_name'] ?? '',
        'instructions' => $row['instructions'] ?? '',
        'origin' => $row['origin'] ?? '',
        'nutritional_value' => sprintf(
            'Protein: %s g, Carbs: %s g, Fat: %s g', 
            $row['protein'] ?? '0', 
            $row['carbohydrates'] ?? '0', 
            $row['fat'] ?? '0'
        ),
        'recipe_image' => !empty($row['recipe_image']) ? $row['recipe_image'] : 'placeholder.jpg'
    ], JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Recipe not found']);
}

$stmt->close();
$connection->close();
exit();
?>
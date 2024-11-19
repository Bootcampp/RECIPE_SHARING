<?php
include '../db/database.php';  
header('Content-Type: application/json'); 

if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];

    // Complex query joining recipes, foods, and ingredients
    $sql = "SELECT 
        r.recipe_id, 
        r.quantity, 
        r.unit,
        f.name, 
        f.origin AS food_origin,
        f.description AS food_description,
        f.preparation_time AS prep_time,
        f.cooking_time,
        f.serving_size,
        f.calories_per_serving AS calories,
        f.image_url AS recipe_image,
        f.instructions,
        i.nutritional_value,
        i.allergen_info,
        i.shelf_life,
        i.origin AS ingredient_origin
    FROM recipes r
    JOIN foods f ON r.food_id = f.food_id
    JOIN ingredients i ON r.ingredient_id = i.ingredient_id
    WHERE r.recipe_id = ?";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $recipe = $result->fetch_assoc();
        echo json_encode($recipe);
    } else {
        echo json_encode(['error' => 'Recipe not found']);
    }

    $stmt->close();
    $connection->close();
} else {
    echo json_encode(['error' => 'No recipe ID provided']);
}
?>
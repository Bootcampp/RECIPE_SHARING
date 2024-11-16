<?php
// get_recipe_details.php
include '../db/database.php';
include '../db/config.php';


// Function to fetch detailed recipe information
function getRecipeDetails($recipe_id, $connection) {
    // SQL query to fetch detailed recipe information
    $details_query = "
        SELECT f.name AS recipe_name, r.ingredients, r.origin, r.nutritional_value, 
               r.allergen_info, r.shelf_life, r.quantity, r.unit, r.recipe_image, 
               r.prep_time, r.cooking_time, r.serving_size, r.food_description, 
               r.calories, r.food_origin, r.instructions
        FROM recipes r
        JOIN foods f ON r.food_id = f.food_id
        WHERE r.recipe_id = ?
    ";
    
    // Prepare statement
    $details_stmt = $connection->prepare($details_query);
    if (!$details_stmt) {
        die("Database statement preparation failed: " . $connection->error);
    }
    
    // Bind the recipe_id parameter
    $details_stmt->bind_param("i", $recipe_id);
    
    // Execute the query
    $details_stmt->execute();
    
    // Bind results
    $details_stmt->bind_result($recipe_name, $ingredients, $origin, $nutritional_value, 
                               $allergen_info, $shelf_life, $quantity, $unit, $recipe_image, 
                               $prep_time, $cooking_time, $serving_size, $food_description, 
                               $calories, $food_origin, $instructions);
    
    // Fetch the result
    $recipe_details = [];
    if ($details_stmt->fetch()) {
        $recipe_details = [
            'name' => $recipe_name,
            'ingredients' => $ingredients,
            'origin' => $origin,
            'nutritional_value' => $nutritional_value,
            'allergen_info' => $allergen_info,
            'shelf_life' => $shelf_life,
            'quantity' => $quantity,
            'unit' => $unit,
            'recipe_image' => $recipe_image,
            'prep_time' => $prep_time,
            'cooking_time' => $cooking_time,
            'serving_size' => $serving_size,
            'food_description' => $food_description,
            'calories' => $calories,
            'food_origin' => $food_origin,
            'instructions' => $instructions
        ];
    }
    
    // Close the statement
    $details_stmt->close();
    
    // Return the recipe details
    return $recipe_details;
}


if (isset($_GET['recipe_id'])) {
    $recipe_id = $_GET['recipe_id'];

    // Call function to get recipe details
    $recipe_details = getRecipeDetails($recipe_id, $connection);

    // Return the recipe details as JSON
    echo json_encode($recipe_details);
} else {
    echo json_encode([]);
}
?>

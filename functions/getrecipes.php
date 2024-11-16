<?php
include '../db/database.php';
include '../db/config.php';
$user_id = $_SESSION['user_id'] ?? null;

function getUserRecipes($user_id, $connection) {
    // SQL query to fetch recipe name from foods table and other recipe details from recipes table
    $recipes_query = "
        SELECT r.recipe_id, f.name AS recipe_name, r.created_at
        FROM recipes r
        JOIN foods f ON r.food_id = f.food_id
        WHERE f.created_by = ?
    ";
    
    // Prepare statement
    $recipes_stmt = $connection->prepare($recipes_query);
    if (!$recipes_stmt) {
        die("Database statement preparation failed: " . $connection->error);
    }
    
    // Bind the user_id parameter
    $recipes_stmt->bind_param("i", $user_id);
    
    // Execute the query
    $recipes_stmt->execute();
    
    // Bind results
    $recipes_stmt->bind_result($recipe_id, $recipe_name, $date_created);
    
    // Fetch results into an array
    $recipes = [];
    while ($recipes_stmt->fetch()) {
        $recipes[] = [
            'id' => $recipe_id,
            'name' => $recipe_name,
            'date_created' => $date_created
        ];
    }
    
    // Close the statement
    $recipes_stmt->close();
    
    // Return the array of recipes
    return $recipes;
}


$recipes = getUserRecipes($user_id, $connection);
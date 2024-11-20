<?php
include '../db/database.php';

function getAllRecipes($connection) {
    // SQL query to fetch all recipe details
    $recipes_query = "
        SELECT 
            r.recipe_id, 
            f.name AS recipe_name, 
            r.created_at, 
            u.fname AS created_by_first_name, 
            u.lname AS created_by_last_name 
        FROM recipes r
        JOIN foods f ON r.food_id = f.food_id
        JOIN users u ON f.created_by = u.user_id
    ";

    // Prepare statement
    $recipes_stmt = $connection->prepare($recipes_query);
    if (!$recipes_stmt) {
        die("Database statement preparation failed: " . $connection->error);
    }
    
    // Execute the query
    $recipes_stmt->execute();

    // Bind results
    $recipes_stmt->bind_result($recipe_id, $recipe_name, $date_created, $created_by_first_name, $created_by_last_name);

    // Fetch results into an array
    $recipes = [];
    while ($recipes_stmt->fetch()) {
        $recipes[] = [
            'id' => $recipe_id,
            'name' => $recipe_name,
            'date_created' => $date_created,
            'created_by' => $created_by_first_name . ' ' . $created_by_last_name
        ];
    }

    // Close the statement
    $recipes_stmt->close();

    // Return the array of recipes
    return $recipes;
}

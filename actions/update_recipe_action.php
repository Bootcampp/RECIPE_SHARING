<?php
include '../db/database.php';

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipeId = $_GET['id'];

    // Prepare data from POST request
    $name = $connection->real_escape_string($_POST['recipe_title']);
    $origin = $connection->real_escape_string($_POST['origin']);
    $instructions = $connection->real_escape_string($_POST['instructions']);
    $foodDescription = $connection->real_escape_string($_POST['food_description']);
    $prepTime = $connection->real_escape_string($_POST['prep_time']);
    $cookingTime = $connection->real_escape_string($_POST['cooking_time']);
    $servingSize = $connection->real_escape_string($_POST['serving_size']);
    $calories = $connection->real_escape_string($_POST['calories']);
    $recipeImage = $connection->real_escape_string($_POST['recipe_image']);
    $quantity = $connection->real_escape_string($_POST['quantity']);
    $unit = $connection->real_escape_string($_POST['unit']);

    // Debug: Check if recipe exists
    $checkRecipeSql = "SELECT * FROM recipes WHERE recipe_id = '$recipeId'";
    $checkRecipeResult = $connection->query($checkRecipeSql);
    if ($checkRecipeResult->num_rows == 0) {
        header("Location: ../view/recipes.php?msg=Recipe ID not found!");
        exit();
    }

    // Retrieve food_id and ingredient_id
    $retrieveIdsSql = "SELECT food_id, ingredient_id FROM recipes WHERE recipe_id = '$recipeId'";
    $idsResult = $connection->query($retrieveIdsSql);
    $ids = $idsResult->fetch_assoc();
    $foodId = $ids['food_id'];
    $ingredientId = $ids['ingredient_id'];

    // Update Foods table
    $foodUpdateSql = "UPDATE foods 
    SET 
        name = '$name', 
        origin = '$origin', 
        instructions = '$instructions', 
        description = '$foodDescription', 
        preparation_time = '$prepTime', 
        cooking_time = '$cookingTime', 
        serving_size = '$servingSize', 
        calories_per_serving = '$calories', 
        image_url = '$recipeImage'
    WHERE food_id = '$foodId'";
    $foodUpdateResult = $connection->query($foodUpdateSql);

    // Update Ingredients table
    $ingredientUpdateSql = "UPDATE ingredients 
    SET 
        origin = '$origin', 
        nutritional_value = '{$_POST['nutritional_value']}', 
        allergen_info = '{$_POST['allergen_info']}', 
        shelf_life = '{$_POST['shelf_life']}'
    WHERE ingredient_id = '$ingredientId'";
    $ingredientUpdateResult = $connection->query($ingredientUpdateSql);

    // Update Recipes table
    $recipeUpdateSql = "UPDATE recipes 
    SET 
        quantity = '$quantity', 
        unit = '$unit'
    WHERE recipe_id = '$recipeId'";
    $recipeUpdateResult = $connection->query($recipeUpdateSql);

    // Detailed error logging
    $errors = [];
    if (!$foodUpdateResult) {
        $errors[] = "Foods table update failed: " . $connection->error;
    }
    if (!$ingredientUpdateResult) {
        $errors[] = "Ingredients table update failed: " . $connection->error;
    }
    if (!$recipeUpdateResult) {
        $errors[] = "Recipes table update failed: " . $connection->error;
    }

    if (empty($errors)) {
        header("Location: ../view/recipes.php?msg=Recipe updated successfully!");
        exit();
    } else {
        $errorMsg = implode("; ", $errors);
        header("Location: ../view/recipes.php?msg=" . urlencode($errorMsg));
        exit();
    }
}
?>
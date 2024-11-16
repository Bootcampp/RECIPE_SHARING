<?php
include '../db/database.php';
include '../db/config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $recipe_title = htmlspecialchars(trim($_POST['recipe_title']));
    $ingredients = explode(',', htmlspecialchars(trim($_POST['ingredients']))); // Splitting comma-separated ingredients
    $origin = htmlspecialchars(trim($_POST['origin']));
    $nutritional_value = htmlspecialchars(trim($_POST['nutritional_value']));
    $allergen_info = htmlspecialchars(trim($_POST['allergen_info']));
    $shelf_life = htmlspecialchars(trim($_POST['shelf_life']));
    $quantity = (int)$_POST['quantity'];
    $unit = htmlspecialchars(trim($_POST['unit']));
    $recipe_image = htmlspecialchars(trim($_POST['recipe_image']));
    $prep_time = (int)$_POST['prep_time'];
    $cooking_time = (int)$_POST['cooking_time'];
    $serving_size = (int)$_POST['serving_size'];
    $food_description = htmlspecialchars(trim($_POST['food_description']));
    $calories = (int)$_POST['calories'];
    $food_origin = htmlspecialchars(trim($_POST['food_origin']));
    $instructions = htmlspecialchars(trim($_POST['instructions']));
    $type = 'lunch'; // Default; adjust based on user input
    $is_healthy = null; // Default; you can update based on user input
    $created_by = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Validate required fields
    if (empty($recipe_title) || empty($ingredients) || empty($origin)) {
        header('Location: ../view/recipes.php?msg=Please fill in all fields');
        exit();
    }

    // Insert into foods table
    $food_query = "INSERT INTO foods (
        name, 
        origin, 
        type, 
        is_healthy, 
        instructions, 
        description, 
        preparation_time, 
        cooking_time, 
        serving_size, 
        calories_per_serving, 
        image_url, 
        created_by
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $food_stmt = $connection->prepare($food_query);
    $food_stmt->bind_param(
        "sssissiiisis",
        $recipe_title,
        $food_origin,
        $type,
        $is_healthy,
        $instructions,
        $food_description,
        $prep_time,
        $cooking_time,
        $serving_size,
        $calories,
        $recipe_image,
        $created_by
    );

    if (!$food_stmt->execute()) {
        header('Location: ../view/recipes.php?msg=Failed to add food');
        exit();
    }
    $food_id = $connection->insert_id;

    // Insert ingredients and link them in recipes table
    $ingredient_query = "INSERT INTO ingredients (name, origin, nutritional_value, allergen_info, shelf_life) VALUES (?, ?, ?, ?, ?)";
    $ingredient_stmt = $connection->prepare($ingredient_query);

    $recipe_query = "INSERT INTO recipes (food_id, ingredient_id, quantity, unit, optional) VALUES (?, ?, ?, ?, ?)";
    $recipe_stmt = $connection->prepare($recipe_query);

    foreach ($ingredients as $ingredient) {
        $ingredient = htmlspecialchars(trim($ingredient));

        // Insert each ingredient into ingredients table
        $ingredient_stmt->bind_param("sssss", 
            $ingredient, 
            $origin, 
            $nutritional_value, 
            $allergen_info, 
            $shelf_life
        );

        if (!$ingredient_stmt->execute()) {
            header('Location: ../view/recipes.php?msg=Failed to add ingredient');
            exit();
        }
        $ingredient_id = $connection->insert_id;

        // Link each ingredient with the recipe in recipes table
        $optional = 0; // Example: Set dynamically if necessary
        $recipe_stmt->bind_param("iidss", 
            $food_id, 
            $ingredient_id, 
            $quantity, 
            $unit, 
            $optional
        );

        if (!$recipe_stmt->execute()) {
            header('Location: ../view/recipes.php?msg=Failed to link recipe with ingredients');
            exit();
        }
    }

    // Close all statements
    $food_stmt->close();
    $ingredient_stmt->close();
    $recipe_stmt->close();

    // Redirect with success message
    header('Location: ../view/recipes.php?msg=Recipe added successfully');
} else {
    header('Location: ../view/recipes.php?msg=Invalid access');
}
?>

<?php
// Include database connection
include '../db/database.php';
include '../db/config.php';

function deleteRecipe($recipe_id, $connection) {
    $delete_query = "DELETE FROM recipes WHERE recipe_id = ?";
    $delete_stmt = $connection->prepare($delete_query);

    if (!$delete_stmt) {
        die("Database statement preparation failed: " . $connection->error);
    }

    $delete_stmt->bind_param("i", $recipe_id);

    if ($delete_stmt->execute()) {
        // Redirect with success message
        header("Location: ../view/recipes.php?msg=Recipe deleted successfully.");
        exit();
    } else {
        // Redirect with error message
        header("Location: ../view/recipes.php?msg=Error deleting recipe.");
        exit();
    }

    $delete_stmt->close();
}

// Check if delete_recipe_id is passed in the URL
if (isset($_GET['delete_recipe_id'])) {
    $recipe_id = $_GET['delete_recipe_id'] ?? null;

    if ($recipe_id) {
        deleteRecipe($recipe_id, $connection);
    } else {
        echo "Recipe ID not provided.";
    }
} else {
    echo "Invalid request.";
}
?>

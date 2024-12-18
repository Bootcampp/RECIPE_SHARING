<?php
// Include the database connection file
include '../db/database.php';
include '../functions/getrecipes.php';
checkLogin();
if ($_SESSION['role'] != 2) {
    header("Location: ../view/admin/dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../public/css/recipe.css">
</head>
<body>
    <header>
        <h1>Recipe Management</h1>
    </header>
    
    <main>
        <!-- Add New Recipe Button -->
        <section>
            <h2>Add New Recipe</h2>
            <button id="add-recipe-btn" class="btn">Add Recipe</button>
        </section>

        <!-- Recipe List -->
        <h2>Recipe List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($recipes as $recipe): ?>
            <tr>
                <td><?php echo $recipe['id']; ?></td>
                <td><?php echo htmlspecialchars($recipe['name']); ?></td>
                <td><?php echo $recipe['date_created']; ?></td>
                <td>
                    <button class="btn btn-read" onclick="viewRecipe(<?php echo $recipe['id']; ?>)">Read</button>
                    <button class="btn btn-update" onclick="editRecipe(<?php echo $recipe['id']; ?>)">Update</button>
                    <a href="../functions/deleterecipe.php?delete_recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-delete" onclick="return confirmDeletion(<?php echo $recipe['id']; ?>)">Delete</a>
                    </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
        </table>
        <script>
   function editRecipe(recipeId) {
    fetch(`../functions/retriverecipe.php?id=${recipeId}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error fetching recipe:', data.error);
                return;
            }

            // Check if fields exist in the response and set default value if undefined
            document.getElementById('recipe-title').value = data.name || '';
            document.getElementById('ingredients').value = data.ingredients || '';
            document.getElementById('origin').value = data.origin || '';
            document.getElementById('nutritional-value').value = data.nutritional_value || '';
            document.getElementById('allergen-info').value = data.allergen_info || '';
            document.getElementById('shelf-life').value = data.shelf_life || '';
            document.getElementById('quantity').value = data.quantity || '';
            document.getElementById('unit').value = data.unit || '';
            document.getElementById('recipe-image').value = data.recipe_image || '';
            document.getElementById('prep-time').value = data.prep_time || '';
            document.getElementById('cooking-time').value = data.cooking_time || '';
            document.getElementById('serving-size').value = data.serving_size || '';
            document.getElementById('food-description').value = data.food_description || '';
            document.getElementById('calories').value = data.calories || '';
            document.getElementById('food-origin').value = data.food_origin || '';
            document.getElementById('instructions').value = data.instructions || '';

            // Open the modal
            document.getElementById('add-recipe-modal').style.display = 'block';

            // Update the form's action to save updates
            const form = document.getElementById('add-recipe-form');
            form.action = `../actions/update_recipe_action.php?id=${recipeId}`;
        })
        .catch(error => console.error('Error fetching recipe data:', error));
}
function viewRecipe(recipeId) {
            fetch(`../functions/retriverecipe.php?id=${recipeId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire('Error', data.error, 'error');
                        return;
                    }

                    // Populate modal with recipe data
                    document.getElementById('recipe-title-display').textContent = data.name || 'N/A';
                    document.getElementById('recipe-ingredients').textContent = data.ingredients || 'N/A';
                    document.getElementById('recipe-instructions').textContent = data.instructions || 'N/A';
                    document.getElementById('recipe-origin').textContent = data.origin || 'N/A';
                    document.getElementById('recipe-nutrition').textContent = data.nutritional_value || 'N/A';
                    document.getElementById('recipe-image').src = data.recipe_image || 'placeholder.jpg';

                    // Show the modal
                    document.getElementById('recipe-modal').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching recipe data:', error);
                    Swal.fire('Error', 'Could not fetch recipe details.', 'error');
                });
        }
        function closeModal() {
            document.getElementById('recipe-modal').style.display = 'none';
        }
        </script>

        <a href="userdashboard.php" class="btn">Back to Dashboard</a>
    </main>

    <!-- Add Recipe Modal -->
    <div id="add-recipe-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Add Recipe</h2>
            <form id="add-recipe-form" action="../actions/recipes_action.php" method="POST" onsubmit="return validateRecipeForm()">
                <label for="recipe-title">Recipe Title:</label>
                <input type="text" id="recipe-title" name="recipe_title" required>

                <label for="ingredients">Ingredients (comma-separated):</label>
                <textarea id="ingredients" name="ingredients" required></textarea>

                <label for="origin">Origin:</label>
                <input type="text" id="origin" name="origin" required>

                <label for="nutritional-value">Nutritional Value:</label>
                <textarea id="nutritional-value" name="nutritional_value" required></textarea>

                <label for="allergen-info">Allergen Information:</label>
                <input type="text" id="allergen-info" name="allergen_info" required>

                <label for="shelf-life">Shelf Life:</label>
                <input type="text" id="shelf-life" name="shelf_life" required>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required>

                <label for="unit">Unit:</label>
                <input type="text" id="unit" name="unit" required>

                <label for="recipe-image">Recipe Image URL:</label>
                <input type="url" id="recipe-image" name="recipe_image" required>

                <label for="prep-time">Preparation Time (in minutes):</label>
                <input type="number" id="prep-time" name="prep_time" required>

                <label for="cooking-time">Cooking Time (in minutes):</label>
                <input type="number" id="cooking-time" name="cooking_time" required>

                <label for="serving-size">Serving Size:</label>
                <input type="text" id="serving-size" name="serving_size" required>

                <label for="food-description">Food Description:</label>
                <textarea id="food-description" name="food_description" required></textarea>

                <label for="calories">Calories per Serving:</label>
                <input type="number" id="calories" name="calories" required>

                <label for="food-origin">Food Origin:</label>
                <input type="text" id="food-origin" name="food_origin" required>

                <label for="instructions">Instructions:</label>
                <textarea id="instructions" name="instructions" required></textarea>

                <button type="submit" class="btn">Add Recipe</button>
            </form>
        </div>
    </div>

     <!-- Recipe Modal -->
     <div id="recipe-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Recipe Details</h2>
            <p><strong>Title:</strong> <span id="recipe-title-display"></span></p>
            <p><strong>Ingredients:</strong> <span id="recipe-ingredients"></span></p>
            <p><strong>Instructions:</strong> <span id="recipe-instructions"></span></p>
            <p><strong>Origin:</strong> <span id="recipe-origin"></span></p>
            <p><strong>Nutritional Value:</strong> <span id="recipe-nutrition"></span></p>
            <img id="recipe-image" alt="Recipe Image" src="" style="max-width: 100%; height: auto;">
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const msg = urlParams.get('msg');
        if (msg) {
            Swal.fire({
                title: msg.includes('success') ? 'Success' : 'Error',
                text: msg,
                icon: msg.includes('success') ? 'success' : 'error',
            });
        }

    </script>

    <script src="../public/js/recipe.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management</title>
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
                    <th>Author</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Spaghetti Bolognese</td>
                    <td>Nana Afia Asante</td>
                    <td>2024-03-10</td>
                    <td>
                        <button class="btn btn-read" onclick="viewMore(1)">Read</button>
                        <button class="btn btn-update" onclick="editRecipe(1)">Update</button>
                        <button class="btn btn-delete" onclick="confirmDeletion(1)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jollof Rice</td>
                    <td>Natalie Yeboah</td>
                    <td>2024-04-26</td>
                    <td>
                        <button class="btn btn-read" onclick="viewMore(2)">Read</button>
                        <button class="btn btn-update" onclick="editRecipe(2)">Update</button>
                        <button class="btn btn-delete" onclick="confirmDeletion(2)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Banana Cake</td>
                    <td>Kim Djan</td>
                    <td>2024-04-30</td>
                    <td>
                        <button class="btn btn-read" onclick="viewMore(3)">Read</button>
                        <button class="btn btn-update" onclick="editRecipe(3)">Update</button>
                        <button class="btn btn-delete" onclick="confirmDeletion(3)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Okro Stew</td>
                    <td>Papa Asante</td>
                    <td>2024-05-12</td>
                    <td>
                        <button class="btn btn-read" onclick="viewMore(4)">Read</button>
                        <button class="btn btn-update" onclick="editRecipe(4)">Update</button>
                        <button class="btn btn-delete" onclick="confirmDeletion(4)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Chocolate Cake</td>
                    <td>Joyce Freeman</td>
                    <td>2024-06-10</td>
                    <td>
                        <button class="btn btn-read" onclick="viewMore(5)">Read</button>
                        <button class="btn btn-update" onclick="editRecipe(5)">Update</button>
                        <button class="btn btn-delete" onclick="confirmDeletion(5)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="dashboard.html" class="btn">Back to Dashboard</a>
    </main>

    <!-- Add Recipe Modal -->
    <div id="add-recipe-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Add Recipe</h2>
            <form id="add-recipe-form" onsubmit="return validateRecipeForm()">
                <label for="recipe-title">Recipe Title:</label>
                <input type="text" id="recipe-title" required>

                <label for="ingredients">Ingredients:</label>
                <textarea id="ingredients" required></textarea>

                <label for="origin">Origin:</label>
                <input type="text" id="origin" required>

                <label for="nutritional-value">Nutritional Value:</label>
                <textarea id="nutritional-value" required></textarea>

                <label for="allergen-info">Allergen Information:</label>
                <input type="text" id="allergen-info" required>

                <label for="shelf-life">Shelf Life:</label>
                <input type="text" id="shelf-life" required>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" required>

                <label for="unit">Unit:</label>
                <input type="text" id="unit" required>

                <label for="recipe-image">Recipe Image URL:</label>
                <input type="url" id="recipe-image" required>

                <label for="prep-time">Preparation Time (in minutes):</label>
                <input type="number" id="prep-time" required>

                <label for="cooking-time">Cooking Time (in minutes):</label>
                <input type="number" id="cooking-time" required>

                <label for="serving-size">Serving Size:</label>
                <input type="text" id="serving-size" required>

                <label for="food-description">Food Description:</label>
                <textarea id="food-description" required></textarea>

                <label for="calories">Calories per Serving:</label>
                <input type="number" id="calories" required>

                <label for="food-origin">Food Origin:</label>
                <input type="text" id="food-origin" required>

                <label for="instructions">Instructions:</label>
                <textarea id="instructions" required></textarea>

                <button type="submit" class="btn">Add Recipe</button>
            </form>
        </div>
    </div>

   <script src="../public/js/recipe.js"></script>
</body>
</html>

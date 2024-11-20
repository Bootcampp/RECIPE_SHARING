<?php
// Start session and include necessary files
include '../db/database.php';
include '../db/config.php';
include '../functions/getallrecipes.php';

checkLogin();
if ($_SESSION['role'] != 1) {
    header("Location: ../view/userdashboard.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's recipes
$all_recipes = getAllRecipes($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/recipe_feed.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Favorites Page</title>
</head>
<body>
    <header>
        <h1>Favorites</h1>
        <input type="text" placeholder="Search your favorites..." id="searchBar">
        </header>

        <section class="recipe-grid">
    <?php if (empty($all_recipes)): ?>
        <p>No recipes found.</p>
    <?php else: ?>
        <?php foreach ($all_recipes as $recipe): ?>
            <div class="recipe-card" data-recipe-id="<?= $recipe['id']; ?>">
                <h3><?= $recipe['name']; ?></h3>
                <p>Created: <?= date("F j, Y", strtotime($recipe['date_created'])); ?></p>
                <p>By: <?= $recipe['created_by']; ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>
<script>
    $(document).ready(function () {
    $('.recipe-card').click(function () {
        const recipeId = $(this).data('recipe-id');

        $.ajax({
            url: '../functions/retrive.php',
            method: 'GET',
            data: { recipe_id: recipeId },
            dataType: 'json',
            success: function (details) {
                if (details.error) {
                    $('#recipeDetails').html(`<p class="error">${details.error}</p>`);
                } else {
                    const modalContent = `
                        <h2>${details.name}</h2>
                        <p><strong>Instructions:</strong> ${details.instructions}</p>
                        <p><strong>Origin:</strong> ${details.origin}</p>
                        <p><strong>Nutritional Value:</strong> ${details.nutritional_value}</p>
                        <img src="${details.recipe_image}" alt="${details.name}" style="max-width: 100%; height: auto;">
                    `;
                    
                    $('#recipeDetails').html(modalContent);
                }
                $('#recipeModal').fadeIn();
            },
            error: function (xhr, status, error) {
                console.error("Recipe fetch error:", error);
                $('#recipeDetails').html(`<p class="error">Failed to load recipe details.</p>`);
                $('#recipeModal').fadeIn();
            }
        });
    });

    $('#closeModal, #recipeModal').on('click', function (e) {
        if (e.target === this) {
            $('#recipeModal').fadeOut();
        }
    });

    $('.modal-content').on('click', function (e) {
        e.stopPropagation();
    });
});
</script>
    

    <!-- Modal for showing recipe details -->
    <div id="recipeModal" style="display: none;">
        <div class="modal-content">
            <span id="closeModal">&times;</span>
            <div id="recipeDetails">
                <!-- Recipe details will be loaded here -->
            </div>
        </div>
    </div>


    <style>
        /* Basic modal styles */
        #recipeModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 600px;
            text-align: center;
        }
        #closeModal {
            position: absolute;
            top: 10px;
            right: 20px;
            cursor: pointer;
        }
    </style>
</body>
</html>

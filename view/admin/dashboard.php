<?php
// Include the database connection and functions
include_once '../../functions/admin_actions.php';

// if ($_SESSION['role'] != 1) {
//     header("Location: ../userdashboard.php");
//     exit();
// }

// Fetch data
$total_users = getTotalUsers($connection);
$total_recipes = getTotalRecipes($connection);
$recipes_this_month = getRecipesThisMonth($connection);
$top_creators = getTopRecipeCreators($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Dashboard</title>
    <link rel="stylesheet" href="../../public/css/dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <header>
        <div class="logo">Admin</div>
        <button id="menuToggle" class="menu-toggle">☰</button>
        <nav id="mainNav">
            <ul>
                <li><a href="../explore_recipes.php">All Recipes</a></li>
                <li><a href="../users.php">People</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="../../actions/logout.php">Log out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="sidebar" id="sidebar"></div>
        <div class="content">
            <div class="analytics-grid">
                <div class="analytics-card">
                    <h3>Total Users</h3>
                    <p class="analytics-number"><?= $total_users ?></p>
                </div>
                <div class="analytics-card">
                    <h3>Total Recipes</h3>
                    <p class="analytics-number"><?= $total_recipes ?></p>
                </div>
                <div class="analytics-card">
                    <h3>This Month</h3>
                    <p class="analytics-number"><?= $recipes_this_month ?></p>
                </div>
            </div>
            
            <div class="charts-container">
                <div class="chart-box">
                    <h2>Recipes Created per Month</h2>
                    <canvas id="recipeChart"></canvas>
                </div>
                <div class="top-users-box">
                    <h2>Top Recipe Creators</h2>
                    <div class="user-list">
                        <?php foreach ($top_creators as $creator): ?>
                            <div class="user-item">
                                <span class="user-name"><?= $creator['name'] ?></span>
                                <span class="recipe-count"><?= $creator['recipe_count'] ?> recipes</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../public/js/dashboard.js"></script>
</body>
</html>



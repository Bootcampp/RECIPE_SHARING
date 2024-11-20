<?php
include "../functions/user.php";
include "../functions/getTotalRecipes.php";
include "../functions/getRecentRecipes.php";
checkLogin();
$userId = $_SESSION['user_id']; 

// Fetch the total number of recipes and the two most recent recipes
$totalRecipes = getTotalRecipes($userId, $connection);
$recentRecipes = getRecentRecipes($userId, $connection);

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
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../public/css/dashboard.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
</head>
<body>
    <header>
        <div class="logo"><?php echo htmlspecialchars($user_name); ?>'s Dashboard</div>
        <button id="menuToggle" class="menu-toggle">☰</button>
        <nav id="mainNav">
            <ul>
                <li><a href="recipes.php">Manage Recipes</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="../actions/logout.php">Log out</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="content">
            <!-- Personal Analytics Section -->
            <section class="analytics-section">
                <h2>Personal Analytics</h2>
                <div class="analytics-grid">
                    <div class="analytics-card">
                        <h3>Total Recipes Added</h3>
                        <p class="analytics-number" id="totalRecipes"><?php echo $totalRecipes; ?></p>
                    </div>
                    <div class="analytics-card">
                        <h3>Recent Submissions</h3>
                        <ul class="recent-recipes" id="recentRecipes">
                            <?php foreach ($recentRecipes as $recipe): ?>
                                <li><?php echo htmlspecialchars($recipe['name']) . ' - ' . date('Y-m-d', strtotime($recipe['created_at'])); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Recipe Management Section -->
            <section class="recipe-management-section">
                <h2>My Recipes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Recipe Name</th>
                            <th>Status</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody id="recipeList">
                        <!-- Dynamically populated table rows -->
                    </tbody>
                </table>
            </section>

            <!-- Optional Charts -->
            <section class="charts-section">
                <h2>Analytics</h2>
                <div class="charts-container">
                    <div class="chart-box">
                        <h3>Submission Trends</h3>
                        <canvas id="submissionTrendsChart"></canvas>
                    </div>
                    <div class="chart-box">
                        <h3>Category Distribution</h3>
                        <canvas id="categoryDistributionChart"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <script src="../public/js/userdashboard.js"></script>
</body>
</html>

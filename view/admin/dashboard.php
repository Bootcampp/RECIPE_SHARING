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
        <div class="logo">My Recipes</div>
        <button id="menuToggle" class="menu-toggle">☰</button>
        <nav id="mainNav">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="recipe_feed.html">Favorites</a></li>
                <li><a href="recipes.html">Add Recipe</a></li>
                <li><a href ="users.html">People</a></li>
                <li><a href="#">Profile</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="sidebar" id="sidebar">
      
        </div>
        <div class="content">
            <div class="analytics-grid">
                <div class="analytics-card">
                    <h3>Total Users</h3>
                    <p class="analytics-number">200</p>
                </div>
                <div class="analytics-card">
                    <h3>Total Recipes</h3>
                    <p class="analytics-number">100</p>
                </div>
                <div class="analytics-card">
                    <h3>This Month</h3>
                    <p class="analytics-number">40</p>
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
                        <div class="user-item">
                            <span class="user-name">Afia</span>
                            <span class="recipe-count">12 recipes</span>
                        </div>
                        <div class="user-item">
                            <span class="user-name">Natalie</span>
                            <span class="recipe-count">11 recipes</span>
                        </div>
                        <div class="user-item">
                            <span class="user-name">Kim</span>
                            <span class="recipe-count">10 recipes</span>
                        </div>
                        <div class="user-item">
                            <span class="user-name">Papa</span>
                            <span class="recipe-count">9 recipes</span>
                        </div>
                        <div class="user-item">
                            <span class="user-name">James</span>
                            <span class="recipe-count">8 recipes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../public/js/dashboard.js"></script>
</body>
</html>
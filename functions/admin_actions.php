<?php
require_once __DIR__ . '/../db/database.php';

function getTotalUsers($connection) {
    $query = "SELECT COUNT(*) as total FROM users";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    return 0;
}

function getTotalRecipes($connection) {
    $query = "SELECT COUNT(*) as total FROM recipes";
    $result = mysqli_query($connection, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }
    return 0;
}

function getRecipesThisMonth($connection) {
    $currentMonth = date('Y-m');
    $query = "SELECT COUNT(*) as total FROM recipes WHERE DATE_FORMAT(created_at, '%Y-%m') = ?";
    
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $currentMonth);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_bind_result($stmt, $total);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    
    return $total;
}

function getTopRecipeCreators($connection) {
    $query = "SELECT 
                u.fname, 
                u.lname, 
                COUNT(DISTINCT r.recipe_id) as recipe_count
              FROM users u
              JOIN foods f ON u.user_id = f.created_by
              JOIN recipes r ON f.food_id = r.food_id
              GROUP BY u.user_id, u.fname, u.lname
              ORDER BY recipe_count DESC
              LIMIT 5";
    
    $result = mysqli_query($connection, $query);
    
    if (!$result) {
        // Handle query error
        return [];
    }
    
    $top_creators = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $top_creators[] = [
            'name' => $row['fname'] . ' ' . $row['lname'],
            'recipe_count' => $row['recipe_count']
        ];
    }
    
    return $top_creators;
}
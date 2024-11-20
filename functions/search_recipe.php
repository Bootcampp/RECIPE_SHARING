<?php
// search_recipes.php - Place this in your functions folder
include '../db/database.php';

function searchUserRecipes($userId, $searchTerm, $connection) {
    $searchTerm = '%' . $searchTerm . '%';
    
    $query = "SELECT id, name, date_created, recipe_image 
              FROM recipes 
              WHERE user_id = ? 
              AND (name LIKE ? 
                   OR ingredients LIKE ? 
                   OR instructions LIKE ? 
                   OR origin LIKE ?)";
    
    $stmt = $connection->prepare($query);
    $stmt->bind_param("issss", $userId, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $recipes = [];
    
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
    
    return $recipes;
}

// If this file is called directly via AJAX
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    session_start();
    
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['error' => 'User not authenticated']);
        exit;
    }
    
    $searchTerm = $_GET['search'];
    $userId = $_SESSION['user_id'];
    
    $searchResults = searchUserRecipes($userId, $searchTerm, $connection);
    echo json_encode($searchResults);
    exit;
}
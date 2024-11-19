<?php
include '../db/database.php';

function getRecentRecipes($userId, $connection) {
    $query = "SELECT name, created_at FROM foods WHERE created_by = '$userId' ORDER BY created_at DESC LIMIT 2";
    $result = mysqli_query($connection, $query);
    
    $recentRecipes = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $recentRecipes[] = $row;
        }
    }
    return $recentRecipes;
}
?>

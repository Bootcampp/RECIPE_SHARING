<?php
include '../db/database.php';


function getTotalRecipes($userId, $connection) {
    $query = "SELECT COUNT(*) AS totalRecipes FROM foods WHERE created_by = '$userId'";
    $result = mysqli_query($connection, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['totalRecipes'];
    } else {
        return 0;
    }
}
?>

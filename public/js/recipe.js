
// Open Add Recipe Modal
document.getElementById("add-recipe-btn").onclick = function() {
    document.getElementById("add-recipe-modal").style.display = "block";
}

// Close Modal
function closeModal() {
    document.getElementById("add-recipe-modal").style.display = "none";
}

// Validate Recipe Form
function validateRecipeForm() {
    // Perform validation for all required fields
    const title = document.getElementById("recipe-title").value;
    const ingredients = document.getElementById("ingredients").value;
    const prepTime = document.getElementById("prep-time").value;
    const cookingTime = document.getElementById("cooking-time").value;

    if (!title || !ingredients || prepTime <= 0 || cookingTime <= 0) {
        alert("Please fill out all fields correctly.");
        return false; // Prevent form submission
    }
    closeModal(); // Close modal after submission
    alert("Recipe added successfully!"); // Placeholder for actual submission logic
    return false; // Prevent form from submitting to allow for demo purposes
}

// Confirm Deletion
function confirmDeletion(recipeId) {
    if (confirm("Are you sure you want to delete this recipe?")) {
        // Placeholder for delete action
        alert("Recipe " + recipeId + " deleted.");
    }
}

// View More Recipe Details (Placeholder Function)
function viewMore(recipeId) {
    alert("Viewing details for Recipe " + recipeId);
    // Implement modal for viewing recipe details here
}

// Edit Recipe (Placeholder Function)
function editRecipe(recipeId) {
    alert("Editing Recipe " + recipeId);
    // Implement editing logic here
}

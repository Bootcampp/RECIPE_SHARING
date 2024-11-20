
// Open Add Recipe Modal
document.getElementById("add-recipe-btn").onclick = function() {
    document.getElementById("add-recipe-modal").style.display = "block";
}

// Close Modal
function closeModal() {
    document.getElementById("add-recipe-modal").style.display = "none";
}

function validateRecipeForm() {
    // Get form elements
    const recipeTitle = document.getElementById("recipe-title").value.trim();
    const ingredients = document.getElementById("ingredients").value.trim();
    const origin = document.getElementById("origin").value.trim();
    const nutritionalValue = document.getElementById("nutritional-value").value.trim();
    const allergenInfo = document.getElementById("allergen-info").value.trim();
    const shelfLife = document.getElementById("shelf-life").value.trim();
    const quantity = document.getElementById("quantity").value.trim();
    const unit = document.getElementById("unit").value.trim();
    const recipeImage = document.getElementById("recipe-image").value.trim();
    const prepTime = document.getElementById("prep-time").value.trim();
    const cookingTime = document.getElementById("cooking-time").value.trim();
    const servingSize = document.getElementById("serving-size").value.trim();
    const foodDescription = document.getElementById("food-description").value.trim();
    const calories = document.getElementById("calories").value.trim();
    const foodOrigin = document.getElementById("food-origin").value.trim();
    const instructions = document.getElementById("instructions").value.trim();

    const errors = [];

    // Validate text fields (must contain letters only)
    if (!isTextOnly(recipeTitle)) {
        errors.push("Recipe title must contain only letters and spaces.");
    }
    if (!isTextOnly(origin)) {
        errors.push("Origin must contain only letters and spaces.");
    }
    if (!isTextOnly(unit)) {
        errors.push("Unit must contain only letters and spaces.");
    }
    if (!isTextOnly(foodOrigin)) {
        errors.push("Food origin must contain only letters and spaces.");
    }
    if (!isTextOnly(shelfLife)) {
        errors.push("Shelf life must contain only letters and spaces.");

    // Validate number fields
    if (!isPositiveInteger(quantity)) {
        errors.push("Quantity must be a positive number.");
    }
    if (!isPositiveInteger(prepTime)) {
        errors.push("Preparation time must be a positive number.");
    }
    if (!isPositiveInteger(cookingTime)) {
        errors.push("Cooking time must be a positive number.");
    }
    if (!isPositiveInteger(servingSize)) {
        errors.push("Serving size must be a positive number.");
    }
    if (!isPositiveInteger(calories)) {
        errors.push("Calories must be a positive number.");
    }

    // Validate URL
    if (!isValidURL(recipeImage)) {
        errors.push("Recipe image must be a valid URL.");
    }

    // Validate text areas (non-empty validation)
    if (ingredients === "") {
        errors.push("Ingredients cannot be empty.");
    }
    if (nutritionalValue === "") {
        errors.push("Nutritional value cannot be empty.");
    }
    if (foodDescription === "") {
        errors.push("Food description cannot be empty.");
    }
    if (instructions === "") {
        errors.push("Instructions cannot be empty.");
    }

    // Display errors if any exist
    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }

    // If all validations pass
    return true;
}

// Helper function to check if a value is text only (letters and spaces)
function isTextOnly(value) {
    return /^[A-Za-z\s]+$/.test(value);
}

// Helper function to check if a val


}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../public/css/register.css">
</head>
<body>
    <div class="welcome-text">
        <h1>Ms. A's Recipe Hub</h1>
    </div>
    <div class="whole">
        <div class="left">
            <img src="../assets/food.jpeg" alt="Kitchen Image">
        </div>
        <div class="right">
            <div class="form-container">
                <header><h1>Sign Up</h1></header>
                <form id="signupForm" method="POST" action="../actions/register_user.php">
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="fname" required>

                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lname" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required pattern=".*@gmail\.com$" title="Email must end with gmail.com">

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required minlength="8" title="Password must be at least 8 characters long, contain uppercase and lowercase letters, numbers, and special characters.">

                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>

                    <!-- Error message will be displayed here -->
                    <div id="error-message" style="color: red; font-weight: bold;"></div>

                    <button type="submit">Sign Up</button>
                    <p>Already have an account? <a href="login.html">Login</a></p>
                </form>
            </div>
        </div>
    </div>
    
    <!-- External JavaScript file for message handling -->
    <script src="../public/js/register.js"></script>
    <script>
        // Check if there's an error message in the URL
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const errorMsg = urlParams.get('msg');

    if (errorMsg) {
        // Display the error message in the error-message div
        document.getElementById("error-message").textContent = errorMsg;
        document.getElementById("error-message").style.color = "red";
    }
};

    </script>
</body>
</html>

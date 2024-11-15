<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <header><h1>Login</h1></header>
                
                <form id="loginForm" action="../actions/login_user.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Email must end with gmail.com">
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="8" required title="Password must be at least 8 characters long, contain uppercase and lowercase letters, numbers, and special characters">
                    
                    <button type="submit">Login</button>
                    <p>Don't have an account? <a href="register.php">Sign Up</a></p>
                </form>
                
                <!-- Div to display error messages -->
                <div id="error-message"></div>
            </div>
        </div>
    </div>
    <script src="../public/js/login.js"></script>
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

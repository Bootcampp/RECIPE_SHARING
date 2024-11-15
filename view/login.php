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
            <img src="food.jpeg" alt="Kitchen Image">
        </div>
        <div class="right">
            <div class="form-container">
                <header><h1>Login</h1></header>
                <form id="loginForm">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Email must end with gmail.com">
                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" minlength="8" title="Password must be at least 8 characters long, contain uppercase and lowercase letters, numbers, and special characters">
                    
                    <button type="submit">Login</button>
                    <p>Already have an account? <a href="Signup.html">Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>
    <script src="../public/js/login.js"></script>
</body>
</html>

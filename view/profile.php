<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="../public/css/profile.css">
</head>
<body>
    <div class="profile-card">
        <img src="../assets/food.jpeg" alt="Profile Picture" class="profile-img">
        <h1 id="profile-name">Pokua</h1>
        <p id="profile-role">User</p>
        <button onclick="editProfile()">Edit Profile</button>
    </div>

    <div class="edit-modal" id="edit-modal">
        <div class="modal-content">
            <label for="name">Name:</label>
            <input type="text" id="name" value="John Doe">
            <label for="role">Role:</label>
            <input type="text" id="role" value="Web Developer">
            <button onclick="saveProfile()">Save</button>
            <button onclick="closeModal()">Cancel</button>
        </div>
    </div>

    <script src="../public/js/profile.js"></script>
</body>
</html>

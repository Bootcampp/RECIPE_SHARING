<?php
include '../db/config.php';
checkLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="../public/css/users.css"> 
</head>
<body>
    <header>
        <h1>User Management</h1>
    </header>
    
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nana Afia Asante</td>
                    <td>afia.asante@gmail.com</td>
                    <td>
                        <button class="btn btn-read">View more</button>
                        <button class="btn btn-update">Update</button>
                        <button class="btn btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Natalie Yeboah</td>
                    <td>natalie.yeboah@gmail.com</td>
                    <td>
                        <button class="btn btn-read">View more</button>
                        <button class="btn btn-update">Update</button>
                        <button class="btn btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Kim Djan</td>
                    <td>kim.djan@gmail.com</td>
                    <td>
                        <button class="btn btn-read">View more</button>
                        <button class="btn btn-update">Update</button>
                        <button class="btn btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Papa Asante</td>
                    <td>papa.asante@gmail.com</td>
                    <td>
                        <button class="btn btn-read">View more</button>
                        <button class="btn btn-update">Update</button>
                        <button class="btn btn-delete">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>James Tetteh</td>
                    <td>james.tetteh@gmail.com</td>
                    <td>
                        <button class="btn btn-read">View more</button>
                        <button class="btn btn-update">Update</button>
                        <button class="btn btn-delete">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <a href="dashboard.html" class="btn">Back to Dashboard</a>
    </main>
    <!-- "View More" feature -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>User Details</h2>
            <p id="userDetails"></p>
        </div>
    </div>
    <script src="../public/js/users.js"></script>
</body>
</html>
